<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi KTA Gagal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans text-slate-100">

    <div class="w-full max-w-md bg-slate-800 rounded-2xl border border-slate-700 shadow-2xl overflow-hidden p-6 text-center">
        
        <!-- Icon Error -->
        <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/30 text-red-500 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h1 class="text-lg font-black text-white uppercase mb-2">VERIFIKASI GAGAL</h1>
        <p class="text-xs text-red-400 font-semibold mb-6">{{ $message }}</p>

        <div class="p-4 bg-slate-900/60 rounded-xl border border-slate-700/50 text-[11px] text-slate-400 leading-relaxed text-left">
            <p class="font-bold text-slate-300 mb-1">Catatan:</p>
            <p>Kartu Tanda Anggota (KTA) tidak terdaftar di sistem pusat LSM GNRI atau masa berlaku keanggotaan sudah berakhir.</p>
        </div>

        <div class="mt-6 text-[10px] text-slate-500">
            © {{ date('Y') }} LSM GNRI. Official Verification System.
        </div>

    </div>

</body>
</html>