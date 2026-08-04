<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Berita Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul berita..."
                           class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                    @error('judul') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori</label>
                        <select name="kategori" class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="Kegiatan DPW">Kegiatan DPW</option>
                            <option value="Kegiatan DPD">Kegiatan DPD</option>
                            <option value="Pengumuman Resmi">Pengumuman Resmi</option>
                            <option value="Aksi Sosial">Aksi Sosial</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Gambar Sampul (Max 5MB)</label>
                        <input type="file" name="gambar" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        @error('gambar') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200/60">
                    <input type="checkbox" name="is_headline" id="is_headline" value="1" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <label for="is_headline" class="text-xs font-bold text-slate-700 cursor-pointer">
                        Jadikan Berita Utama / Highlight (Headline)
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Berita / Konten</label>
                    <textarea name="konten" rows="10" required placeholder="Tuliskan berita secara detail..."
                              class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('konten') }}</textarea>
                    @error('konten') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.berita.index') }}" class="px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">Batal</a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-lg shadow-emerald-900/20 transition-all">
                        Terbitkan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>