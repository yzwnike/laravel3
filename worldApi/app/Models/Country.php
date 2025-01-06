<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code', 
    ];

    
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'countrylanguage', 'country_id', 'language_id');
    }
}
