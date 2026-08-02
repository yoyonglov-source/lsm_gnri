<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama DPW/DPD') }}
        </h2>
    </x-slot>

    <!-- Mengubah py-12 menjadi py-6 sm:py-12 agar spasi atas-bawah di HP lebih efisien -->
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl sm:rounded-lg">
                <!-- Mengubah p-6 menjadi p-4 sm:p-6 agar konten di HP tidak kesempitan -->
                <div class="p-4 sm:p-6 text-gray-900">
                    
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 mb-2">
                        Selamat Datang di SIM LSM GNRI Riau
                    </h3>
                    
                    <!-- Informasi Role & Wilayah Tugas (Aman di Mobile karena flex-wrap) -->
                    <div class="text-xs sm:text-sm text-gray-600 mb-4 flex flex-wrap items-center gap-2">
                        <span>Anda login sebagai:</span>
                        <span class="px-2.5 py-0.5 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full uppercase">
                            {{ Auth::user()->role }}
                        </span>
                        
                        @if(Auth::user()->role === 'admin_dpd' && Auth::user()->kabupaten)
                            <span class="text-gray-300 hidden sm:inline">|</span>
                            <span>Wilayah Tugas:</span>
                            <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 text-xs font-semibold rounded-full">
                                {{ Auth::user()->kabupaten->nama_kabupaten }}
                            </span>
                        @elseif(Auth::user()->role === 'super_admin')
                            <span class="text-gray-300 hidden sm:inline">|</span>
                            <span>Cakupan Wilayah:</span>
                            <span class="px-2.5 py-0.5 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                DPW Provinsi Riau (Semua Kabupaten)
                            </span>
                        @endif
                    </div>
                    
                    <hr class="my-4 border-gray-100">
                    
                    <!-- Grid Statistik yang Responsif (1 kolom di HP, 2 di Tablet, 3 di Desktop) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        
                        <!-- Card Stats 1 -->
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl shadow-sm hover:shadow transition">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ Auth::user()->role === 'admin_dpd' ? 'Total Anggota ' . (Auth::user()->kabupaten->nama_kabupaten ?? '') : 'Total Anggota Riau' }}
                            </p>
                            <p class="text-2xl sm:text-3xl font-bold text-slate-700 mt-2">
                                {{ $totalAnggota }}
                            </p>
                        </div>
                        
                        <!-- Card Stats 2 -->
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl shadow-sm hover:shadow transition">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menunggu Persetujuan DPD</p>
                            <p class="text-2xl sm:text-3xl font-bold text-amber-600 mt-2">
                                {{ $menungguPersetujuan }}
                            </p>
                        </div>

                        <!-- Card Stats 3 -->
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl shadow-sm hover:shadow transition">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kabupaten Terdata</p>
                            <p class="text-2xl sm:text-3xl font-bold text-emerald-600 mt-2">
                                {{ $totalKabupaten ?? 13 }}
                            </p>
                        </div>

                        <!-- Widget List Pendaftaran Baru -->
<div class="mt-8 bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h4 class="font-bold text-slate-800 text-base">Pendaftar Baru (Perlu Verifikasi)</h4>
            <p class="text-xs text-slate-500">Daftar anggota yang mendaftar mandiri dan menunggu persetujuan.</p>
        </div>
        <a href="{{ route('admin.verifikasi.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">
            Lihat Semua &rarr;
        </a>
    </div>

    @if(isset($pendaftarBaru) && $pendaftarBaru->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 border-b border-slate-200">
                        <th class="p-3">Nama Lengkap</th>
                        <th class="p-3">Tanggal Daftar</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pendaftarBaru as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-medium text-slate-800">{{ $item->nama_lengkap ?? $item->user->name }}</td>
                            <td class="p-3 text-slate-500">{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-amber-100 text-amber-800 rounded-full uppercase">
                                    {{ $item->status_verifikasi }}
                                </span>
                            </td>
                            <td class="p-3 text-right">
                                <a href="{{ route('admin.verifikasi.index') }}" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition">
                                    Verifikasi
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-6 text-center text-slate-400 text-xs sm:text-sm bg-slate-50 rounded-lg">
            Belum ada pendaftaran anggota baru yang menunggu persetujuan.
        </div>
    @endif
</div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>