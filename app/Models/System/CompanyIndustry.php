<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyIndustry extends Model
{
    use HasFactory;

    protected $connection   = 'system';
    
    protected $fillable     = [
        'name', 
    ];
}
