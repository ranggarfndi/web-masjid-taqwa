<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'category',    // masjid / yatim
        'type',        // pemasukan / pengeluaran
        'amount',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer', // Pastikan angka uang dianggap integer
    ];
}
