<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    Tambah Anggota Baru
                </h2>
                <p class="text-xs text-slate-500 mt-1">Input data anggota baru oleh admin LSM GNRI</p>
            </div>
            <a href="{{ route('admin.anggota.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-bold rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Data Anggota
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-slate-200 rounded-2xl">
                <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                    @csrf

                    <!-- Section 1: Informasi Akun -->
                    <div>
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
                            1. Informasi Akun Login
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('email') border-red-500 @enderror"
                                       placeholder="contoh@gmail.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Password Awal <span class="text-red-500">*</span></label>
                                <input type="password" name="password" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('password') border-red-500 @enderror"
                                       placeholder="Minimal 8 karakter">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Anggota -->
                    <div>
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
                            2. Data Pribadi Anggota
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('name') border-red-500 @enderror"
                                       placeholder="Nama sesuai KTP">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor KTA (INPUT MANUAL) -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor KTA <span class="text-red-500">*</span></label>
                                <input type="text" name="no_kta" value="{{ old('no_kta') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('no_kta') border-red-500 @enderror"
                                       placeholder="Contoh: GNRI.2026.0001">
                                @error('no_kta')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">NIK (16 Digit) <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('nik') border-red-500 @enderror"
                                       placeholder="16 digit angka NIK">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('tempat_lahir') border-red-500 @enderror"
                                       placeholder="Kota / Kabupaten tempat lahir">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('tanggal_lahir') border-red-500 @enderror">
                                @error('tanggal_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="jenis_kelamin" required
                                        class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('jenis_kelamin') border-red-500 @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No HP -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('no_hp') border-red-500 @enderror"
                                       placeholder="08123456789">
                                @error('no_hp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Wilayah / Kabupaten DPD -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Wilayah / Kabupaten DPD <span class="text-red-500">*</span></label>
                                <select name="kabupaten_id" required
                                        class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('kabupaten_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Wilayah DPD --</option>
                                    @foreach($kabupatens as $kab)
                                        <option value="{{ $kab->id }}" {{ old('kabupaten_id') == $kab->id ? 'selected' : '' }}>
                                            {{ $kab->nama_kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kabupaten_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jabatan dalam Organisasi</label>
                                <input type="text" name="jabatan" value="{{ old('jabatan', 'ANGGOTA') }}"
                                       class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                       placeholder="Contoh: KETUA, BENDAHARA, ANGGOTA">
                            </div>

                            <!-- Alamat Lengkap -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="3" required
                                          class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 @error('alamat') border-red-500 @enderror"
                                          placeholder="Jalan, RT/RW, Kelurahan, Kecamatan">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Pas Foto -->
                    <div>
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
                            3. Pas Foto Resmi
                        </h3>
                        <div class="flex flex-col sm:flex-row items-center gap-6">
                            <div class="w-32 h-40 bg-slate-100 border-2 border-dashed border-slate-300 rounded-xl overflow-hidden flex flex-col items-center justify-center flex-shrink-0 relative group">
                                <img id="foto-preview" class="w-full h-full object-cover hidden">
                                <div id="placeholder-icon" class="text-center p-2">
                                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[10px] text-slate-400 font-medium">Preview Foto</span>
                                </div>
                            </div>

                            <div class="flex-1 w-full">
                                <input type="file" name="pas_foto" id="pas_foto" accept="image/*" onchange="previewImage(event)" class="hidden">
                                <label for="pas_foto" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs rounded-xl cursor-pointer transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Pilih Foto Berkas
                                </label>
                                <p class="text-[11px] text-slate-500 mt-2">Format: JPG, JPEG, PNG. Ukuran maksimal 10MB. Disarankan rasio 3x4 / portrait.</p>
                                @error('pas_foto')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.anggota.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-600/20 transition">
                            Simpan Anggota Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('foto-preview');
                const placeholder = document.getElementById('placeholder-icon');
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-app-layout>