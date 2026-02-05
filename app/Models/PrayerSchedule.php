<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'subuh',
        'dzuhur',
        'ashar',
        'maghrib',
        'isya',
        'is_friday',   // Penting untuk logika Jumat
        'waktu_jumat', // Jam sholat Jumat
        'khatib',      // Nama Khatib
    ];

    protected $casts = [
        'date' => 'date',
        'is_friday' => 'boolean', // Ubah 1/0 jadi true/false
    ];
}
