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

        <!-- Action & Search Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="text-base font-bold text-slate-800">Daftar Berita & Kegiatan</h3>
                <p class="text-xs text-slate-500">Kelola postingan berita yang tampil di halaman depan website.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-lg shadow-emerald-900/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Berita Baru
            </a>
        </div>

        <!-- Tabel Berita -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500">
                        <tr>
                            <th class="p-4">Gambar</th>
                            <th class="p-4">Judul & Kategori</th>
                            <th class="p-4">Status Headline</th>
                            <th class="p-4">Tanggal Buat</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($beritas as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="p-4 w-20">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-16 h-12 object-cover rounded-lg border border-slate-200">
                                </td>
                                <td class="p-4 max-w-md">
                                    <div class="font-bold text-slate-800 line-clamp-1">{{ $item->judul }}</div>
                                    <span class="inline-block mt-1 text-[10px] font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($item->is_headline)
                                        <span class="px-2.5 py-1 text-[11px] font-semibold bg-amber-100 text-amber-800 rounded-full">
                                            ★ Headline Utama
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-[11px] font-medium bg-slate-100 text-slate-500 rounded-full">
                                            Standar
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-xs whitespace-nowrap">
                                    {{ $item->created_at->isoFormat('D MMM Y, HH:mm') }}
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="p-2 text-slate-500 hover:text-emerald-600 hover:bg-slate-100 rounded-lg transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 text-sm">
                                    Belum ada berita yang diposting.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($beritas->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $beritas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>