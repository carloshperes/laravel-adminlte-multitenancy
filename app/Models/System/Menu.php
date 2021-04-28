<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $connection   = 'system';
    
    protected $fillable     = [
        'parent_id',
        'text',
        'url',
        'icon',
        'icon_color',
        'route',
        'target',
        'classes',
        'can',
        'active'
    ];
}
