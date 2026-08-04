<!-- FOOTER SECTION -->
<footer class="bg-[#B80A1D] text-white pt-10 pb-8 border-t border-red-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-8 pb-10 border-b border-white/20">

            <!-- KOLOM 1: LOGO & DESKRIPSI -->
            <div class="lg:col-span-1 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <!-- Ganti src logo sesuai asset kamu -->
                        <img src="{{ asset('storage/logo_kiri.png') }}" alt="Logo GNRI" style="height: 100px;" class="w-auto object-contain">
                        <div>
                            <h3 class="font-extrabold text-base tracking-wider leading-tight">GNRI</h3>
                            <p class="text-[10px] font-semibold tracking-tight text-white/90 leading-none mt-0.5">
                                GERAKAN NAWACITA<br>RAKYAT INDONESIA
                            </p>
                        </div>
                    </div>
                    <p class="text-[11px] text-white/80 leading-relaxed font-normal">
                        Persaudaraan Dalam Kesatuan Menjaga Keutuhan NKRI
                    </p>
                </div>

                <!-- Social Media Icons -->
                <div class="flex items-center gap-2 pt-2">
                    <a href="#" class="w-7 h-7 rounded-full border border-white/40 flex items-center justify-center text-xs hover:bg-white hover:text-[#B80A1D] transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full border border-white/40 flex items-center justify-center text-xs hover:bg-white hover:text-[#B80A1D] transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full border border-white/40 flex items-center justify-center text-xs hover:bg-white hover:text-[#B80A1D] transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full border border-white/40 flex items-center justify-center text-xs hover:bg-white hover:text-[#B80A1D] transition-colors">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            <!-- KOLOM 2: TENTANG GNRI -->
            <div class="border-l-0 lg:border-l border-white/20 lg:pl-6">
                <h4 class="font-bold text-xs uppercase tracking-wider mb-4 text-white">TENTANG GNRI</h4>
                <ul class="space-y-2 text-[11px] text-white/80 font-normal">
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Sejarah</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Visi & Misi</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Nilai Organisasi</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Tujuan & Fokus</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Legalitas</a></li>
                </ul>
            </div>

            <!-- KOLOM 3: ORGANISASI -->
            <div class="border-l-0 lg:border-l border-white/20 lg:pl-6">
                <h4 class="font-bold text-xs uppercase tracking-wider mb-4 text-white">ORGANISASI</h4>
                <ul class="space-y-2 text-[11px] text-white/80 font-normal">
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Struktur DPP</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Struktur DPW</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Struktur DPD</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Struktur DPC</a></li>
                </ul>
            </div>

            <!-- KOLOM 4: PROGRAM & KEGIATAN -->
            <div class="border-l-0 lg:border-l border-white/20 lg:pl-6">
                <h4 class="font-bold text-xs uppercase tracking-wider mb-4 text-white">PROGRAM & KEGIATAN</h4>
                <ul class="space-y-2 text-[11px] text-white/80 font-normal">
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Program Kerja</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Berita</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Kegiatan</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Galeri</a></li>
                </ul>
            </div>

            <!-- KOLOM 5: KEANGGOTAAN -->
            <div class="border-l-0 lg:border-l border-white/20 lg:pl-6">
                <h4 class="font-bold text-xs uppercase tracking-wider mb-4 text-white">KEANGGOTAAN</h4>
                <ul class="space-y-2 text-[11px] text-white/80 font-normal">
                    <li><a href="/register" class="hover:text-white hover:underline transition-all">Pendaftaran Anggota</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition-all">Data Anggota</a></li>
                    <li><a href="{{ route('cek-keanggotaan.search') }}" class="hover:text-white hover:underline transition-all">Cek Keanggotaan</a></li>
                </ul>
            </div>

            <!-- KOLOM 6: KONTAK -->
            <div class="border-l-0 lg:border-l border-white/20 lg:pl-6">
                <h4 class="font-bold text-xs uppercase tracking-wider mb-4 text-white">KONTAK</h4>
                <ul class="space-y-3 text-[11px] text-white/80 font-normal">
                    <li class="flex items-start gap-2.5">
                        <i class="fas fa-map-marker-alt text-xs mt-0.5 flex-shrink-0"></i>
                        <span>Jl. Contoh No. 123<br>Jakarta, Indonesia 12345</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fas fa-phone-alt text-xs flex-shrink-0"></i>
                        <span>+62 21 1234 5678</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fas fa-envelope text-xs flex-shrink-0"></i>
                        <span>info@gnri.or.id</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- CALL FOOTER COMPONENT -->

        <!-- COPYRIGHT BOTTOM -->
        <div class="pt-6 text-center text-[11px] text-white/70">
            <p>&copy; {{ date('Y') }} Gerakan Nawacita Rakyat Indonesia (GNRI). All rights reserved.</p>
        </div>
    </div>
</footer>