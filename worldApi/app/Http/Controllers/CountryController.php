<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    // a: /country/{Continent}
    public function getCountriesByContinent($continent)
    {
        $countries = DB::table('country')
            ->where('continent', $continent)
            ->get(['name']);
        
        if ($countries->isEmpty()) {
            return response()->json(['error' => 'Continent not found'], 404);
        }

        return response()->json($countries);
    }


    // b: /country/orderbysize
    public function getCountriesOrderedBySize()
    {
        $countries = DB::table('country')
            ->orderBy('surfacearea', 'asc')
            ->get(['name', 'surfacearea']);

        return response()->json($countries);
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

    // e: /country/inependence/{year1}/{year2}
    public function getCountriesByIndependenceYear($year1, $year2)
    {
        $countries = DB::table('country')
            ->whereBetween('indepyear', [$year1, $year2])
            ->get(['name', 'indepyear']);

        return response()->json($countries);
    }

    // f: /country/letter/{letter}
    public function getCountriesByFirstLetter($letter)
    {
        $countries = DB::table('country')
            ->where('name', 'like', $letter.'%')
            ->get(['name']);

        return response()->json($countries);
    }

    

    


}