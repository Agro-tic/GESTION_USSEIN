<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jourferie extends Model
{
    protected $fillable = [
        'nom',
        'date',
        'annee',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];
}
