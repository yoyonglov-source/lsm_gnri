<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita & Kegiatan - GNRI</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-slate-50 min-h-screen flex flex-col justify-between">

    @include('partials.menu-nav-bar')

    <main class="flex-grow py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#1B1B1B] tracking-tight uppercase">
                    BERITA & <span style="color: #C8102E;">KEGIATAN</span> GNRI
                </h1>
                <p class="mt-3 text-slate-600 text-sm sm:text-base">
                    Dapatkan informasi terbaru seputar kegiatan, pengumuman resmi, dan aksi sosial Gerakan Nawacita Rakyat Indonesia.
                </p>
            </div>

            <!-- HEADLINE / FEATURED NEWS -->
            @if($headline)
            <div class="mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 bg-white rounded-3xl p-4 sm:p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                    <div class="lg:col-span-7 relative h-64 sm:h-80 lg:h-96 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $headline->gambar) }}" alt="{{ $headline->judul }}" class="w-full h-full object-cover">
                        <span class="absolute top-4 left-4 bg-[#C8102E] text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $headline->kategori }}
                        </span>
                    </div>
                    <div class="lg:col-span-5 flex flex-col justify-between py-2">
                        <div>
                            <div class="flex items-center gap-3 text-slate-400 text-xs mb-3">
                                <span><i class="far fa-calendar-alt mr-1"></i> {{ $headline->created_at->isoFormat('D MMMM Y') }}</span>
                            </div>
                            <a href="{{ route('berita.show', $headline->slug) }}">
                                <h2 class="text-xl sm:text-2xl font-bold text-[#1B1B1B] hover:text-[#C8102E] transition-colors leading-snug">
                                    {{ $headline->judul }}
                                </h2>
                            </a>
                            <p class="mt-3 text-slate-600 text-xs sm:text-sm line-clamp-3 leading-relaxed">
                                {{ $headline->ringkasan }}
                            </p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('berita.show', $headline->slug) }}" class="inline-flex items-center gap-2 text-[#C8102E] font-semibold text-sm hover:underline">
                                Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- GRID LIST BERITA -->
            @if($beritas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($beritas as $item)
                <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-1 rounded-md">
                            {{ $item->kategori }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-slate-400 text-[11px] mb-2">
                                <span><i class="far fa-calendar-alt"></i> {{ $item->created_at->isoFormat('D MMM Y') }}</span>
                            </div>
                            <a href="{{ route('berita.show', $item->slug) }}">
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base line-clamp-2 group-hover:text-[#C8102E] transition-colors">
                                    {{ $item->judul }}
                                </h3>
                            </a>
                            <p class="mt-2 text-slate-500 text-xs line-clamp-3 leading-relaxed">
                                {{ $item->ringkasan }}
                            </p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('berita.show', $item->slug) }}" class="text-xs font-semibold text-[#C8102E] flex items-center gap-1 group-hover:gap-2 transition-all">
                                Baca Selengkapnya <i class="fas fa-chevron-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- PAGINATION LINK -->
            <div class="mt-8">
                {{ $beritas->links() }}
            </div>
            @else
                <p class="text-center text-slate-400 text-sm py-10">Belum ada berita yang diterbitkan.</p>
            @endif

        </div>
    </main>

    @include('layouts.footer')

</body>
</html>