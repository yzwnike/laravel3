<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/languages', [LanguageController::class, 'index']);
Route::get('/language/{language}', [LanguageController::class, 'show']);

// Rutas para el controlador de países
Route::get('/country/{continent}', [CountryController::class, 'getCountriesByContinent']);
Route::get('/country/orderbysize', [CountryController::class, 'getCountriesOrderedBySize']);
Route::get('/country/withzerocities', [CountryController::class, 'getCountriesWithZeroCities']);
Route::get('/country/independencenull', [CountryController::class, 'getCountriesWithNoIndependence']);
Route::get('/country/inependence/{year1}/{year2}', [CountryController::class, 'getCountriesByIndependenceYear']);
Route::get('/country/letter/{letter}', [CountryController::class, 'getCountriesByFirstLetter']);
Route::get('/country/stats/{code}', [CountryController::class, 'getCountryStats']);
Route::get('/country/officialang', [CountryController::class, 'getCountriesWithOfficialLanguage']);

// Rutas para el controlador de ciudades
Route::get('/city/orderbyname', [CityController::class, 'getCitiesOrderedByName']);
Route::get('/city/top/{numTop}', [CityController::class, 'getTopCitiesByPopulation']);
