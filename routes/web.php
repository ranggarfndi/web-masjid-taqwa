<?php

use App\Models\Activity;
use App\Models\Finance;
use App\Models\PrayerSchedule;
use App\Models\FridaySchedule; // <--- Jangan lupa import ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Data yang sudah ada sebelumnya
    $today = now()->format('Y-m-d');
    $jadwal = PrayerSchedule::where('date', $today)->first();
    $activities = Activity::latest()->take(3)->get();
    
    // Keuangan (Contoh logika sederhana)
    $pemasukanMasjid = Finance::where('category', 'masjid')->where('type', 'pemasukan')->sum('amount');
    $pengeluaranMasjid = Finance::where('category', 'masjid')->where('type', 'pengeluaran')->sum('amount');
    $saldoMasjid = $pemasukanMasjid - $pengeluaranMasjid;

    $pemasukanYatim = Finance::where('category', 'yatim')->where('type', 'pemasukan')->sum('amount');
    $pengeluaranYatim = Finance::where('category', 'yatim')->where('type', 'pengeluaran')->sum('amount');
    $saldoYatim = $pemasukanYatim - $pengeluaranYatim;

    // --- TAMBAHAN BARU: AMBIL JADWAL JUMAT ---
    // Ambil jadwal jumat mulai dari hari ini ke depan, urutkan tanggal terdekat
    $fridaySchedules = FridaySchedule::where('date', '>=', $today)
        ->orderBy('date', 'asc')
        ->take(4) // Ambil 4 jadwal jumat ke depan
        ->get();

    return view('home', compact(
        'jadwal', 
        'activities', 
        'saldoMasjid', 
        'saldoYatim',
        'fridaySchedules' // <--- Kirim variabel ini ke view
    ));
});

// Route untuk halaman lengkap Jadwal Jumat
    Route::get('/jadwal-jumat', function () {
        // Ambil semua jadwal, urutkan dari tanggal terbaru/terjauh (Future -> Past)
        $schedules = App\Models\FridaySchedule::orderBy('date', 'asc')
            ->where('date', '>=', now()->format('Y-m-d')) // Hanya tampilkan hari ini ke depan (Opsional: hapus baris ini jika ingin menampilkan sejarah lampau)
            ->paginate(10); // Batasi 10 per halaman

        return view('jadwal-jumat', compact('schedules'));
    });