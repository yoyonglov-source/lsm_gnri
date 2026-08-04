<!-- PEMBUNGKUS UTAMA SECTION (Pastikan ada relative & overflow-hidden) -->
<section class="relative overflow-hidden bg-slate-50 py-12 lg:py-16">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- FOTO SAMPING (5 KOLOM) -->
            <div class="lg:col-span-5 relative z-10">
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ asset('build/assets/about.png') }}" alt="About Image" class="w-full h-auto object-cover" />
                    <div class="absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#C8102E]/80 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <!-- DESKRIPSI TENTANG GNRI + WATERMARK PETA DI BELAKANGNYA (7 KOLOM) -->
            <div class="lg:col-span-7 relative">
                
                <!-- WATERMARK MAP INDONESIA (Di-posisikan persis di belakang teks ini) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-25 grayscale z-0">
                    <img src="{{ asset('build/assets/map.png') }}" alt="Map Indonesia Watermark" class="w-full h-auto object-contain scale-125">
                </div>

                <!-- KONTEN TEKS (Menggunakan relative & z-10 agar selalu di atas peta) -->
                <div class="relative z-10">
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
    </div>
</section>