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

}