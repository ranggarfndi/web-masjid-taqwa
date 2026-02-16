<nav class="bg-emerald-700 text-white shadow-lg sticky top-0 z-50 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            
            <a href="/" class="text-xl font-bold flex items-center gap-2 hover:text-emerald-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <span>Masjid Taqwa</span>
            </a>

            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="px-3 py-2 rounded-md text-sm font-medium transition {{ request()->is('/') ? 'bg-emerald-800 text-white' : 'hover:bg-emerald-600 hover:text-white' }}">
                    Beranda
                </a>
                
                <a href="/jadwal-jumat" class="px-3 py-2 rounded-md text-sm font-medium transition {{ request()->is('jadwal-jumat*') ? 'bg-emerald-800 text-white' : 'hover:bg-emerald-600 hover:text-white' }}">
                    Jadwal Jumat
                </a>

                <a href="/laporan-keuangan" class="px-3 py-2 rounded-md text-sm font-medium transition {{ request()->is('laporan-keuangan*') ? 'bg-emerald-800 text-white' : 'hover:bg-emerald-600 hover:text-white' }}">
                    Laporan Keuangan
                </a>

                <a href="/kegiatan" class="px-3 py-2 rounded-md text-sm font-medium transition {{ request()->is('kegiatan*') ? 'bg-emerald-800 text-white' : 'hover:bg-emerald-600 hover:text-white' }}">
                    Kegiatan
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="/admin" class="hidden md:inline-flex bg-white text-emerald-700 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-bold transition shadow-sm">
                    Login Pengurus
                </a>

                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-md hover:bg-emerald-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-emerald-800 border-t border-emerald-600">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-emerald-900 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">Beranda</a>
            <a href="/jadwal-jumat" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('jadwal-jumat*') ? 'bg-emerald-900 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">Jadwal Jumat</a>
            <a href="/laporan-keuangan" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('laporan-keuangan*') ? 'bg-emerald-900 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">Keuangan</a>
            <a href="/kegiatan" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('kegiatan*') ? 'bg-emerald-900 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">Kegiatan</a>
            <a href="/admin" class="block px-3 py-2 rounded-md text-base font-medium bg-emerald-600 text-white mt-4 text-center">Login Pengurus</a>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</nav>