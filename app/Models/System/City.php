<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $connection   = 'system';
    
    protected $fillable     = [
        'state_id',
        'name', 
    ];
}
