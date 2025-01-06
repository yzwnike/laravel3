<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        // Obtén todos los países
        $countries = Country::all();
        
        // Devuelve la vista con los países
        return view('countries.index', compact('countries'));
    }
}
