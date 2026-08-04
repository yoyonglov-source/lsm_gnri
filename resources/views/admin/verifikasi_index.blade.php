<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6" x-data="{ openApproveModal: false, selectedAnggota: null }">
        
        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Daftar Verifikasi Calon Anggota</h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Periksa dan verifikasi pendaftaran anggota baru</p>
            </div>
            <div>
                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $calonAnggota->count() }} Menunggu Persetujuan
                </span>
            </div>
        </div>

        <!-- Alert Success & Error -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($calonAnggota->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm p-8 sm:p-12 text-center border border-gray-100">
                <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-base font-semibold text-gray-800">Tidak ada pendaftaran baru</h3>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Semua calon anggota di wilayah tugas Anda telah diverifikasi.</p>
            </div>
        @else

            <!-- ================= TAMPILAN MOBILE (Card View) ================= -->
            <div class="grid grid-cols-1 gap-4 md:hidden">
                @foreach($calonAnggota as $anggota)
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-4">
                        <div class="flex items-start gap-3">
                            <!-- Pas Foto -->
                            @if($anggota->pas_foto)
                                <img src="{{ asset('storage/' . $anggota->pas_foto) }}" 
                                     alt="Pas Foto" 
                                     class="w-16 h-20 object-cover rounded-xl shadow-sm border border-gray-200 flex-shrink-0">
                            @else
                                <div class="w-16 h-20 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200 flex-shrink-0">
                                    <span class="text-gray-400 text-[10px]">No Photo</span>
                                </div>
                            @endif

                            <!-- Detail Singkat -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 text-base truncate">{{ $anggota->user->name ?? '-' }}</h3>
                                <p class="text-xs text-blue-600 font-medium">NIK: {{ $anggota->nik }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $anggota->no_hp }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ $anggota->user->email ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600">
                            <span class="font-semibold text-gray-700 block mb-0.5">Alamat:</span>
                            {{ $anggota->alamat }}
                        </div>

                        <!-- Tombol Aksi HP -->
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <button type="button" 
                                    @click="selectedAnggota = {{ json_encode(['id' => $anggota->id, 'name' => $anggota->user->name ?? 'Calon Anggota']) }}; openApproveModal = true"
                                    class="w-full bg-emerald-600 active:bg-emerald-700 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition text-center">
                                Setujui
                            </button>

                            <form action="{{ route('admin.verifikasi.proses', [$anggota->id, 'ditolak']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
                                @csrf
                                <button type="submit" class="w-full bg-rose-600 active:bg-rose-700 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ================= TAMPILAN DESKTOP (Table View) ================= -->
            <div class="hidden md:block bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100">
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-gray-500">Foto</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-gray-500">Nama / NIK</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-gray-500">Kontak</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-gray-500">Alamat</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($calonAnggota as $anggota)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="p-4">
                                        @if($anggota->pas_foto)
                                            <img src="{{ asset('storage/' . $anggota->pas_foto) }}" 
                                                 alt="Pas Foto" 
                                                 class="w-14 h-18 object-cover rounded-xl shadow-sm border border-gray-200">
                                        @else
                                            <div class="w-14 h-18 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200">
                                                <span class="text-gray-400 text-xs">No Photo</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-800">{{ $anggota->user->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">NIK: {{ $anggota->nik }}</div>
                                    </td>
                                    <td class="p-4 text-sm">
                                        <div class="font-medium text-gray-700">{{ $anggota->no_hp }}</div>
                                        <div class="text-xs text-gray-400">{{ $anggota->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600 max-w-xs truncate">
                                        {{ $anggota->alamat }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Setujui -->
                                            <button type="button" 
                                                    @click="selectedAnggota = {{ json_encode(['id' => $anggota->id, 'name' => $anggota->user->name ?? 'Calon Anggota']) }}; openApproveModal = true"
                                                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3 py-2 rounded-xl shadow-sm transition">
                                                Setujui
                                            </button>

                                            <!-- Tombol Tolak -->
                                            <form action="{{ route('admin.verifikasi.proses', [$anggota->id, 'ditolak']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
                                                @csrf
                                                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-3 py-2 rounded-xl shadow-sm transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @endif

        <!-- ================= MODAL POP-UP INPUT NO KTA ================= -->
        <div x-cloak x-show="openApproveModal" 
            class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            x-transition>
            
            <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl overflow-hidden border border-slate-200" @click.away="openApproveModal = false">
                <template x-if="selectedAnggota">
                    <!-- Form Action Langsung Dibuat Dinamis via JavaScript -->
                    <form :action="'{{ url('/admin/verifikasi') }}/' + selectedAnggota.id + '/disetujui'" method="POST">
                        @csrf
                        <div class="p-5 sm:p-6">
                            <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1">Setujui & Terbitkan KTA</h3>
                            <p class="text-xs text-slate-500 mb-4">Input Nomor KTA manual untuk: <strong class="text-emerald-600" x-text="selectedAnggota.name"></strong></p>

                            <div class="mb-4">
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor KTA Resmi <span class="text-rose-500">*</span></label>
                                <input type="text" name="no_kta" required
                                    class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 font-mono"
                                    placeholder="Contoh: GNRI.2026.0012">
                                @error('no_kta')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                            <button type="button" @click="openApproveModal = false" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl shadow-md transition">
                                Simpan & Setujui
                            </button>
                        </div>
                    </form>
                </template>
            </div>
        </div>

    </div>
</x-app-layout>