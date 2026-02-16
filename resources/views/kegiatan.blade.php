<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Masjid - Masjid Taqwa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    @include('components.navbar')

    <header class="bg-white border-b border-gray-200 py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Arsip Kegiatan Masjid</h1>
            <p class="text-gray-500 max-w-2xl mx-auto">Dokumentasi kegiatan ibadah, sosial, dan acara keagamaan yang telah dilaksanakan di Masjid Taqwa.</p>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12 flex-grow">
        @if($activities->count() > 0)
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($activities as $activity)
                    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col h-full">
                        <div class="h-56 overflow-hidden relative">
                            <a href="/kegiatan/{{ $activity->slug }}">
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition z-10"></div>
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
                            </a>
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-lg shadow-sm">
                                    {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-bold text-gray-800 leading-snug group-hover:text-emerald-700 transition mb-3">
                                <a href="/kegiatan/{{ $activity->slug }}">{{ $activity->title }}</a>
                            </h2>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                {{ Str::limit(strip_tags($activity->content), 120) }}
                            </p>
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <a href="/kegiatan/{{ $activity->slug }}" class="text-sm font-semibold text-emerald-600 hover:underline">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $activities->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-400">Belum ada kegiatan yang ditemukan.</p>
                <a href="/" class="text-emerald-600 font-bold mt-2 inline-block">Kembali ke Beranda</a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-800 text-gray-400 py-8 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Masjid Taqwa. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>