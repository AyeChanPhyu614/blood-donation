<?php

namespace App\Http\Controllers;

use App\Models\Region;

class ApiController extends Controller
{
    public function getDairas($regionCode)
    {
        return Region::find($regionCode)->dairas;
    }
}
