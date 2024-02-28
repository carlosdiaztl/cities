<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'country-name',
        'population',
        'city-name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
