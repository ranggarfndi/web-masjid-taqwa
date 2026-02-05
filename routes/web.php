<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Halaman Depan
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Berita
Route::get('/kegiatan/{activity:slug}', function (App\Models\Activity $activity) {
    return view('activity-detail', compact('activity'));
})->name('activity.show');
