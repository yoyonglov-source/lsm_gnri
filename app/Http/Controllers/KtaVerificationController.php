<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class KtaVerificationController extends Controller
{
    public function verify($no_kta)
    {
        $noKtaClean = trim($no_kta);

        // Cari Anggota berdasarkan no_kta
        $anggota = Anggota::whereRaw('LOWER(no_kta) = ?', [strtolower($noKtaClean)])
                    ->first();

        // 1. Cek Apakah Anggota Ditemukan & Memiliki No KTA
        if (!$anggota || empty($anggota->no_kta)) {
            return view('kta.verify-failed', [
                'success' => false,
                'message' => 'Nomor KTA tidak ditemukan atau belum terdaftar.'
            ]);
        }

        // 2. Cek Status Verifikasi (Harus 'disetujui')
        if ($anggota->status_verifikasi !== 'disetujui') {
            return view('kta.verify-failed', [
                'success' => false,
                'message' => 'KTA ini masih dalam proses verifikasi atau tidak disetujui.'
            ]);
        }

        // 3. Cek Status Keaktifan (Harus 1 / true)
        if (!$anggota->is_active) {
            return view('kta.verify-failed', [
                'success' => false,
                'message' => 'Status keanggotaan ini sudah tidak aktif.'
            ]);
        }

        // Jika Lolos Pengecekan -> Tampilkan View Sukses
        return view('kta.verify-success', [
            'success' => true,
            'anggota' => $anggota
        ]);
    }

    // Method dari Form Pencarian Web
    public function search(Request $request)
    {
        $request->validate([
            'no_kta' => 'required|string',
        ]);

        $noKta = trim($request->input('no_kta'));

        return redirect()->route('kta.verify', ['no_kta' => $noKta]);
    }
}