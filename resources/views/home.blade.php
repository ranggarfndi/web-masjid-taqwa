<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Masjid</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <span>Masjid Taqwa</span>
            </a>
            <a href="/admin" class="bg-emerald-800 hover:bg-emerald-900 px-4 py-2 rounded-lg text-sm font-medium transition">
                Login Pengurus
            </a>
        </div>
    </nav>
    
    <header class="bg-emerald-600 text-white pb-12 pt-8 rounded-b-[3rem] shadow-md">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-lg opacity-90 mb-2">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h2>
            <h1 class="text-3xl md:text-5xl font-bold mb-8">Jadwal Sholat Hari Ini</h1>

            @if($jadwal)
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-4xl mx-auto">
                    @php
                        $times = [
                            ['Subuh', $jadwal->subuh],
                            // Logika Khusus Dzuhur/Jumat
                            [$jadwal->is_friday ? "Jum'at" : 'Dzuhur', $jadwal->is_friday ? $jadwal->waktu_jumat : $jadwal->dzuhur],
                            ['Ashar', $jadwal->ashar],
                            ['Maghrib', $jadwal->maghrib],
                            ['Isya', $jadwal->isya],
                        ];
                    @endphp

                    @foreach($times as $time)
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 p-4 rounded-xl hover:bg-white/20 transition">
                            <p class="text-sm uppercase tracking-wider opacity-80 mb-1">{{ $time[0] }}</p>
                            <p class="text-2xl font-bold">{{ \Carbon\Carbon::parse($time[1])->format('H:i') }}</p>
                        </div>
                    @endforeach
                </div>

                @if($jadwal->is_friday && $jadwal->khatib)
                    <div class="mt-6 bg-yellow-500/20 inline-block px-6 py-2 rounded-full border border-yellow-400/50">
                        <span class="font-semibold">🎙️ Khatib Jum'at:</span> {{ $jadwal->khatib }}
                    </div>
                @endif
            @else
                <div class="bg-red-500/20 border border-red-500/50 p-4 rounded-lg inline-block">
                    ⚠️ Belum ada jadwal sholat diinput untuk tanggal ini.
                </div>
            @endif
        </div>
    </header>

    <main class="container mx-auto px-4 -mt-8 mb-16 space-y-12 flex-grow">

        <section class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-emerald-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Kas Masjid</p>
                    <h3 class="text-3xl font-bold text-emerald-700">Rp {{ number_format($saldoMasjid, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-emerald-100 p-3 rounded-full text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-yellow-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Santunan Anak Yatim</p>
                    <h3 class="text-3xl font-bold text-yellow-600">Rp {{ number_format($saldoYatim, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 border-b-4 border-emerald-500 inline-block pb-1">Kegiatan Masjid</h2>
            </div>

            @if($activities->count() > 0)
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($activities as $activity)
                        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="h-48 overflow-hidden">
                                @if($activity->image)
                                    <img 
                                        src="{{ asset('storage/' . $activity->image) }}" 
                                        alt="{{ $activity->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                            </div>
                            <div class="p-5">
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded">
                                    {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                                </span>
                                <h3 class="mt-2 text-xl font-bold text-gray-800 leading-tight group-hover:text-emerald-600 transition">
                                    <a href="/kegiatan/{{ $activity->slug }}">{{ $activity->title }}</a>
                                </h3>
                                <div class="mt-4">
                                    <a href="/kegiatan/{{ $activity->slug }}" class="text-sm font-semibold text-emerald-600 hover:underline">Baca Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-10">Belum ada kegiatan terbaru.</p>
            @endif
        </section>

    </main>

    <footer class="bg-gray-800 text-gray-400 py-8 text-center">
        <p>&copy; {{ date('Y') }} Masjid Taqwa. Dibuat dengan Laravel & Filament.</p>
    </footer>

</body>
</html>