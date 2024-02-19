<?php

namespace Database\Seeders;

use App\Models\Daira;
use Illuminate\Database\Seeder;

class DairaSeeder extends Seeder
{
    private $dairas = [
        1 => [
            'arName' => 'Insein',
            'name' => 'Insein',
            'region_id' => '01',
        ],
        2 => [
            'arName' => 'Kyauk Se',
            'name' => 'Kyauk Se',
            'region_id' => '02',
        ],
        3 => [
            'arName' => 'Phaung Gyi',
            'name' => 'Phaung Gyi',
            'region_id' => '03',
        ],
        4 => [
            'arName' => 'Pathein',
            'name' => 'Pathein',
            'region_id' => '04',
        ],
        5 => [
            'arName' => 'Taung Gyi',
            'name' => 'Taung Gyi',
            'region_id' => '05',
        ],
    ];

    public function run()
    {
        array_walk($this->dairas, function ($daira, $key) {
            Daira::create(array_merge(['id' => $key], $daira));
        });
    }
}
