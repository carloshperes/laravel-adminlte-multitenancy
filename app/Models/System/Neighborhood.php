<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $connection   = 'system';
    
    protected $fillable     = [
        'city_id',
        'name', 
    ];
}
