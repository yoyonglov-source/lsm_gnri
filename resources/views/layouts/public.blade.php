
<!-- MAIN NAVBAR -->
<header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm" x-data="{ openMobile: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-3 flex items-center justify-between">
        
        <!-- LOGO & BRAND (BUKAN LINK) -->
        <div class="flex items-center gap-3.5 select-none">
            <!-- Logo Diperbesar -->
            <img src="{{ asset('storage/logo_kiri.png') }}" alt="Logo GNRI" class="h-16 w-auto object-contain">
            <div>
                <!-- Tulisan GNRI Merah Hati (#C8102E) -->
                <h1 class="text-2xl font-black text-[#C8102E] tracking-tight leading-none">
                    GNRI
                </h1>
                <p class="text-[9.5px] font-extrabold text-[#1B1B1B] tracking-wider uppercase leading-tight mt-0.5">
                    GERAKAN NAWACITA<br>RAKYAT INDONESIA
                </p>
            </div>
        </div>

        <!-- DESKTOP NAVIGATION MENU -->
        <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-700">
            
            <!-- Beranda -->
            <a href="/" class="text-[#C8102E] font-bold hover:text-[#C8102E] transition">
                Beranda
            </a>

            <!-- Dropdown: Tentang GNRI -->
            <div class="relative group" x-data="{ open: false }" @mouseleave="open = false">
                <button @mouseover="open = true" class="flex items-center gap-1 hover:text-[#C8102E] transition py-2">
                    <span>Tentang GNRI</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-[#C8102E] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Sejarah</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Visi & Misi</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Nilai Organisasi</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Tujuan & Fokus</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Legalitas</a>
                </div>
            </div>

            <!-- Dropdown: Organisasi -->
            <div class="relative group" x-data="{ open: false }" @mouseleave="open = false">
                <button @mouseover="open = true" class="flex items-center gap-1 hover:text-[#C8102E] transition py-2">
                    <span>Organisasi</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-[#C8102E] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Struktur DPP</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Struktur DPW</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Struktur DPD</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Struktur DPC</a>
                </div>
            </div>

            <!-- Dropdown: Program & Kegiatan -->
            <div class="relative group" x-data="{ open: false }" @mouseleave="open = false">
                <button @mouseover="open = true" class="flex items-center gap-1 hover:text-[#C8102E] transition py-2">
                    <span>Program & Kegiatan</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-[#C8102E] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Program Kerja</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Kegiatan</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Galeri</a>
                </div>
            </div>

            <!-- Dropdown: Keanggotaan -->
            <div class="relative group" x-data="{ open: false }" @mouseleave="open = false">
                <button @mouseover="open = true" class="flex items-center gap-1 hover:text-[#C8102E] transition py-2">
                    <span>Keanggotaan</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-[#C8102E] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                    <a href="/register" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Pendaftaran Anggota</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Data Anggota</a>
                    <a href="#" class="block px-4 py-2 text-xs hover:bg-slate-50 hover:text-[#C8102E]">Cek Keanggotaan</a>
                </div>
            </div>

            <a href="#" class="hover:text-[#C8102E] transition">Berita</a>
            <a href="#" class="hover:text-[#C8102E] transition">Kontak</a>
        </nav>

        <!-- TOMBOL JOIN US -->
        <div class="hidden lg:flex items-center">
            <a href="/register" class="bg-[#C8102E] hover:bg-[#A00C23] text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center gap-2 shadow-md hover:shadow-lg transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                <span>JOIN US</span>
            </a>
        </div>

        <!-- HAMBURGER MOBILE BUTTON -->
        <button @click="openMobile = !openMobile" class="lg:hidden text-slate-700 p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>
</header>