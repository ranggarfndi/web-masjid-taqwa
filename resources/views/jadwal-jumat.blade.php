<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Sholat Jumat Lengkap - Masjid Taqwa</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    @include('components.navbar')

    <header class="bg-emerald-600 text-white py-12 shadow-md relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-yellow-400/20 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Jadwal Petugas Sholat Jum'at</h1>
            <p class="text-emerald-100 opacity-90">Daftar lengkap jadwal khatib dan imam Masjid Taqwa</p>
        </div>
    </header>

    <main class="container mx-auto px-4 -mt-8 mb-16 relative z-20 flex-grow">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-5xl mx-auto border border-gray-100">
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-800 text-sm uppercase tracking-wider border-b border-emerald-100">
                            <th class="py-4 px-6 font-bold">Tanggal</th>
                            <th class="py-4 px-6 font-bold">Waktu</th>
                            <th class="py-4 px-6 font-bold">Khatib</th>
                            <th class="py-4 px-6 font-bold">Imam</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($schedules as $schedule)
                            <tr class="hover:bg-gray-50 transition duration-150 {{ \Carbon\Carbon::parse($schedule->date)->isToday() ? 'bg-yellow-50' : '' }}">
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-800 text-lg">
                                            {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('D MMMM Y') }}
                                        </span>
                                        <span class="text-xs text-gray-500 font-medium">
                                            {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('dddd') }}
                                            @if(\Carbon\Carbon::parse($schedule->date)->isToday())
                                                <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                  Hari Ini
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($schedule->waktu)->format('H:i') }} WIB
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex items-start gap-3">
                                        <div class="bg-blue-100 text-blue-600 p-2 rounded-full shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $schedule->khatib }}</p>
                                            <p class="text-xs text-gray-500">Penceramah</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex items-start gap-3">
                                        <div class="bg-purple-100 text-purple-600 p-2 rounded-full shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $schedule->imam ?? '-' }}</p>
                                            <p class="text-xs text-gray-500">Imam Sholat</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p>Belum ada jadwal yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($schedules->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $schedules->links() }}
                </div>
            @endif
            
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 py-8 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Masjid Taqwa. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>