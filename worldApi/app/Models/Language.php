<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Nombre del idioma
    ];

    // Relación con los países
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'countrylanguage', 'language_id', 'country_id');
    }
}
