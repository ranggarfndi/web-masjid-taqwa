<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = [
        'title',
        'slug',
        'date',
        'image',
        'content',
    ];

    // Ubah format data otomatis
    protected $casts = [
        'date' => 'date', // Agar dianggap sebagai tanggal, bukan teks biasa
    ];
}
