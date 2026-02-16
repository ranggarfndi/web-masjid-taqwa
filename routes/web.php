<?php

use App\Models\Activity;
use App\Models\Finance;
use App\Models\PrayerSchedule;
use App\Models\FridaySchedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| JALUR PENYELAMAT GAMBAR (Khusus Windows/Laragon yang bermasalah symlink)
|--------------------------------------------------------------------------
*/
Route::get('/baca-file/{filepath}', function ($filepath) {
    // Cari lokasi asli file di storage/app/public
    $path = storage_path('app/public/' . $filepath);

    // Kalau file tidak ketemu, error 404
    if (!file_exists($path)) {
        abort(404);
    }

    // Kalau ketemu, tampilkan filenya ke browser
    return Response::file($path);
})->where('filepath', '.*');


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA (HOME)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $today = now()->format('Y-m-d');
    
    // 1. Data Jadwal Sholat Hari Ini
    $jadwal = PrayerSchedule::where('date', $today)->first();
    
    // 2. Data Kegiatan (3 Terbaru)
    $activities = Activity::latest()->take(3)->get();
    
    // 3. Data Jadwal Jumat (4 ke depan)
    $fridaySchedules = FridaySchedule::where('date', '>=', $today)
        ->orderBy('date', 'asc')
        ->take(4)
        ->get();

    // 4. LOGIKA KEUANGAN (SALDO)
    $pemasukanMasjid = Finance::where('category', 'masjid')->where('type', 'pemasukan')->sum('amount');
    $pengeluaranMasjid = Finance::where('category', 'masjid')->where('type', 'pengeluaran')->sum('amount');
    $saldoMasjid = $pemasukanMasjid - $pengeluaranMasjid;

    $pemasukanYatim = Finance::where('category', 'yatim')->where('type', 'pemasukan')->sum('amount');
    $pengeluaranYatim = Finance::where('category', 'yatim')->where('type', 'pengeluaran')->sum('amount');
    $saldoYatim = $pemasukanYatim - $pengeluaranYatim;

    // 5. RIWAYAT TRANSAKSI TERBARU (Untuk List di Home)
    // Ambil 6 transaksi terakhir, urutkan dari yang paling baru
    $latestFinances = Finance::latest('date') 
        ->take(6)
        ->get();

    return view('home', compact(
        'jadwal', 
        'activities', 
        'fridaySchedules', 
        'saldoMasjid', 
        'saldoYatim',
        'latestFinances' // <--- Variabel baru untuk riwayat di home
    ));
});


/*
|--------------------------------------------------------------------------
| HALAMAN KHUSUS: JADWAL JUMAT LENGKAP
|--------------------------------------------------------------------------
*/
Route::get('/jadwal-jumat', function () {
    // Ambil semua jadwal, urutkan dari tanggal terdekat ke masa depan
    $schedules = FridaySchedule::orderBy('date', 'asc')
        ->where('date', '>=', now()->format('Y-m-d')) 
        ->paginate(10); 

    return view('jadwal-jumat', compact('schedules'));
});


/*
|--------------------------------------------------------------------------
| HALAMAN KHUSUS: LAPORAN KEUANGAN LENGKAP
|--------------------------------------------------------------------------
*/
Route::get('/laporan-keuangan', function () {
    // Ambil semua data keuangan, urutkan dari yang terbaru (descending)
    // Paginate 20 baris per halaman
    $finances = Finance::latest('date')->paginate(20);
    
    return view('keuangan', compact('finances'));
});