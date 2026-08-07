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

            <!-- Cards Berita Grid (3 Kolom Dinamis) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                @forelse($beritaTerbaru as $item)
                    <!-- Card Berita Dinamis -->
                    <a href="{{ route('berita.show', $item->slug) }}" class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                        <div class="relative h-36 overflow-hidden bg-slate-100">
                            <img 
                                src="{{ asset('storage/' . $item->gambar) }}" 
                                alt="{{ $item->judul }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <!-- Badge Kategori Dynamic Style -->
                            <span class="absolute top-3 left-3 {{ $item->kategori == 'Kegiatan DPW' || $item->kategori == 'Kegiatan DPD' ? 'bg-[#C8102E]' : 'bg-[#F58220]' }} text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">
                                {{ $item->kategori }}
                            </span>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <p class="text-[10px] font-medium text-slate-400 mb-1">
                                    {{ $item->created_at->isoFormat('D MMM Y') }}
                                </p>
                                <h3 class="font-bold text-slate-800 text-xs sm:text-sm leading-snug line-clamp-2 group-hover:text-[#C8102E] transition-colors">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed line-clamp-2">
                                    {{ Str::limit(strip_tags($item->konten), 90) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- Tampilan Jika Belum Ada Berita di Database -->
                    <div class="col-span-full bg-white p-8 rounded-2xl border border-slate-100 text-center">
                        <p class="text-xs text-slate-400 font-medium">Belum ada berita atau kegiatan terbaru.</p>
                    </div>
                @endforelse

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