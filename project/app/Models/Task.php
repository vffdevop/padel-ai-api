<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'tittle',
        'description',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];
}
