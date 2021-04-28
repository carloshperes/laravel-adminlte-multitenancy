<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection   = 'system';
    
    protected $fillable     = [
        'state_id',
        'city_id',
        'neighborhood_id',
        'zip',
        'street', 
    ];
}
