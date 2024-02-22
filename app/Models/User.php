<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'readyToGive',
        'phone',
        'region_id',
        'daira_id',
        'blood_group_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function daira()
    {
        return $this->belongsTo(Daira::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['blood_group'] ?? false,
            fn ($query, $blood_group) => $query->whereHas(
                'bloodGroup',
                fn ($query) => $query->where('id', $blood_group)
            )
        );
        $query->when(
            $filters['region'] ?? false,
            fn ($query, $region) => $query->whereHas(
                'region',
                fn ($query) => $query->where('id', $region)
            )
        );
        $query->when(
            $filters['daira'] ?? false,
            fn ($query, $daira) => $query->whereHas(
                'daira',
                fn ($query) => $query->where('id', $daira)
            )
        );
    }

    public static function getOtherDonorsCanDonateTo($bloodGroupId, $region = null, $daira = null)
    {
        if (! empty(otherBloodGroupsDonorsOf($bloodGroupId))) {
            return User::with('bloodGroup')
                ->whereIn('blood_group_id', otherBloodGroupsDonorsOf($bloodGroupId))
                ->where('readyToGive', '=', 1)
                ->when($region, function ($q) use ($region) {
                    return $q->where('region_id', $region);
                })
                ->when($daira, function ($q) use ($daira) {
                    return $q->where('daira_id', $daira);
                })
                ->inRandomOrder()
                ->paginate(10, ['*'], 'other-donors')
                ->appends(request()->except('other-donors'));
        }

        return []; // add abiliy of wilay and daira
    }

    public static function getAllReadyToGiveDonors()
    {
        return User::with('region', 'daira', 'bloodGroup')->where('readyToGive', 1)->inRandomOrder()->paginate(10);
    }
}
