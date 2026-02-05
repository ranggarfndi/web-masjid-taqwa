<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activity->title }} - Web Masjid</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .article-content h2 { font-size: 1.5rem; font-weight: bold; margin-top: 1.5rem; margin-bottom: 0.5rem; }
        .article-content p { margin-bottom: 1rem; line-height: 1.7; }
        .article-content ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1rem; }
        .article-content ol { list-style-type: decimal; margin-left: 1.5rem; margin-bottom: 1rem; }
        .article-content blockquote { border-left: 4px solid #10b981; padding-left: 1rem; font-style: italic; color: #555; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <span>Masjid Al-Ikhlas</span>
            </a>
            <a href="/" class="text-emerald-100 hover:text-white transition">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-12 flex-grow">
        <article class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            
            @if($activity->image)
                <div class="h-64 md:h-96 w-full overflow-hidden">
                    <img 
                        src="{{ asset('storage/' . $activity->image) }}" 
                        alt="{{ $activity->title }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                    >
                </div>
            @endif

            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span class="flex items-center gap-1">
                        📅 {{ \Carbon\Carbon::parse($activity->date)->format('d F Y') }}
                    </span>
                    <span class="text-emerald-500">•</span>
                    <span class="text-emerald-600 font-semibold">Berita Kegiatan</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 leading-tight">
                    {{ $activity->title }}
                </h1>

                <div class="article-content text-gray-700 text-lg">
                    {!! $activity->content !!}
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100">
                    <a href="/" class="inline-flex items-center text-emerald-600 font-bold hover:underline">
                        &larr; Lihat Kegiatan Lainnya
                    </a>
                </div>
            </div>

        </article>
    </main>

    <footer class="bg-gray-800 text-gray-400 py-8 text-center mt-12">
        <p>&copy; {{ date('Y') }} Masjid Al-Ikhlas. Dibuat dengan Laravel & Filament.</p>
    </footer>

</body>
</html>