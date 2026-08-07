<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Manajemen Berita & Kegiatan') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm font-semibold flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Action & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="text-base font-bold text-slate-800">Daftar Berita & Kegiatan</h3>
                <p class="text-xs text-slate-500">Kelola postingan berita yang tampil di halaman depan website.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-lg shadow-emerald-900/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Berita Baru
            </a>
        </div>

        <!-- Grid Cards Berita -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

            <!-- Card 1: Shortcut Tambah Berita Baru (Gaya Dotted Card) -->
            <a href="{{ route('admin.berita.create') }}" class="group min-h-[280px] bg-emerald-50/50 hover:bg-emerald-50 border-2 border-dashed border-emerald-300 hover:border-emerald-500 rounded-2xl p-6 flex flex-col items-center justify-center text-center transition-all duration-300 shadow-sm hover:shadow-md">
                <div class="w-12 h-12 rounded-full bg-emerald-100 group-hover:bg-emerald-600 group-hover:scale-110 flex items-center justify-center text-emerald-600 group-hover:text-white transition-all duration-300 mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h4 class="font-bold text-slate-800 group-hover:text-emerald-700 text-sm mb-1 transition-colors">Tambah Berita Baru</h4>
                <p class="text-xs text-slate-500 max-w-[180px]">Tulis dan terbitkan berita atau kegiatan baru LSM</p>
            </a>

            <!-- Cards Daftar Berita -->
            @forelse($beritas as $item)
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-all duration-200">
                    
                    <!-- Gambar & Badge Status/Kategori -->
                    <div class="relative h-40 bg-slate-100 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        
                        <!-- Badge Kategori (Kiri Atas) -->
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider bg-slate-900/80 backdrop-blur-md text-white rounded-lg shadow-sm">
                                {{ $item->kategori }}
                            </span>
                        </div>

                        <!-- Badge Headline (Kanan Atas) -->
                        <div class="absolute top-3 right-3">
                            @if($item->is_headline)
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-amber-400 text-amber-950 rounded-lg shadow-sm flex items-center gap-1">
                                    ★ Headline
                                </span>
                            @else
                                <span class="px-2 py-1 text-[10px] font-medium bg-white/90 backdrop-blur-md text-slate-600 rounded-lg shadow-sm">
                                    Standar
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Content -->
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="text-[11px] font-semibold text-slate-400 mb-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->created_at->isoFormat('D MMM Y, HH:mm') }}
                            </div>
                            <h4 class="font-bold text-slate-800 text-sm line-clamp-2 leading-snug group-hover:text-emerald-600 transition-colors" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h4>
                        </div>

                        <!-- Action Buttons (Bawah Card) -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                            <!-- Preview Publik -->
                            <a href="{{ route('berita.show', $item->slug) }}" target="_blank" class="text-slate-500 hover:text-blue-600 flex items-center gap-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span>Lihat</span>
                            </a>

                            <div class="flex items-center gap-1">
                                <!-- Edit -->
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <!-- Tampilan Jika Berita Kosong -->
                <div class="col-span-full bg-white p-8 rounded-2xl border border-slate-200 text-center">
                    <p class="text-slate-400 text-sm">Belum ada berita yang diposting.</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if($beritas->hasPages())
            <div class="pt-4">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
</x-app-layout>