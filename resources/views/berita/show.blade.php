<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $berita->judul }} - GNRI RIAU</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800">

    <!-- Header / Navbar Minimalis -->
    <header class="bg-slate-900 text-white sticky top-0 z-50 border-b border-slate-800 shadow-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ route('berita.index') }}" class="flex items-center gap-3 group">
                <span class="text-xl font-black tracking-wider text-emerald-400">GNRI</span>
                <span class="text-xs font-bold text-slate-400 border-l border-slate-700 pl-2">RIAU</span>
            </a>
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-300 hover:text-emerald-400 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Berita
            </a>
        </div>
    </header>

    <!-- Konten Utama Detail Berita -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
        <article class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden p-6 sm:p-10">
            
            <!-- Metadata & Kategori -->
            <div class="flex flex-wrap items-center gap-3 text-xs font-semibold mb-4">
                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-lg uppercase tracking-wider">
                    {{ $berita->kategori }}
                </span>
                <span class="text-slate-400">•</span>
                <span class="text-slate-500">
                    {{ $berita->created_at->isoFormat('D MMMM Y, HH:mm') }} WIB
                </span>
                @if($berita->is_headline)
                    <span class="text-slate-400">•</span>
                    <span class="px-2.5 py-0.5 bg-amber-100 text-amber-800 rounded-md font-bold">
                        ★ Headline
                    </span>
                @endif
            </div>

            <!-- Judul Berita -->
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-6">
                {{ $berita->judul }}
            </h1>

            <!-- Gambar Sampul Utama -->
            <div class="rounded-2xl overflow-hidden mb-8 bg-slate-100 border border-slate-200">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full max-h-[450px] object-cover">
            </div>

            <!-- Isi Konten Berita (Diderender dengan Unescaped HTML untuk Format CKEditor) -->
            <div class="prose max-w-none text-slate-700 leading-relaxed text-base sm:text-lg space-y-4">
                {!! $berita->konten !!}
            </div>

        </article>

        <!-- Berita Terkait / Lainnya -->
        @if(isset($beritaTerkait) && $beritaTerkait->count() > 0)
            <section class="mt-12">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-emerald-600 rounded-full inline-block"></span>
                    Berita Terkait Lainnya
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($beritaTerkait as $terkait)
                        <a href="{{ route('berita.show', $terkait->slug) }}" class="group bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-all">
                            <div class="h-32 bg-slate-100 overflow-hidden">
                                <img src="{{ asset('storage/' . $terkait->gambar) }}" alt="{{ $terkait->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 mb-1 block">{{ $terkait->kategori }}</span>
                                <h4 class="font-bold text-slate-800 text-xs line-clamp-2 group-hover:text-emerald-600 transition-colors">
                                    {{ $terkait->judul }}
                                </h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <!-- Footer Simple -->
    <footer class="bg-slate-900 text-slate-400 py-8 text-center text-xs border-t border-slate-800 mt-16">
        <p>&copy; {{ date('Y') }} SIM LSM GNRI RIAU. All rights reserved.</p>
    </footer>

</body>
</html>