<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activity->title }} - Masjid Taqwa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .prose p { margin-bottom: 1.5em; line-height: 1.8; }
        .prose h2 { font-size: 1.5em; font-weight: bold; margin-top: 1.5em; margin-bottom: 0.5em; color: #064e3b; }
        .prose ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.5em; }
        .prose ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.5em; }
        .prose blockquote { border-left: 4px solid #10b981; padding-left: 1em; font-style: italic; color: #4b5563; background: #f0fdf4; padding: 1rem; border-radius: 0 0.5rem 0.5rem 0; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-emerald-700 flex items-center gap-2">
                Masjid Taqwa
            </a>
            <a href="/kegiatan" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition">
                &larr; Lihat Semua Kegiatan
            </a>
        </div>
    </nav>

    <main class="flex-grow">
        
        <header class="bg-white pb-10">
            <div class="max-w-4xl mx-auto px-4 pt-8">
                <div class="mb-6 flex items-center gap-4 text-sm text-gray-500">
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-bold">Kegiatan</span>
                    <span>&bull;</span>
                    <span>{{ \Carbon\Carbon::parse($activity->date)->isoFormat('dddd, D MMMM Y') }}</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight mb-8">
                    {{ $activity->title }}
                </h1>

                @if($activity->image)
                    <div class="rounded-2xl overflow-hidden shadow-2xl mb-10 aspect-video relative">
                         <img 
                            src="/baca-file/{{ $activity->image }}" 
                            alt="{{ $activity->title }}" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                @endif
            </div>
        </header>

        <article class="max-w-3xl mx-auto px-4 mb-16">
            <div class="bg-white md:p-10 p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="prose text-gray-700 text-lg">
                    {!! $activity->content !!}
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between border-t border-gray-200 pt-6">
                <span class="text-gray-500 font-medium">Bagikan kegiatan ini:</span>
                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">Facebook</button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-600 transition">WhatsApp</button>
                </div>
            </div>
        </article>

        @if($relatedActivities->count() > 0)
            <section class="bg-gray-100 py-16">
                <div class="container mx-auto px-4 max-w-6xl">
                    <h3 class="text-2xl font-bold text-gray-800 mb-8 border-l-4 border-emerald-500 pl-4">Kegiatan Lainnya</h3>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($relatedActivities as $related)
                            <a href="/kegiatan/{{ $related->slug }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                                <div class="h-40 overflow-hidden">
                                    @if($related->image)
                                        <img src="/baca-file/{{ $related->image }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full bg-gray-200"></div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <p class="text-xs text-gray-400 mb-1">{{ \Carbon\Carbon::parse($related->date)->format('d M Y') }}</p>
                                    <h4 class="font-bold text-gray-800 group-hover:text-emerald-600 transition line-clamp-2">
                                        {{ $related->title }}
                                    </h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </main>

    <footer class="bg-gray-800 text-gray-400 py-10 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Masjid Taqwa.</p>
    </footer>

</body>
</html>