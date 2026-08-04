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
        @include('partials.menu-nav-bar')

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
            @include('partials.banner')
        </section>

        <!-- TENTANG GNRI SECTION -->
        <section class="relative py-12 lg:py-16 overflow-hidden bg-slate-50/50">
            @include('partials.about')
        </section>

        <!-- STATISTIK / COUNTER SECTION (RED BAR) -->
        <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 mb-16 z-20">
            @include('partials.statistik')
        </section>

        @include('partials.program-kerja')

        <section>
            @include('partials.berita-dan-kta')
        </section>

        @include('layouts.footer')
    </main>

</body>
</html>