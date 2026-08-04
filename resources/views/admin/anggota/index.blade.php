<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-xl text-slate-800 leading-tight">
                    Data Anggota GNRI
                </h2>
                <p class="text-xs text-slate-500 mt-1">Direktori seluruh anggota resmi terdaftar di organisasi GNRI Riau.</p>
            </div>
        
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" x-data="{ selectedAnggota: null, showModal: false }">
        
        <!-- Flash Alert Success -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-2xl flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">&times;</button>
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-200/80 mb-6">
            <form method="GET" action="{{ route('admin.anggota.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4">
                
                <!-- Search Input -->
                <div class="sm:col-span-6 md:col-span-7">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-300 text-xs sm:text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Cari Nama, NIK, No. KTA, atau No. HP...">
                    </div>
                </div>

                <!-- Filter Kabupaten -->
                <div class="sm:col-span-4 md:col-span-3">
                    <select name="kabupaten_id" class="w-full py-2.5 rounded-xl border-slate-300 text-xs sm:text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Semua Kabupaten/DPD --</option>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}" {{ request('kabupaten_id') == $kab->id ? 'selected' : '' }}>{{ $kab->nama_kabupaten }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Filter Button -->
                <div class="sm:col-span-2 flex items-center gap-2">
                    <button type="submit" class="w-full py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs rounded-xl transition shadow-sm flex items-center justify-center gap-1">
                        <span>Filter</span>
                    </button>
                    @if(request('search') || request('kabupaten_id'))
                        <a href="{{ route('admin.anggota.index') }}" class="p-2.5 text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition" title="Reset Filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- CARD GRID ANGGOTA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            
            <!-- 1. KARTU DOTTED: TAMBAH ANGGOTA BARU -->
            <a href="{{ route('admin.anggota.create') }}" class="border-2 border-dashed border-emerald-300/80 bg-emerald-50/40 hover:bg-emerald-50 hover:border-emerald-500 rounded-2xl p-6 flex flex-col items-center justify-center text-center transition group min-h-[260px]">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 text-sm mb-1">Tambah Anggota Baru</h3>
                <p class="text-[11px] text-slate-400 leading-snug">Daftarkan anggota resmi GNRI baru untuk menerbitkan KTA</p>
            </a>

            <!-- 2. LOOP KARTU ANGGOTA -->
            @forelse($anggotas as $item)
                @php
                    $hpRaw = $item->no_hp ?? '';
                    $hp = preg_replace('/[^0-9]/', '', $hpRaw);
                    if (str_starts_with($hp, '0')) {
                        $hp = '62' . substr($hp, 1);
                    }
                @endphp

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col overflow-hidden relative group">
                    
                    <!-- Top Card: Banner/Foto & Badge Status -->
                    <div class="p-4 pb-0 flex items-start justify-between gap-3">
                        <!-- Foto Profil Crop -->
                        <div class="w-16 h-20 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 shadow-sm">
                            @if($item->pas_foto)
                                <img src="{{ asset('storage/' . $item->pas_foto) }}" class="w-full h-full object-cover" alt="Foto">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-[10px] bg-slate-100">No Pic</div>
                            @endif
                        </div>

                        <!-- Status Badge & Toggle Action -->
                        <div class="flex flex-col items-end gap-2">
                            <form action="{{ route('admin.anggota.toggle-status', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Ubah status keaktifan anggota ini?')" class="px-2.5 py-1 text-[10px] font-bold rounded-full transition-all border {{ $item->is_active ?? true ? 'bg-emerald-50 text-emerald-600 border-emerald-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200' : 'bg-red-50 text-red-600 border-red-200 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200' }}" title="Klik untuk mengubah status">
                                    {{ ($item->is_active ?? true) ? 'AKTIF' : 'NON-AKTIF' }}
                                </button>
                            </form>
                            
                            <!-- Badge DPD (SAFE CHECK) -->
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider bg-slate-100 px-2 py-0.5 rounded-md">
                                {{ $item->kabupaten->nama_kabupaten ?? 'DPD -' }}
                            </span>
                        </div>
                    </div>

                    <!-- Middle Card: Information Data Anggota -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            @if($item->no_kta)
                                <span class="inline-block px-2 py-0.5 bg-emerald-50 text-emerald-700 font-mono font-bold text-[11px] rounded-md mb-1.5 border border-emerald-100">
                                    {{ $item->no_kta }}
                                </span>
                            @else
                                <span class="inline-block px-2 py-0.5 bg-amber-50 text-amber-600 font-mono font-bold text-[11px] rounded-md mb-1.5 border border-amber-200">
                                    Belum Terbit
                                </span>
                            @endif

                            <h3 class="font-bold text-slate-800 text-sm leading-snug line-clamp-1" title="{{ $item->user->name ?? 'Tanpa Nama' }}">
                                {{ $item->user->name ?? 'Tanpa Nama' }}
                            </h3>
                            <p class="text-[11px] text-slate-400 font-mono mt-0.5">NIK: {{ $item->nik ?? '-' }}</p>
                        </div>

                        <!-- Quick Contact Button -->
                        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            @if(!empty($hp))
                                <a href="https://wa.me/{{ $hp }}" target="_blank" class="inline-flex items-center gap-1.5 text-slate-600 hover:text-emerald-600 font-medium transition text-[11px]">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                    <span>{{ $item->no_hp }}</span>
                                </a>
                            @else
                                <span class="text-[11px] text-slate-400 font-medium">-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Action Bar (Cetak KTA, Detail & Edit Pencil) -->
                    <div class="px-4 py-2 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] font-bold">
                        <!-- Kiri: Cetak KTA -->
                        @if($item->no_kta)
                            <a href="{{ route('admin.kta.cetak', $item->id) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                <span>Cetak KTA</span>
                            </a>
                        @else
                            <span class="text-slate-400 flex items-center gap-1 cursor-not-allowed" title="KTA belum terbit">
                                <span>KTA Pending</span>
                            </span>
                        @endif

                        <!-- Kanan: Detail & Icon Pencil Edit -->
                        <div class="flex items-center gap-2">
                            <button type="button" @click="selectedAnggota = {{ json_encode($item->load('kabupaten', 'user')) }}; showModal = true" class="text-slate-500 hover:text-slate-800 flex items-center gap-0.5 transition">
                                <span>Detail</span>
                            </button>

                            <span class="text-slate-300">|</span>

                            <!-- Tombol Edit (Icon Pencil) -->
                            <a href="{{ route('admin.anggota.edit', $item->id) }}" class="p-1 text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-md transition" title="Edit Data Anggota">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl p-12 text-center text-slate-400 border border-slate-200/80">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-sm font-semibold text-slate-600">Belum Ada Data Anggota</p>
                    <p class="text-xs text-slate-400 mt-1">Gunakan tombol "Tambah Anggota Baru" di atas untuk menambah data baru.</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination Footer -->
        @if($anggotas->hasPages())
            <div class="mt-6">
                {{ $anggotas->withQueryString()->links() }}
            </div>
        @endif

        <!-- ================= MODAL DETAIL ANGGOTA ================= -->
        <div x-cloak x-show="showModal"  
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
             
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200" @click.away="showModal = false">
                <!-- Modal Header -->
                <div class="p-4 sm:p-5 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base">Detail Biodata Anggota</h3>
                        <p class="text-[11px] text-slate-500">Informasi lengkap data diri keanggotaan</p>
                    </div>
                    <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-200/60 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <template x-if="selectedAnggota">
                    <div class="p-5 space-y-4 max-h-[75vh] overflow-y-auto">
                        <!-- Foto & KTA Header -->
                        <div class="flex items-center gap-4 p-3.5 bg-slate-50 rounded-xl border border-slate-200/80">
                            <div class="w-16 h-20 bg-slate-200 rounded-lg overflow-hidden flex-shrink-0 border border-slate-300">
                                <template x-if="selectedAnggota.pas_foto">
                                    <img :src="'/storage/' + selectedAnggota.pas_foto" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!selectedAnggota.pas_foto">
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">No Foto</div>
                                </template>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">No. KTA Resmi</span>
                                <p class="text-lg font-mono font-black text-slate-800" x-text="selectedAnggota.no_kta || 'BELUM TERBIT'"></p>
                                <p class="text-xs font-bold text-slate-700 mt-0.5" x-text="selectedAnggota.user ? selectedAnggota.user.name : '-'"></p>
                                <p class="text-xs text-slate-500" x-text="selectedAnggota.user ? selectedAnggota.user.email : '-'"></p>
                            </div>
                        </div>

                        <!-- Data Grid -->
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">NIK</p>
                                <p class="font-mono font-semibold text-slate-800 mt-0.5" x-text="selectedAnggota.nik || '-'"></p>
                            </div>
                            <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Wilayah DPD</p>
                                <p class="font-semibold text-slate-800 mt-0.5" x-text="selectedAnggota.kabupaten ? selectedAnggota.kabupaten.nama_kabupaten : '-'"></p>
                            </div>
                            <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Tempat, Tgl Lahir</p>
                                <p class="font-semibold text-slate-800 mt-0.5">
                                    <span x-text="selectedAnggota.tempat_lahir || '-'"></span>, 
                                    <span x-text="selectedAnggota.tanggal_lahir || '-'"></span>
                                </p>
                            </div>
                            <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Jenis Kelamin</p>
                                <p class="font-semibold text-slate-800 mt-0.5" x-text="selectedAnggota.jenis_kelamin === 'L' ? 'Laki-laki' : (selectedAnggota.jenis_kelamin === 'P' ? 'Perempuan' : '-')"></p>
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100 text-xs">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Alamat Rumah</p>
                            <p class="font-semibold text-slate-800 mt-0.5" x-text="selectedAnggota.alamat || '-'"></p>
                        </div>
                    </div>
                </template>

                <!-- Modal Footer -->
                <div class="p-4 bg-slate-50 border-t border-slate-200 text-right">
                    <button @click="showModal = false" class="px-5 py-2 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs rounded-xl transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>