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

    // g: /country/stats/{code}
    public function getCountryStats($code)
    {
        $country = DB::table('country')
            ->where('code', $code)
            ->first(['name']);

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $cityStats = DB::table('city')
            ->where('countrycode', $code)
            ->selectRaw('AVG(population) as avg_population, COUNT(id) as num_cities')
            ->first();

        return response()->json([
            'country' => $country->name,
            'avg_population' => $cityStats->avg_population,
            'num_cities' => $cityStats->num_cities
        ]);
    }

    // h: /country/officialang
    public function getCountriesWithOfficialLanguage()
    {
        $countries = DB::table('countrylanguage')
            ->join('country', 'countrylanguage.CountryCode', '=', 'country.code')
            ->where('countrylanguage.IsOfficial', 'T')
            ->get(['country.name', 'countrylanguage.Language']);

        return response()->json($countries);
    }
}
