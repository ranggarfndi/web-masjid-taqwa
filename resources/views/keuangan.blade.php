<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Masjid Taqwa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-emerald-700 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-lg font-bold flex items-center gap-2 hover:text-emerald-100 transition">
                &larr; Kembali ke Beranda
            </a>
            <span class="font-semibold opacity-90">Transparansi Umat</span>
        </div>
    </nav>

    <header class="bg-white shadow-sm py-8 mb-8 border-b border-gray-200">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Laporan Keuangan Masjid</h1>
            <p class="text-gray-500">Rekapitulasi Infaq Masjid & Santunan Anak Yatim</p>
        </div>
    </header>

    <main class="container mx-auto px-4 mb-16 flex-grow">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 max-w-6xl mx-auto">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                            <th class="py-4 px-6 font-bold">Tanggal</th>
                            <th class="py-4 px-6 font-bold">Kategori</th>
                            <th class="py-4 px-6 font-bold">Keterangan</th>
                            <th class="py-4 px-6 font-bold text-right">Masuk (Rp)</th>
                            <th class="py-4 px-6 font-bold text-right">Keluar (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($finances as $finance)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($finance->date)->format('d M Y') }}
                                </td>

                                <td class="py-4 px-6">
                                    <span class="px-2 py-1 rounded-md text-xs font-bold border {{ $finance->category == 'masjid' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">
                                        {{ ucfirst($finance->category) }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 font-medium text-gray-800">
                                    {{ $finance->description }}
                                </td>

                                <td class="py-4 px-6 text-right">
                                    @if($finance->type == 'pemasukan')
                                        <span class="text-green-600 font-bold bg-green-50 px-2 py-1 rounded">
                                            + {{ number_format($finance->amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-right">
                                    @if($finance->type == 'pengeluaran')
                                        <span class="text-red-500 font-bold bg-red-50 px-2 py-1 rounded">
                                            - {{ number_format($finance->amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-400">
                                    Belum ada data keuangan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $finances->links() }}
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 py-8 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Masjid Taqwa. Transparansi untuk Umat.</p>
    </footer>

</body>
</html>