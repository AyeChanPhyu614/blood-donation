<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    private $users = [
       [
            'email' => 'test@gmail.com',
            'phone' => '0511111111',
            'readyToGive' => true,
            // 'name' => 'test',
            'password' => '$2y$10$RN5Qk1.fTvufax1KNDyKiuCgwrtjWWyB2V6cRXJaWBj4gys1msS3e',
            'region_id' => 1,
            'township_id' => 1,
            'blood_group_id' => 6,
       ],
    ];
    // private $regions = [
    //    [
    //        'id' => '1',
    //        'name' => 'Yangon',
    //        'arName' => 'Yangon',
    //    ],
    //    [
    //        'id' => '2',
    //        'name' => 'Mandalay',
    //        'arName' => 'Mandalay',
    //    ],
    //    [
    //        'id' => '3',
    //        'name' => 'Bago',
    //        'arName' => 'Bago',
    //    ],
    //    [
    //        'id' => '4',
    //        'name' => 'Ayeyarwady',
    //        'arName' => 'Ayeyarwady',
    //    ],
    //    [
    //        'id' => '5',
    //        'name' => 'Shan',
    //        'arName' => 'Shan',
    //    ],
    //  e
    // ];
    public function run()
    {
        array_walk($this->users, function ($users) {
            User::create($users);
        });
    }
}
