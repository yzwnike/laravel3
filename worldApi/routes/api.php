<?php



// routes/api.php
use App\Http\Controllers\LanguageController;

// Ruta para obtener todos los idiomas con sus países
Route::get('/languages', [LanguageController::class, 'index']);

// Ruta para obtener un idioma específico y los países que lo hablan
Route::get('/language/{language}', [LanguageController::class, 'show']);

Route::middleware('api')->get('/languages', [LanguageController::class, 'index']);


Route::get('/country/{continent}', [CountryController::class, 'getCountriesByContinent']);

Route::get('/country/orderbysize', [CountryController::class, 'getCountriesOrderedBySize']);

Route::get('/country/withzerocities', [CountryController::class, 'getCountriesWithZeroCities']);

Route::get('/country/independencenull', [CountryController::class, 'getCountriesWithNoIndependence']);

Route::get('/country/inependence/{year1}/{year2}', [CountryController::class, 'getCountriesByIndependenceYear']);

Route::get('/country/letter/{letter}', [CountryController::class, 'getCountriesByFirstLetter']);

Route::get('/country/stats/{code}', [CountryController::class, 'getCountryStats']);

Route::get('/country/officialang', [CountryController::class, 'getCountriesWithOfficialLanguage']);

Route::get('/city/orderbyname', [CityController::class, 'getCitiesOrderedByName']);

Route::get('/city/top/{numTop}', [CityController::class, 'getTopCitiesByPopulation']);

