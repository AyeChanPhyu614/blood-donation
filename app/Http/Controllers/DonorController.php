<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonorRequest;
use App\Models\BloodGroup;
use App\Models\Daira;
use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $request->flush();

        $searchParams = ['blood_group', 'region', 'daira'];

        $donors = User::with('region', 'daira', 'bloodGroup')
            ->filter(request($searchParams))
            ->where('readyToGive', 1)
            ->inRandomOrder()
            ->paginate(10);

        $isSearch = $request->hasAny($searchParams) ? true : false;

        return view('pages.donors', [
            'donors' => $donors,
            'searchedBloodGroup' => BloodGroup::find($request['blood_group'])?->bloodGroup,
            'searchedRegion' => Region::find($request['region'])?->name,
            'searchedDaira' => Daira::find($request['daira'])?->name,
            'otherDonors' => User::getOtherDonorsCanDonateTo($request['blood_group'], $request['region'], $request['daira']),
            'isSearch' => $isSearch,
        ]);
    }
}
