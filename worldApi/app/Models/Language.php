<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    // Definir la relación muchos a muchos con Country
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'countrylanguage', 'Language', 'CountryCode');
    }
}
