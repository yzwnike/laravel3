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

    // c: /country/withzerocities
    public function getCountriesWithZeroCities()
    {
        $countries = DB::table('country')
            ->leftJoin('city', 'country.code', '=', 'city.countrycode')
            ->groupBy('country.code')
            ->havingRaw('COUNT(city.id) = 0')
            ->get(['country.name']);

        return response()->json($countries);
    }

    // d: /country/independencenull
    public function getCountriesWithNoIndependence()
    {
        $countries = DB::table('country')
            ->whereNull('indepyear')
            ->get(['name']);

        return response()->json($countries);
    }
















}
