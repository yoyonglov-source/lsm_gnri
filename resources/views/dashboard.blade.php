<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Anggota') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-4 sm:py-6 px-4">
        
        <!-- Alert Success -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-emerald-800 text-xs sm:text-sm font-medium shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(!$anggota || !$anggota->nik || !$anggota->no_hp)
            <!-- ================= FORM PENDAFTARAN BIODATA ANGGOTA ================= -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="p-4 sm:p-6 bg-slate-50 border-b border-slate-200/80">
                    <h3 class="text-base sm:text-lg font-bold text-slate-800">Formulir Pengisian Data Anggota GNRI Riau</h3>
                    <p class="text-xs text-slate-500 mt-1">Harap lengkapi biodata Anda dengan benar untuk proses penerbitan KTA resmi.</p>
                </div>
                
                <form action="{{ route('profile.anggota.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-4 sm:space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <!-- NIK -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">NIK (Sesuai KTP)</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="16 Digit NIK">
                            @error('nik') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- No. HP -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">No. HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Contoh: 08123456789">
                            @error('no_hp') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Contoh: Pekanbaru">
                            @error('tempat_lahir') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('tanggal_lahir') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Wilayah DPD -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Wilayah Keanggotaan DPD</label>
                            <select name="kabupaten_id" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach($kabupatens as $kab)
                                    <option value="{{ $kab->id }}" {{ old('kabupaten_id') == $kab->id ? 'selected' : '' }}>{{ $kab->nama_kabupaten }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten_id') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap Rumah</label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Alamat rumah lengkap...">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Unggah Pas Foto (Maks 2MB)</label>
                        <input type="file" name="pas_foto" class="w-full text-xs sm:text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                        @error('pas_foto') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-3 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold text-sm rounded-xl shadow-sm transition-all">
                            Kirim Biodata Anggota
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- ================= STATUS TRACKING BERKAS ANGGOTA ================= -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 sm:p-8 flex flex-col md:flex-row gap-6 items-center">
                <!-- Foto Profile Card -->
                <div class="w-32 h-40 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 flex-shrink-0 shadow-inner">
                    @if($anggota->pas_foto)
                        <img src="{{ asset('storage/' . $anggota->pas_foto) }}" class="w-full h-full object-cover" alt="Pas Foto">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">No Photo</div>
                    @endif
                </div>

                <!-- Info Status -->
                <div class="flex-1 text-center md:text-left space-y-2 w-full">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Status Verifikasi Berkas</span>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-800">{{ $user->name }}</h3>
                    <p class="text-xs sm:text-sm text-slate-500">DPD Pendataan: <span class="font-semibold text-slate-700">{{ $anggota->kabupaten?->nama_kabupaten ?? 'Belum Diisi' }}</span></p>
                    
                    <div class="pt-2 flex flex-col items-center md:items-start">
                        @if($anggota->status_verifikasi === 'pending')
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-amber-50 text-amber-800 border border-amber-200/80 text-xs font-bold rounded-xl uppercase tracking-wide">
                                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                Menunggu Validasi Admin
                            </span>
                            <p class="text-xs text-slate-400 mt-2">Data Anda sedang diperiksa oleh tim admin DPD/DPW.</p>

                        @elseif($anggota->status_verifikasi === 'disetujui')
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/80 text-xs font-bold rounded-xl uppercase tracking-wide">
                                Keanggotaan Aktif
                            </span>
                            
                            <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-200/80 w-full max-w-xs text-center md:text-left">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nomor KTA Resmi</p>
                                <p class="text-lg sm:text-xl font-mono font-black text-slate-800 tracking-widest mt-0.5">{{ $anggota->no_kta ?? 'PROSES...' }}</p>
                            </div>

                        @elseif($anggota->status_verifikasi === 'ditolak')
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-rose-50 text-rose-800 border border-rose-200/80 text-xs font-bold rounded-xl uppercase tracking-wide">
                                Berkas Ditolak / Tidak Valid
                            </span>
                            <p class="text-xs text-rose-500 mt-2">Silakan hubungi pengurus DPD wilayah Anda untuk informasi perbaikan berkas.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>