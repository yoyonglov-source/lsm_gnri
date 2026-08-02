<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi KTA - {{ $anggota->user->name }}</title>

    <!-- Tailwind CSS CDN (Lancar diakses dari HP mana saja) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Font & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4 antialiased text-slate-100">

    <div class="w-full max-w-sm bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden relative">
        
        <!-- Top Accent Gradient Line -->
        <div class="h-2 bg-gradient-to-r from-yellow-500 via-amber-400 to-yellow-600"></div>

        <div class="p-6 text-center">

            <!-- Status Badge (Verified) -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span>KTA RESMI & AKTIF</span>
            </div>

            <!-- Header Lembaga -->
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-yellow-400 tracking-wide uppercase">LSM GNRI</h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">
                    Gerakan Nawacita Rakyat Indonesia
                </p>
            </div>

            <!-- Pas Foto Frame (Terskala Presisi & Tidak Membesar) -->
            <div class="relative w-36 h-48 mx-auto mb-6">
                <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-yellow-400 shadow-xl bg-slate-800">
                    @if($anggota->pas_foto)
                        <img src="{{ asset('storage/' . $anggota->pas_foto) }}" alt="{{ $anggota->user->name }}" class="w-full h-full object-cover object-top">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                            <i class="fa-solid fa-user text-3xl mb-1"></i>
                            <span class="text-[10px] font-bold">NO FOTO</span>
                        </div>
                    @endif
                </div>
                <!-- Mini Verified Shield Icon -->
                <div class="absolute -bottom-2 -right-2 bg-yellow-400 text-slate-950 w-8 h-8 rounded-full flex items-center justify-center shadow-lg border-2 border-slate-900">
                    <i class="fa-solid fa-shield-halved text-sm"></i>
                </div>
            </div>

            <!-- Identitas Anggota -->
            <div class="space-y-1 mb-6">
                <h2 class="text-xl font-extrabold text-white uppercase tracking-tight leading-snug">
                    {{ $anggota->user->name }}
                </h2>
                <p class="text-xs font-extrabold text-red-500 uppercase tracking-wider">
                    {{ $anggota->jabatan ?? 'ANGGOTA' }}
                </p>
            </div>

            <!-- Info Box Nomor KTA -->
            <div class="bg-slate-950/80 rounded-2xl p-3.5 border border-slate-800 mb-6">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nomor Keanggotaan (KTA)</span>
                <span class="text-base font-mono font-black text-yellow-400 tracking-wider">
                    {{ $anggota->no_kta }}
                </span>
            </div>

            <!-- Footer / System Stamp -->
            <div class="pt-4 border-t border-slate-800/80 text-[10px] text-slate-400 space-y-1">
                <p class="font-bold text-slate-400">Verifikasi Sistem Informasi SIM-GNRI</p>
                <p>© {{ date('Y') }} LSM GNRI. Data ini sah dan terdaftar resmi.</p>
            </div>

        </div>
    </div>

</body>
</html>