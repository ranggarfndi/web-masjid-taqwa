<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FridaySchedule extends Model
{
    protected $fillable = [
        'date', 'waktu', 'khatib', 'imam'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}