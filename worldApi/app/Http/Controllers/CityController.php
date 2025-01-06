<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    // g: /city/orderbyname
    public function getCitiesOrderedByName()
    {
        $cities = DB::table('city')
            ->orderBy('name', 'asc')
            ->get(['name']);

        return response()->json($cities);
    }

    // h: /city/top/{numTop}
    public function getTopCitiesByPopulation($numTop)
    {
        $cities = DB::table('city')
            ->orderBy('population', 'desc')
            ->limit($numTop)
            ->get(['name', 'population']);

        return response()->json($cities);
    }
}
