<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // Mostrar todos los idiomas con los países asociados
    public function index()
    {
        $languages = Language::with('countries')->get();
        return response()->json($languages);
    }

    // Mostrar un idioma con los países a los que pertenece
    public function show($language)
    {
        $lang = Language::with('countries')->where('Language', $language)->first();
        if ($lang) {
            return response()->json($lang);
        } else {
            return response()->json(['error' => 'Language not found'], 404);
        }
    }
}
