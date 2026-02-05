<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Finance;
use App\Models\PrayerSchedule;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Jadwal Sholat Hari Ini
        $today = Carbon::today();
        $jadwal = PrayerSchedule::whereDate('date', $today)->first();

        // 2. Hitung Saldo Infaq Masjid (Masuk - Keluar)
        $pemasukanMasjid = Finance::where('category', 'masjid')->where('type', 'pemasukan')->sum('amount');
        $pengeluaranMasjid = Finance::where('category', 'masjid')->where('type', 'pengeluaran')->sum('amount');
        $saldoMasjid = $pemasukanMasjid - $pengeluaranMasjid;

        // 3. Hitung Saldo Infaq Anak Yatim (Masuk - Keluar)
        $pemasukanYatim = Finance::where('category', 'yatim')->where('type', 'pemasukan')->sum('amount');
        $pengeluaranYatim = Finance::where('category', 'yatim')->where('type', 'pengeluaran')->sum('amount');
        $saldoYatim = $pemasukanYatim - $pengeluaranYatim;

        // 4. Ambil 3 Kegiatan Terbaru
        $activities = Activity::latest()->take(3)->get();

        return view('home', compact('jadwal', 'saldoMasjid', 'saldoYatim', 'activities'));
    }
}