<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Masjid</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-emerald-700 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <span>Masjid Taqwa</span>
            </a>
            <a href="/admin" class="bg-emerald-800 hover:bg-emerald-900 px-4 py-2 rounded-lg text-sm font-medium transition shadow-md border border-emerald-600">
                Login Pengurus
            </a>
        </div>
    </nav>
    
    <header class="bg-emerald-600 text-white pb-20 pt-10 rounded-b-[3rem] shadow-md relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"><path fill="#FFFFFF" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.3C59.4,45.5,47.9,54.2,35.6,60.8C23.3,67.4,10.2,71.9,-1.8,75C-13.8,78.1,-25.9,79.8,-36.3,75.4C-46.7,71,-55.4,60.5,-63.4,49.2C-71.4,37.9,-78.7,25.8,-80.7,12.7C-82.7,-0.4,-79.4,-14.5,-71.8,-26.4C-64.2,-38.3,-52.3,-48,-40.1,-56.3C-27.9,-64.6,-15.4,-71.5,0.2,-71.8C15.8,-72.1,30.5,-66,44.7,-76.4Z" transform="translate(100 100)" /></svg>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-lg opacity-90 mb-2 font-medium">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h2>
            <h1 class="text-3xl md:text-5xl font-bold mb-8 drop-shadow-md">Jadwal Sholat Hari Ini</h1>

            @if($jadwal)
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-5xl mx-auto">
                    @php
                        $times = [
                            ['Subuh', $jadwal->subuh],
                            // Jika hari ini Jumat, tampilkan waktu Jumat
                            [$jadwal->is_friday ? "Jum'at" : 'Dzuhur', $jadwal->is_friday ? $jadwal->jumat : $jadwal->dzuhur], 
                            ['Ashar', $jadwal->ashar],
                            ['Maghrib', $jadwal->maghrib],
                            ['Isya', $jadwal->isya],
                        ];
                    @endphp

                    @foreach($times as $time)
                        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-2xl hover:bg-white/20 transition transform hover:-translate-y-1 shadow-lg">
                            <p class="text-xs md:text-sm uppercase tracking-wider opacity-80 mb-1 font-semibold">{{ $time[0] }}</p>
                            <p class="text-2xl md:text-3xl font-bold tracking-tight">{{ \Carbon\Carbon::parse($time[1])->format('H:i') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-red-500/20 border border-red-500/50 p-4 rounded-lg inline-block backdrop-blur-sm">
                    ⚠️ Belum ada jadwal sholat diinput untuk tanggal ini.
                </div>
            @endif
        </div>
    </header>

    <main class="container mx-auto px-4 -mt-12 mb-16 space-y-16 flex-grow relative z-20">

        <section class="max-w-5xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="bg-emerald-800 text-white p-4 text-center">
                    <h2 class="text-xl font-bold flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Info Jadwal Jum'at
                    </h2>
                </div>
                
                <div class="p-6 md:p-8">
                    @if(isset($fridaySchedules) && $fridaySchedules->count() > 0)
                        <div class="grid md:grid-cols-3 gap-8">
                            
                            <div class="md:col-span-1">
                                @php $nextFriday = $fridaySchedules->first(); @endphp
                                <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 text-center h-full flex flex-col justify-center shadow-inner">
                                    <span class="text-emerald-600 font-bold text-sm bg-emerald-200/50 px-3 py-1 rounded-full inline-block mb-4 mx-auto">
                                        Jum'at Terdekat
                                    </span>
                                    <h3 class="text-3xl font-bold text-gray-800 mb-1">
                                        {{ \Carbon\Carbon::parse($nextFriday->date)->isoFormat('D MMMM') }}
                                    </h3>
                                    <p class="text-gray-500 mb-6">{{ \Carbon\Carbon::parse($nextFriday->date)->format('Y') }}</p>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Waktu</p>
                                            <p class="text-xl font-bold text-emerald-700">{{ \Carbon\Carbon::parse($nextFriday->waktu)->format('H:i') }} WIB</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Khatib</p>
                                            <p class="font-medium text-gray-800">{{ $nextFriday->khatib }}</p>
                                        </div>
                                        @if($nextFriday->imam)
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Imam</p>
                                            <p class="font-medium text-gray-800">{{ $nextFriday->imam }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                                    Agenda Jum'at Berikutnya
                                </h3>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="text-sm text-gray-500 border-b-2 border-gray-100">
                                                <th class="py-3 font-semibold">Tanggal</th>
                                                <th class="py-3 font-semibold">Waktu</th>
                                                <th class="py-3 font-semibold">Khatib</th>
                                                <th class="py-3 font-semibold">Imam</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm">
                                            @foreach($fridaySchedules as $schedule)
                                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition {{ $loop->first ? 'bg-emerald-50/30' : '' }}">
                                                    <td class="py-4 font-medium {{ $loop->first ? 'text-emerald-700' : 'text-gray-800' }}">
                                                        {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('D MMMM Y') }}
                                                        @if($loop->first) <span class="ml-2 text-[10px] bg-emerald-600 text-white px-2 py-0.5 rounded-full">Besok</span> @endif
                                                    </td>
                                                    <td class="py-4 text-gray-600">{{ \Carbon\Carbon::parse($schedule->waktu)->format('H:i') }}</td>
                                                    <td class="py-4">
                                                        <div class="flex items-center gap-2">
                                                            <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs">🎙️</span>
                                                            {{ $schedule->khatib }}
                                                        </div>
                                                    </td>
                                                    <td class="py-4 text-gray-600">
                                                        {{ $schedule->imam ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <p>Belum ada jadwal Jumat yang diinput.</p>
                        </div>
                    @endif
                    <div class="mt-4 text-right">
                        <a href="/jadwal-jumat" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800 hover:underline transition">
                            Lihat Seluruh Jadwal &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-5xl mx-auto space-y-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-emerald-500 flex items-center justify-between transform hover:scale-[1.02] transition duration-300">
                    <div>
                        <p class="text-gray-500 font-medium text-sm uppercase tracking-wide">Kas Masjid</p>
                        <h3 class="text-3xl font-bold text-emerald-700 mt-1">Rp {{ number_format($saldoMasjid, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-emerald-100 p-4 rounded-full text-emerald-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-yellow-500 flex items-center justify-between transform hover:scale-[1.02] transition duration-300">
                    <div>
                        <p class="text-gray-500 font-medium text-sm uppercase tracking-wide">Santunan Anak Yatim</p>
                        <h3 class="text-3xl font-bold text-yellow-600 mt-1">Rp {{ number_format($saldoYatim, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full text-yellow-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="font-bold text-gray-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Riwayat Transaksi Terakhir
                    </h3>
                    <a href="/laporan-keuangan" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 hover:underline uppercase tracking-wide transition">
                        Lihat Semua Transaksi &rarr;
                    </a>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @if(isset($latestFinances) && count($latestFinances) > 0)
                        @foreach($latestFinances as $finance)
                            <div class="p-4 hover:bg-gray-50 transition flex items-center justify-between group">
                                <div class="flex items-start gap-4">
                                    <div class="p-2 rounded-full shrink-0 {{ $finance->type == 'pemasukan' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        @if($finance->type == 'pemasukan')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm group-hover:text-emerald-700 transition">
                                            {{ $finance->description }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($finance->date)->isoFormat('D MMM Y') }}
                                            </span>
                                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase border {{ $finance->category == 'masjid' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">
                                                {{ ucfirst($finance->category) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-bold text-sm md:text-base {{ $finance->type == 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $finance->type == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center text-gray-400 text-sm italic">
                            Belum ada data transaksi terbaru.
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-emerald-500 pl-4">Kegiatan Masjid</h2>
                <a href="#" class="text-emerald-600 font-medium hover:underline text-sm">Lihat Semua &rarr;</a>
            </div>

            @if($activities->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($activities as $activity)
                        <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 group flex flex-col h-full border border-gray-100">
                            <div class="h-56 overflow-hidden relative">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition z-10"></div>
                                @if($activity->image)
                                    <img 
                                        src="/baca-file/{{ $activity->image }}" 
                                        alt="{{ $activity->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 right-4 z-20">
                                    <span class="bg-white/90 backdrop-blur text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                                        {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 leading-snug group-hover:text-emerald-700 transition mb-3 line-clamp-2">
                                    <a href="#">{{ $activity->title }}</a>
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($activity->content), 100) }}
                                </p>
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <span class="text-sm font-semibold text-emerald-600 group-hover:translate-x-1 transition inline-flex items-center gap-1">
                                        Baca Selengkapnya 
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-xl p-10 text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 font-medium">Belum ada kegiatan terbaru yang diupload.</p>
                </div>
            @endif
        </section>

    </main>

    <footer class="bg-gray-800 text-gray-400 py-10 border-t border-gray-700">
        <div class="container mx-auto px-4 text-center">
            <h4 class="text-white font-bold text-lg mb-2">Masjid Taqwa</h4>
            <p class="mb-6 text-sm opacity-60">Pusat Ibadah dan Kegiatan Umat</p>
            <p class="text-sm">&copy; {{ date('Y') }} Dibuat dengan Laravel & Filament.</p>
        </div>
    </footer>

</body>
</html>