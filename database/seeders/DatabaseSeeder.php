<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrayerSchedule;
use App\Models\FridaySchedule;
use App\Models\Finance;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin (Jika belum ada)
        User::firstOrCreate([
            'email' => 'adminmasjid@gmail.com',
        ], [
            'name' => 'Admin Masjid',
            'password' => bcrypt('password'), // Password default: password
        ]);

        // ==========================================
        // 2. GENERATE JADWAL SHOLAT (Harian & Jumat)
        // ==========================================
        
        // Kita buat jadwal dari 1 bulan lalu sampai 1 bulan ke depan
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now()->addMonth();

        while ($startDate->lte($endDate)) {
            $dateStr = $startDate->format('Y-m-d');

            // Cek apakah jadwal tanggal ini sudah ada? Kalau belum, buat.
            if (!PrayerSchedule::where('date', $dateStr)->exists()) {
                PrayerSchedule::create([
                    'date' => $dateStr,
                    'subuh' => '04:50',
                    'dzuhur' => '12:15',
                    'ashar' => '15:30',
                    'maghrib' => '18:10',
                    'isya' => '19:20',
                ]);
            }

            // Jika Hari Jumat, buat juga Jadwal Jumatnya
            if ($startDate->isFriday()) {
                if (!FridaySchedule::where('date', $dateStr)->exists()) {
                    FridaySchedule::create([
                        'date' => $dateStr,
                        'waktu' => '12:00',
                        'khatib' => 'Ust. ' . fake()->name('male'), // Nama acak
                        'imam' => 'Ust. ' . fake()->firstName('male'),
                    ]);
                }
            }

            // Lanjut ke hari besoknya
            $startDate->addDay();
        }

        // ==========================================
        // 3. GENERATE KEUANGAN (Infaq & Pengeluaran)
        // ==========================================
        
        // Buat 50 Transaksi Acak
        for ($i = 0; $i < 50; $i++) {
            $type = fake()->randomElement(['pemasukan', 'pengeluaran']);
            $category = fake()->randomElement(['masjid', 'yatim']);
            
            Finance::create([
                'date' => fake()->dateTimeBetween('-3 months', 'now'), // Tanggal acak 3 bulan terakhir
                'category' => $category,
                'type' => $type,
                'amount' => fake()->numberBetween(50000, 5000000), // Angka antara 50rb - 5jt
                'description' => $type == 'pemasukan' 
                    ? 'Infaq Hamba Allah (' . fake()->dayOfWeek() . ')'
                    : 'Biaya Operasional / Santunan',
            ]);
        }

        // ==========================================
        // 4. GENERATE KEGIATAN (Artikel)
        // ==========================================
        
        for ($i = 0; $i < 10; $i++) {
            $title = fake()->sentence(6); // Judul 6 kata
            
            Activity::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'date' => fake()->dateTimeBetween('-2 months', 'now'),
                'image' => null, // Biarkan null (akan pakai placeholder di view)
                'content' => fake()->paragraphs(3, true), // 3 Paragraf teks
            ]);
        }
    }
}