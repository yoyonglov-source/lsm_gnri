<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    // 1. JIKA USER ADALAH ADMIN (DPW / DPD)
    if (in_array($user->role, ['admin_dpw', 'admin_dpd'])) {
        $queryAnggota = Anggota::query();

        if ($user->role === 'admin_dpd' && $user->kabupaten_id) {
            $queryAnggota->where('kabupaten_id', $user->kabupaten_id);
        }

        $totalAnggota = (clone $queryAnggota)->where('status_verifikasi', 'disetujui')->count();
        $menungguPersetujuan = (clone $queryAnggota)->where('status_verifikasi', 'pending')->count();
        $totalKabupaten = Kabupaten::count();

        // Ambil 5 pendaftar pending terbaru
        $pendaftarBaru = (clone $queryAnggota)
                            ->where('status_verifikasi', 'pending')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalAnggota', 
            'menungguPersetujuan', 
            'totalKabupaten',
            'pendaftarBaru'
        ));
    }

    // 2. JIKA USER ADALAH ANGGOTA BIASA (USER REGISTER)
    $anggota = $user->anggota; // Relasi ke tabel anggotas

    // Jika biodata belum diisi lengkap (misal NIK / No HP masih kosong), redirect langsung ke form isi profil!
    if (!$anggota || !$anggota->nik || !$anggota->no_hp) {
        return redirect()->route('profile.edit')->with('warning', 'Silakan lengkapi biodata Anda terlebih dahulu.');
    }

    // Jika sudah diisi lengkap, tampilkan dashboard anggota biasa
    return view('dashboard', compact('user', 'anggota'));
    }

    public function verifikasiList()
    {
        $user = Auth::user();
        $query = Anggota::query();

        // Filter agar Admin DPD hanya melihat calon anggota di kabupaten wilayah tugasnya
        if ($user->role === 'admin_dpd' && $user->kabupaten_id) {
            $query->where('kabupaten_id', $user->kabupaten_id);
        }

        // Ambil data anggota yang masih pending beserta info user-nya
        $calonAnggota = $query->where('status_verifikasi', 'pending')->with('user')->get();

        return view('admin.verifikasi_index', compact('calonAnggota'));
    }

    /**
     * Memproses persetujuan atau penolakan anggota
     */
    public function verifikasiProses($id, $status)
    {
        // 1. Validasi parameter status yang diizinkan
        if (!in_array($status, ['disetujui', 'ditolak'])) {
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        $user = Auth::user();
        $anggota = Anggota::findOrFail($id);

        // 2. Keamanan Tambahan: Pastikan admin DPD tidak memverifikasi dari luar wilayahnya
        if ($user->role === 'admin_dpd' && $user->kabupaten_id !== $anggota->kabupaten_id) {
            abort(403, 'Anda tidak memiliki hak akses untuk memverifikasi anggota di luar wilayah tugas Anda.');
        }

        // 3. Update status verifikasi
        $anggota->status_verifikasi = $status;

        // 4. JIKA DISETUJUI & BELUM PUNYA KTA -> GENERATE NOMOR KTA OTOMATIS
        if ($status === 'disetujui' && empty($anggota->no_kta)) {
            $kodeKabupaten = $anggota->kabupaten_id ? sprintf('%02d', $anggota->kabupaten_id) : '00';
            $tahun = date('Y');
            $random = sprintf('%03d', rand(1, 999));
            
            $anggota->no_kta = "GNRI-{$kodeKabupaten}-{$tahun}-{$random}";
        }

        $anggota->save();

        $pesan = $status === 'disetujui' 
            ? 'Anggota berhasil disetujui dan Nomor KTA telah diterbitkan!' 
            : 'Pendaftaran anggota telah ditolak.';

        return redirect()->route('admin.verifikasi.index')->with('success', $pesan);
    }
}