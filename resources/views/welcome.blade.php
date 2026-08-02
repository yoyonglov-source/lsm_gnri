<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GNRI - Gerakan Nawacita Rakyat Indonesia</title>

    <!-- Font Poppins (Sesuai Asset Warna & Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome Font for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite (Tailwind & Alpine JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#F5F5F5] text-[#1B1B1B] antialiased">

    <!-- TOP BAR (BAR MERAH ATAS) -->
    <div style="background-color: #C8102E;" class="text-white py-1.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Text Slogan (Pakai style font-size murni) -->
            

            <!-- Social Media Icons -->
            <div class="flex items-center gap-4 text-white/90">
                <a href="#" class="hover:text-white transition"><i class="fab fa-facebook-f text-xs"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-instagram text-xs"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-youtube text-xs"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fas fa-envelope text-xs"></i></a>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm" x-data="{ openMobile: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-3 flex items-center justify-between">
            
            <!-- LOGO & BRAND -->
            <div class="flex items-center gap-3.5 select-none">
                <!-- Logo Diperbesar via Style Murni -->
                <img src="{{ asset('storage/logo_kiri.png') }}" alt="Logo GNRI" style="height: 80px;" class="w-auto object-contain">
                <div>
                    <!-- Tulisan GNRI Merah Hati Murni -->
                    <h1 style="color: #C8102E;" class="text-2xl font-black tracking-tight leading-none">
                        GNRI
                    </h1>
                    <p style="font-size: 9.5px; color: #1B1B1B;" class="font-extrabold tracking-wider uppercase leading-tight mt-0.5">
                        GERAKAN NAWACITA<br>RAKYAT INDONESIA
                    </p>
                </div>
            </div>

            <!-- DESKTOP NAVIGATION MENU -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-700">
                <a href="/" style="color: #C8102E;" class="font-bold hover:opacity-80 transition">
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
                <a href="/register" style="background-color: #C8102E;" class="hover:opacity-90 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center gap-2 shadow-md hover:shadow-lg transition-all duration-200">
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

    <!-- CONTENT PLACEHOLDER -->
    <main>
        <!-- HERO BANNER SECTION (STATIC) -->
        <section class="relative w-full overflow-hidden bg-slate-100">
            <!-- Height Container: Ditinggikan sedikit di lg agar area orang di bawah dapet ruang -->
            <div class="relative w-full h-[480px] sm:h-[540px] lg:h-[640px]">
                
                <!-- Hero Background Image -->
                <!-- object-bottom / object-[80%_100%] memastikan area bawah (orang-orang) & kanan (bendera) tidak terpotong -->
                <img 
                    src="{{ asset('build/assets/hero.png') }}" 
                    alt="Hero GNRI" 
                    class="w-full h-full object-cover object-bottom lg:object-[80%_100%]"
                >

                <!-- Soft Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/60 to-transparent lg:from-white/90 lg:via-white/40"></div>

                <!-- Content Area -->
                <div class="absolute inset-0 max-w-7xl mx-auto px-6 sm:px-12 flex items-center z-10">
                    <div class="max-w-xl pb-12 lg:pb-16">
                        
                        <!-- Title 1: BERSAMA MEMBANGUN -->
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#1B1B1B] tracking-tight uppercase leading-snug">
                            BERSAMA MEMBANGUN
                        </h2>
                        
                        <!-- Title 2: NEGERI -->
                        <h1 style="color: #C8102E;" class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight uppercase leading-none mt-0.5">
                            NEGERI
                        </h1>

                        <!-- Deskripsi Teks -->
                        <p class="text-slate-700 text-xs sm:text-sm font-medium mt-3 leading-relaxed max-w-md">
                            GNRI hadir untuk masyarakat, berkontribusi nyata dalam pemberdayaan, persatuan, dan kemajuan bangsa Indonesia.
                        </p>

                        <!-- Tombol Selengkapnya -->
                        <div class="mt-6">
                            <a href="#" style="background-color: #C8102E;" class="inline-flex items-center gap-2.5 text-white font-semibold text-xs px-5 py-2.5 rounded-full shadow-md hover:opacity-90 transition-all duration-200 group">
                                <span>Selengkapnya</span>
                                <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:translate-x-1 transition-transform">
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- 6 NILAI UTAMA SECTION (FLOATING CARD) -->
        <section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-14 lg:-mt-16 mb-12">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6 sm:p-8">
                <!-- Grid 6 Kolom di Desktop, 2 Kolom di HP -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 lg:gap-0 divide-y md:divide-y-0 lg:divide-x divide-slate-100">
                    
                    <!-- 1. Persaudaraan -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-users-between-lines text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Persaudaraan</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Memperkuat persaudaraan dalam keberagaman
                        </p>
                    </div>

                    <!-- 2. Persatuan -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-handshake text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Persatuan</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Bersatu menjaga keutuhan NKRI
                        </p>
                    </div>

                    <!-- 3. Gotong Royong -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-[#C8102E] fa-people-carry-box text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Gotong Royong</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Bekerja bersama untuk kebaikan bersama
                        </p>
                    </div>

                    <!-- 4. Integritas -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-bullseye text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Integritas</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Jujur, bertanggung jawab, dan dapat dipercaya
                        </p>
                    </div>

                    <!-- 5. Kepedulian Sosial -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-hand-holding-heart text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Kepedulian Sosial</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Hadir dan peduli untuk masyarakat
                        </p>
                    </div>

                    <!-- 6. Profesionalisme -->
                    <div class="flex flex-col items-center text-center px-3 pt-2 lg:pt-0">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center text-[#C8102E]">
                            <i class="fas fa-award text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm mb-1">Profesionalisme</h3>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight">
                            Bekerja secara profesional dan berorientasi hasil
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- TENTANG GNRI SECTION -->
        <section class="relative py-12 lg:py-16 overflow-hidden bg-slate-50/50">
            
            <!-- WATERMARK MAP INDONESIA ABU-ABU TIPIS -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-full lg:w-3/5 h-full pointer-events-none opacity-20 flex items-center justify-end pr-4 lg:pr-10 z-0">
                <img src="{{ asset('build/assets/map.png') }}" alt="Map Indonesia Watermark" class="w-full max-w-2xl h-auto object-contain">
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- FOTO SAMPING -->
                    <div class="lg:col-span-5 relative">
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="{{ asset('build/assets/about.png') }}" alt="About Image" class="w-full h-auto object-cover" />
                            <div class="absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#C8102E]/80 to-transparent pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- DESKRIPSI TENTANG GNRI -->
                    <div class="lg:col-span-7">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B1B] tracking-tight uppercase">
                            TENTANG <span style="color: #C8102E;">GNRI</span>
                        </h2>

                        <p class="mt-4 text-slate-600 text-xs sm:text-sm font-normal leading-relaxed max-w-2xl">
                            Gerakan Nawacita Rakyat Indonesia (GNRI) merupakan organisasi masyarakat yang berkomitmen untuk berkontribusi dalam berbagai bidang kehidupan masyarakat. GNRI hadir sebagai wadah persatuan, kepedulian, dan pemberdayaan masyarakat demi terwujudnya kehidupan yang lebih baik.
                        </p>

                        <div class="mt-6">
                            <a href="#" style="background-color: #C8102E;" class="inline-flex items-center gap-3 text-white font-semibold text-xs px-6 py-3 rounded-full shadow-md hover:opacity-90 transition-all duration-200 group">
                                <span>Profil Lengkap</span>
                                <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:translate-x-1 transition-transform">
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- STATISTIK / COUNTER SECTION (RED BAR) -->
        <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 mb-16 z-20">
            <div class="bg-gradient-to-r from-[#b80a1d] via-[#a60819] to-[#8d0013] text-white rounded-2xl shadow-xl px-6 py-4 lg:py-5">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-0 divide-y sm:divide-y-0 lg:divide-x divide-white/20">
                    
                    <!-- 1. Provinsi -->
                    <div class="flex items-center justify-center gap-3.5 px-2 py-2 lg:py-0">
                        <div class="text-white/90 text-2xl lg:text-3xl flex-shrink-0">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="text-xl lg:text-2xl font-extrabold tracking-tight leading-none">
                                34+
                            </div>
                            <div class="text-[11px] lg:text-xs font-medium text-white/80 mt-1 leading-tight">
                                Provinsi
                            </div>
                        </div>
                    </div>

                    <!-- 2. Kabupaten / Kota -->
                    <div class="flex items-center justify-center gap-3.5 px-2 py-2 lg:py-0">
                        <div class="text-white/90 text-2xl lg:text-3xl flex-shrink-0">
                            <i class="fas fa-city"></i>
                        </div>
                        <div>
                            <div class="text-xl lg:text-2xl font-extrabold tracking-tight leading-none">
                                260+
                            </div>
                            <div class="text-[11px] lg:text-xs font-medium text-white/80 mt-1 leading-tight">
                                Kabupaten / Kota
                            </div>
                        </div>
                    </div>

                    <!-- 3. Kecamatan (DPC) -->
                    <div class="flex items-center justify-center gap-3.5 px-2 py-2 lg:py-0">
                        <div class="text-white/90 text-2xl lg:text-3xl flex-shrink-0">
                            <i class="fas fa-users-between-lines"></i>
                        </div>
                        <div>
                            <div class="text-xl lg:text-2xl font-extrabold tracking-tight leading-none">
                                1.200+
                            </div>
                            <div class="text-[11px] lg:text-xs font-medium text-white/80 mt-1 leading-tight">
                                Kecamatan (DPC)
                            </div>
                        </div>
                    </div>

                    <!-- 4. Anggota Aktif -->
                    <div class="flex items-center justify-center gap-3.5 px-2 py-2 lg:py-0">
                        <div class="text-white/90 text-2xl lg:text-3xl flex-shrink-0">
                            <i class="fas fa-user-group"></i>
                        </div>
                        <div>
                            <div class="text-xl lg:text-2xl font-extrabold tracking-tight leading-none">
                                25.000+
                            </div>
                            <div class="text-[11px] lg:text-xs font-medium text-white/80 mt-1 leading-tight">
                                Anggota Aktif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- PROGRAM KERJA SECTION HEADER -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-12 text-center">
            <!-- Judul "PROGRAM KERJA" -->
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight uppercase text-[#1B1B1B]">
                PROGRAM <span style="color: #C8102E;">KERJA</span>
            </h2>

            <!-- Subtitle / Deskripsi -->
            <p class="mt-3 text-slate-600 text-xs sm:text-sm font-medium max-w-2xl mx-auto leading-relaxed">
                GNRI menjalankan program kerja yang berfokus pada kebutuhan masyarakat dan kondisi di masing-masing wilayah.
            </p>
        </section>

        <!-- PROGRAM KERJA CARDS GRID -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

                <!-- CARD 1: Pemberdayaan Masyarakat -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <!-- Wrapper Gambar + Badge (Tanpa overflow-hidden) -->
                    <div class="relative">
                        <!-- Container Gambar (Menggunakan overflow-hidden & rounded top khusus) -->
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&q=80" 
                                alt="Pemberdayaan Masyarakat" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <!-- Badge Icon (Bisa mengapung bebas sekarang) -->
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#E31E24] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-hand-holding-heart text-base"></i>
                        </div>
                    </div>

                    <!-- Konten Teks -->
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Pemberdayaan<br>Masyarakat
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Mendorong kemandirian dan partisipasi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Pendidikan & Pelatihan -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <div class="relative">
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80" 
                                alt="Pendidikan & Pelatihan" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#F58220] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-book-open text-base"></i>
                        </div>
                    </div>
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Pendidikan &<br>Pelatihan
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Meningkatkan pengetahuan dan keterampilan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Ekonomi & UMKM -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <div class="relative">
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&w=600&q=80" 
                                alt="Ekonomi & UMKM" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#10B981] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-chart-line text-base"></i>
                        </div>
                    </div>
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Ekonomi &<br>UMKM
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Mendorong pertumbuhan ekonomi dan UMKM.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: Hukum & Advokasi -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <div class="relative">
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=600&q=80" 
                                alt="Hukum & Advokasi" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#0284C7] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-scale-balanced text-base"></i>
                        </div>
                    </div>
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Hukum &<br>Advokasi
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Meningkatkan kesadaran hukum masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CARD 5: Sosial & Kemanusiaan -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <div class="relative">
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=600&q=80" 
                                alt="Sosial & Kemanusiaan" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#D92D20] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-heart text-base"></i>
                        </div>
                    </div>
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Sosial &<br>Kemanusiaan
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Berpartisipasi dalam kegiatan sosial dan kemanusiaan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CARD 6: Pengembangan Organisasi -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 flex flex-col hover:shadow-xl transition-all duration-300 group">
                    <div class="relative">
                        <div class="h-44 rounded-t-2xl overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" 
                                alt="Pengembangan Organisasi" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-[#7C3AED] text-white flex items-center justify-center border-2 border-white shadow-md z-20">
                            <i class="fas fa-sitemap text-base"></i>
                        </div>
                    </div>
                    <div class="pt-8 pb-5 px-4 text-center flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm leading-tight">
                                Pengembangan<br>Organisasi
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium mt-2.5 leading-relaxed">
                                Memperkuat kapasitas dan jaringan organisasi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- BERITA & KEGIATAN + CEK KEANGGOTAAN SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- KIRI: BERITA & KEGIATAN (8 KOLOM) -->
                <div class="lg:col-span-8">
                    <!-- Header Section Berita -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight uppercase text-[#1B1B1B]">
                            BERITA & <span style="color: #C8102E;">KEGIATAN</span>
                        </h2>
                    </div>

                    <!-- Cards Berita Grid (3 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                        <!-- Card 1: Kegiatan -->
                        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                            <div class="relative h-36 overflow-hidden">
                                <img 
                                    src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&q=80" 
                                    alt="GNRI Gelar Bakti Sosial" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <!-- Badge Kategori -->
                                <span class="absolute top-3 left-3 bg-[#C8102E] text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">
                                    KEGIATAN
                                </span>
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[10px] font-medium text-slate-400 mb-1">26 Mei 2024</p>
                                    <h3 class="font-bold text-slate-800 text-xs sm:text-sm leading-snug line-clamp-2 group-hover:text-[#C8102E] transition-colors">
                                        GNRI Gelar Bakti Sosial di Kabupaten Bogor
                                    </h3>
                                    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed line-clamp-2">
                                        Kegiatan bakti sosial sebagai bentuk kepedulian terhadap masyarakat.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Berita -->
                        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                            <div class="relative h-36 overflow-hidden">
                                <img 
                                    src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=600&q=80" 
                                    alt="Rapat Kerja Nasional GNRI" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <!-- Badge Kategori -->
                                <span class="absolute top-3 left-3 bg-[#F58220] text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">
                                    BERITA
                                </span>
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[10px] font-medium text-slate-400 mb-1">22 Mei 2024</p>
                                    <h3 class="font-bold text-slate-800 text-xs sm:text-sm leading-snug line-clamp-2 group-hover:text-[#C8102E] transition-colors">
                                        Rapat Kerja Nasional GNRI Tahun 2024
                                    </h3>
                                    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed line-clamp-2">
                                        Memperkuat konsolidasi organisasi dan penyusunan program kerja.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Kegiatan -->
                        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                            <div class="relative h-36 overflow-hidden">
                                <img 
                                    src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80" 
                                    alt="Pelatihan Kewirausahaan" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <!-- Badge Kategori -->
                                <span class="absolute top-3 left-3 bg-[#C8102E] text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">
                                    KEGIATAN
                                </span>
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[10px] font-medium text-slate-400 mb-1">18 Mei 2024</p>
                                    <h3 class="font-bold text-slate-800 text-xs sm:text-sm leading-snug line-clamp-2 group-hover:text-[#C8102E] transition-colors">
                                        Pelatihan Kewirausahaan untuk UMKM
                                    </h3>
                                    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed line-clamp-2">
                                        GNRI mendorong kemajuan ekonomi melalui pelatihan UMKM.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- KANAN: CEK KEANGGOTAAN WIDGET (4 KOLOM) -->
                <div class="lg:col-span-4 lg:mt-14">
                    <div class="bg-gradient-to-br from-[#b80a1d] via-[#a60819] to-[#8d0013] text-white rounded-3xl p-6 sm:p-7 shadow-2xl relative overflow-hidden">
                        
                        <!-- Watermark Icon KTA Transparan di Pojok Kanan Atas -->
                        <div class="absolute -top-2 -right-2 text-white/10 text-8xl pointer-events-none">
                            <i class="fas fa-id-card"></i>
                        </div>

                        <!-- Header Form -->
                        <div class="flex items-start justify-between relative z-10">
                            <div>
                                <h3 class="text-lg sm:text-xl font-extrabold tracking-tight uppercase">
                                    CEK KEANGGOTAAN
                                </h3>
                                <p class="text-xs text-white/80 mt-1 font-normal max-w-[200px] leading-relaxed">
                                    Verifikasi keanggotaan Anda dengan mudah dan cepat.
                                </p>
                            </div>
                            <!-- Icon KTA Box Outline -->
                            <div class="w-12 h-10 border-2 border-white/80 rounded-lg flex items-center justify-center p-1 flex-shrink-0">
                                <i class="fas fa-id-card text-white/90 text-xl"></i>
                            </div>
                        </div>

                        <!-- Form Cek KTA -->
                        <form action="{{ route('cek-keanggotaan.search') }}" method="GET" class="mt-6 relative z-10">
                            <div class="mb-3.5">
                                <input 
                                    type="text" 
                                    name="no_kta"
                                    placeholder="Masukkan Nomor KTA" 
                                    required
                                    class="w-full px-4 py-3 rounded-xl bg-white text-slate-800 text-xs sm:text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-white/50 shadow-inner"
                                >
                            </div>

                            <button 
                                type="submit" 
                                class="w-full bg-[#111827] hover:bg-black text-white font-semibold text-xs sm:text-sm py-3 px-5 rounded-xl flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all duration-200 group"
                            >
                                <span>Cek Sekarang</span>
                                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </form>

                        <!-- Link Daftar Anggota -->
                        <div class="mt-6 pt-4 border-t border-white/15 text-center relative z-10">
                            <a href="/register" class="inline-flex items-center gap-2 text-white hover:text-white/80 text-xs font-bold tracking-wide transition-colors">
                                <i class="fas fa-user-plus text-sm"></i>
                                <span>Daftar Menjadi Anggota »</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        @include('layouts.footer')
    </main>

</body>
</html>