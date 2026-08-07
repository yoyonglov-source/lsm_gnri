<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTA LSM GNRI - {{ $anggota->user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }
        
        /* Memaksa browser mencetak warna background (seperti header hitam bg-black) */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .kta-card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen p-4 sm:p-8 flex flex-col items-center justify-center font-sans antialiased text-slate-900">

    <!-- Action Bar / Tombol Navigasi & Cetak -->
<div class="no-print mb-6 flex items-center justify-between w-full max-w-3xl bg-slate-800 p-4 rounded-2xl border border-slate-700 shadow-xl">
    
    <!-- Tombol Kembali -->
    <a href="{{ route('admin.anggota.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-300 hover:text-white transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>

    <!-- Group Tombol Cetak & Download -->
    <div class="flex items-center gap-3">
        
        <!-- Tombol Cetak (Printer) -->
        <button onclick="window.print()" class="px-4 py-2.5 bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs rounded-xl border border-slate-600 shadow-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak
        </button>

        <!-- Tombol Download PDF -->
        <button onclick="window.print()" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download PDF
        </button>

    </div>

</div>

    <!-- Container Utama Kartu KTA -->
<div class="flex flex-col md:flex-row gap-8 items-center justify-center">

    <!-- ================= TAMPAK DEPAN ================= -->
    <div class="kta-card w-[80mm] h-[132mm] bg-white rounded-xl overflow-hidden shadow-2xl border border-slate-400 relative flex flex-col justify-between select-none">
        
        <!-- HEADER HITAM DEPAN (48% Tinggi Kartu) -->
        <div class="bg-black text-yellow-400 p-2 text-center relative h-[48%] flex flex-col justify-between border-b-2 border-yellow-500 overflow-visible">
            
            <!-- Flexbox Logo Kiri - Judul - Logo Kanan -->
            <div class="flex items-center justify-between gap-1 w-full pt-4">
                
                <!-- Logo Kiri -->
                <div class="w-[80px] h-[80px] flex-shrink-0 flex items-center justify-center">
                    <img src="{{ asset('storage/logo_kiri.png') }}" alt="Logo Kiri" class="max-w-full max-h-full object-contain">
                </div>

                <!-- Judul Header -->
                <div class="flex-1 text-center">
                    <p class="text-[9.5px] font-black tracking-wider text-yellow-400 uppercase leading-none">KARTU TANDA ANGGOTA</p>
                    <h1 class="text-xl font-black text-yellow-400 tracking-tight leading-none my-0.5">LSM GNRI</h1>
                    <p class="text-[7.5px] font-black text-yellow-400 leading-tight uppercase tracking-tight">
                        LEMBAGA SWADAYA MASYARAKAT<br>GERAKAN NAWACITA RAKYAT INDONESIA
                    </p>
                </div>

                <!-- Logo Kanan -->
                <div class="w-[80px] h-[80px] flex-shrink-0 flex items-center justify-center">
                    <img src="{{ asset('storage/logo_kanan.png') }}" alt="Logo Kanan" class="max-w-full max-h-full object-contain">
                </div>

            </div>

            <!-- Pas Foto (Posisi nangkring di perbatasan header hitam & area putih) -->
            <div class="w-[44mm] h-[54mm] bg-slate-200 border-2 border-white shadow-md overflow-hidden self-center bg-cover bg-center flex-shrink-0 -mb-16 transform translate-y-2 z-20">
                @if($anggota->pas_foto)
                    <img src="{{ asset('storage/' . $anggota->pas_foto) }}" class="w-full h-full object-cover object-top filter brightness-105 contrast-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-bold">NO FOTO</div>
                @endif
            </div>

        </div>

            <!-- IDENTITAS ANGGOTA (Area Putih Bawah) -->
        <!-- Memakai inline style padding-top & margin-top agar pasti kebaca oleh browser live tanpa tergantung build CSS -->
        <div style="padding-top: 5rem; padding-bottom: 0.5rem;" class="px-3 text-center flex-1 flex flex-col justify-center items-center">

            <!-- JABATAN & STRUKTUR WILAYAH -->
            <div style="margin-top: 0.5rem; margin-bottom: 0.25rem;">
                @php
                    $jabatanRaw = strtoupper(trim($anggota->jabatan ?? 'ANGGOTA'));
                    $namaWilayah = strtoupper($anggota->kabupaten->nama_kabupaten ?? '');
                    
                    // Cek apakah wilayah yang dipilih adalah DPW Riau
                    $isDPW = str_contains($namaWilayah, 'WILAYAH') || str_contains($namaWilayah, 'DPW');
                @endphp

                <!-- Teks Jabatan Spesifik / Anggota -->
                <p class="text-[12px] font-black text-red-600 uppercase tracking-tight leading-tight">
                    {{ $jabatanRaw }}
                </p>

                @if($isDPW)
                    <!-- Tampilan jika pilih DPW Riau -->
                    <p class="text-[11px] font-black text-red-600 uppercase tracking-tight leading-tight">
                        DEWAN PIMPINAN WILAYAH RIAU
                    </p>
                @else
                    <!-- Tampilan jika pilih Kabupaten / Kota (DPD) -->
                    <p class="text-[11px] font-black text-red-600 uppercase tracking-tight leading-tight">
                        DEWAN PIMPINAN DAERAH {{ $namaWilayah }}
                    </p>
                @endif
            </div>

            <!-- NAMA & NO KTA -->
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-wide mt-1">{{ $anggota->user->name ?? 'BELVA' }}</h3>
            <p class="text-[10px] font-mono font-bold text-slate-700 tracking-wider">{{ $anggota->no_kta ?? '009.010.011' }}</p>

        </div>
          
            <!-- FOOTER DEPAN -->
            <div class="p-2.5 bg-white border-t border-slate-300 flex items-center justify-between gap-1.5">
                <div class="w-[68%] text-black font-extrabold leading-tight text-left">
                    <p class="text-[9.5px] font-black">Email Sekretariat : <span class="font-bold">{{ $anggota->kabupaten->email_sekretariat ?? 'dpwismgnri@gmail.com' }}</span></p>
                    <p class="uppercase text-[8.5px] font-black mt-0.5 leading-tight">
                        {{ $anggota->kabupaten->alamat_sekretariat ?? 'JL. YOS SUDARSO, GG. GELATIK, RT. 004 RW. 012 KELURAHAN SRI MERANTI, KECAMATAN RUMBAI, KOTA PEKANBARU' }}
                    </p>
                </div>
                <div class="w-[32%] flex justify-end items-center">
                    <div class="p-1 bg-white rounded border-2 border-yellow-400 shadow-sm inline-block">
                        {!! QrCode::size(52)->generate(config('app.url') . '/verify-kta/' . $anggota->no_kta) !!}
                    </div>
                </div>
            </div>

        </div>


        <!-- ================= TAMPAK BELAKANG ================= -->
        <div class="kta-card w-[80mm] h-[132mm] bg-white rounded-xl overflow-hidden shadow-2xl border border-slate-400 relative flex flex-col justify-between select-none">
            
            <!-- HEADER HITAM BELAKANG -->
            <div class="bg-black text-yellow-400 px-2 py-2.5 border-b-2 border-yellow-500">
                <div class="flex items-center justify-between gap-1 w-full">
                    
                    <!-- Logo Kiri Belakang -->
                    <div class="w-[80px] h-[80px] flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('storage/logo_kiri.png') }}" alt="Logo Kiri" class="max-w-full max-h-full object-contain">
                    </div>

                    <!-- Judul Belakang -->
                    <div class="flex-4 text-center">
                        <p class="text-[9.5px] font-black tracking-wider text-yellow-400 uppercase leading-none">ANGGOTA</p>
                        <h1 class="text-lg font-black text-yellow-400 tracking-tight leading-none my-0.5">LSM GNRI</h1>
                        <p class="text-[7px] font-black text-yellow-400 leading-tight uppercase tracking-tight">
                            LEMBAGA SWADAYA MASYARAKAT<br>GERAKAN NAWACITA RAKYAT INDONESIA
                        </p>
                    </div>

                    <!-- Logo Kanan Belakang -->
                    <div class="w-[80px] h-[80px] flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('storage/logo_kanan.png') }}" alt="Logo Kanan" class="max-w-full max-h-full object-contain">
                    </div>

                </div>
            </div>

            <!-- ISI ATURAN & VISI -->
            <div class="p-3 text-black flex-1 flex flex-col justify-between">
                <div class="text-center my-1">
                    <h3 class="text-[11px] font-black uppercase tracking-tight leading-tight">
                        PERSATUAN DALAM KESETUAN MENJAGA<br>KEBUTUHAN NKRI
                    </h3>
                </div>

                <!-- POIN POIN ATURAN -->
                <ol class="text-[9.5px] font-black text-black space-y-2 leading-tight px-1 my-auto">
                    <li>1. KTA INI ADALAH BUKTI IDENTITAS SAH ANGGOTA BARU</li>
                    <li>2. KTA INI BERLAKU SELAMA PEMEGANG MASIH MENJADI ANGGOTA LSM GNRI</li>
                    <li>3. KTA INI WAJIB DIGUNAKAN SELAMA MELAKSANAKAN TUGAS LSM GNRI</li>
                    <li>4. APABILA MENEMUKAN KTA INI HARAP DIKEMBALIKAN KE ALAMAT SEKRETARIAT</li>
                </ol>

                <!-- TANDA TANGAN & STEMPEL DPP -->
                <div class="pt-2 px-1 mt-auto flex justify-center items-center">
                    <img src="{{ asset('storage/kta_footer.png') }}" class="w-full h-auto object-contain max-h-[40mm]" alt="Tanda Tangan & Stempel DPP">
                </div>
            </div>

            <!-- FOOTER SEKRETARIAT PUSAT -->
            <div class="p-2 bg-white border-t border-slate-300 text-center">
                <p class="text-[8.5px] font-black text-black uppercase tracking-tight">
                    SEKRETARIAT PUSAT : JL. KAPLONGAN RAYA NO. 1 JAKARTA TIMUR
                </p>
            </div>

        </div>

    </div>

</body>
</html>