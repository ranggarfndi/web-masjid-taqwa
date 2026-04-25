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
                    'subuh' => '05:15',
                    'dzuhur' => '12:35',
                    'ashar' => '15:45',
                    'maghrib' => '18:40',
                    'isya' => '19:46',
                ]);
            }

            // Jika Hari Jumat, buat juga Jadwal Jumatnya
            $jadwalKhatib = [
                // JANUARI
                '01-02' => 'Fachruddin Lubis, S.Ag',
                '01-09' => 'Rahmad Hidayat, S.Pd.I',
                '01-16' => 'Drs. H. Abdurrasyid Siregar',
                '01-23' => 'Musthofa Ismail, M.Pd',
                '01-30' => 'Drs. H. Sholihul Amri',
                // FEBRUARI
                '02-06' => 'Muslih Sinaga, S.Pd.I',
                '02-13' => 'H. Ahmad Muttaqin Nst, S.Ag',
                '02-20' => 'H. Irham Taufiq, S.Ag',
                '02-27' => 'Khairuddin Daulay, S.Sos. I',
                // MARET
                '03-06' => 'Drs. H. Syamsuddin Ali Kaya',
                '03-13' => 'Drs. H. Marasonang Siregar',
                '03-20' => 'Rahmad Hidayat Tanjung, S.Pd',
                '03-27' => 'Taufik Rahman Sipahutar, S.Sos.I',
                // APRIL
                '04-03' => 'H.Fakhrizal, MA',
                '04-10' => 'Ramli Tanjung, S.Sos.I',
                '04-17' => 'Ramadhansyah Batubara, S.Pd',
                '04-24' => 'Imron Rosadi, S.Sos',
                // MEI
                '05-01' => 'M. Saifullah Siregar, S.Pd.I',
                '05-08' => 'H. Sarwo Edi Harahap, S.Ag',
                '05-15' => 'Drs. H. Khairul Akmal Rangkuti',
                '05-22' => 'H. Jakfar Hasibuan, S.Pd.I',
                '05-29' => 'Musthofa Ismail, M.Pd',
                // JUNI
                '06-05' => 'M. Ali Murtadho Hasibuan, M.Pd',
                '06-12' => 'Drs. M. Faisal Assyafii',
                '06-19' => 'Budi Kurniawan, S.Pd.I',
                '06-26' => 'H. Amiruddin Munthe, MA',
                // JULI
                '07-02' => 'H. Jakfar Hasibuan, S.Pd.I',
                '07-09' => 'Maraiddin Siregar, S.Pd.I',
                '07-16' => 'H. Fakhrizal, MA',
                '07-23' => 'Drs. H. Syamsuddin Ali Jaya',
                '07-30' => 'Drs. Saleh Rambe',
                // AGUSTUS
                '08-07' => 'Abdul Aziz, S.Pd.I',
                '08-14' => 'H. Irham Taufiq, S.Ag',
                '08-21' => 'H. Ahmad Muttaqin Nst, S.Ag',
                '08-28' => 'Drs. M. Ridwan',
                // SEPTEMBER
                '09-04' => 'M. Ali Murtadho Hasibuan, M.Pd',
                '09-11' => 'H. Sarwo Edi Harahap, S.Ag',
                '09-18' => 'Drs. H. Ismail Mukthar',
                '09-25' => 'Taufik Rahman Sipahutar, S.Sos.I',
                // OKTOBER
                '10-02' => 'M. Ridwan, S.Pd.I',
                '10-09' => 'Bardansyah Nst, S.Hi, S.Pd.I, M.Pd',
                '10-16' => 'H. Badu Amin Nasution',
                '10-23' => 'Ramli Tanjung, S.Sos.I',
                '10-30' => 'Dr. Imam Yazid, MA',
                // NOVEMBER
                '11-06' => 'Drs. H. Abdurrasyid Siregar',
                '11-13' => 'Drs. H. Marasonang Siregar',
                '11-20' => 'Drs. H. Khairul Akmal Rangkuti',
                '11-27' => 'Khairuddin Daulay, S.Sos.I',
                // DESEMBER
                '12-04' => 'Budi Kurniawan, S.Pd.I',
                '12-11' => 'H. Amiruddin Munthe, MA',
                '12-18' => 'Drs. H. Ismail Mukhtar',
                '12-25' => 'Drs. Saleh Rambe',
            ];

            if ($startDate->isFriday()) {
                // Ambil format bulan-hari dari tanggal saat ini (misal: '01-02')
                $monthDay = $startDate->format('m-d');
                
                // Cek apakah ada di array jadwal poster. Jika tidak ada, gunakan fake data.
                $namaKhatib = $jadwalKhatib[$monthDay] ?? 'Ust. ' . fake()->name('male');

                if (!FridaySchedule::where('date', $dateStr)->exists()) {
                    FridaySchedule::create([
                        'date'   => $dateStr,
                        'waktu'  => '12:40',
                        'khatib' => $namaKhatib,
                        // Karena di poster tidak ada nama Imam, kita tetap pakai data acak atau sesuaikan
                        'imam'   => $namaKhatib, 
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
        // for ($i = 0; $i < 50; $i++) {
        //     $type = fake()->randomElement(['pemasukan', 'pengeluaran']);
        //     $category = fake()->randomElement(['masjid', 'yatim']);
            
        //     Finance::create([
        //         'date' => fake()->dateTimeBetween('-3 months', 'now'), // Tanggal acak 3 bulan terakhir
        //         'category' => $category,
        //         'type' => $type,
        //         'amount' => fake()->numberBetween(50000, 5000000), // Angka antara 50rb - 5jt
        //         'description' => $type == 'pemasukan' 
        //             ? 'Infaq Hamba Allah (' . fake()->dayOfWeek() . ')'
        //             : 'Biaya Operasional / Santunan',
        //     ]);
        // }

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