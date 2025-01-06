<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Definir la relación muchos a muchos con Language
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'countrylanguage', 'CountryCode', 'Language');
    }
}
