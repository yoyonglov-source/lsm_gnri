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

        $userRole = strtolower(trim($user->role ?? ''));

        // ADMIN / SUPERADMIN / ADMIN DPW / ADMIN DPD
        if (in_array($userRole, [
            'admin',
            'superadmin',
            'admin_dpw',
            'admin_dpd'
        ])) {

            $queryAnggota = Anggota::query();

            if ($userRole === 'admin_dpd' && $user->kabupaten_id) {
                $queryAnggota->where(
                    'kabupaten_id',
                    $user->kabupaten_id
                );
            }

            $totalAnggota = (clone $queryAnggota)
                ->where('status_verifikasi', 'disetujui')
                ->count();

            $menungguPersetujuan = (clone $queryAnggota)
                ->where('status_verifikasi', 'pending')
                ->count();

            $totalKabupaten = Kabupaten::count();

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

        // USER / ANGGOTA BIASA
        $anggota = $user->anggota;

        if (!$anggota || !$anggota->nik || !$anggota->no_hp) {
            return redirect()
                ->route('profile.edit')
                ->with(
                    'warning',
                    'Silakan lengkapi biodata Anda terlebih dahulu.'
                );
        }

        return view('dashboard', compact(
            'user',
            'anggota'
        ));
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
    public function verifikasiProses(Request $request, $id, $status)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);

        // Mencegah error jika status yang dikirim 'disetujui' atau 'approved'
        if (in_array(strtolower($status), ['disetujui', 'approved', 'approve'])) {
            
            // Validasi No. KTA
            $request->validate([
                'no_kta' => 'required|string|max:50|unique:anggotas,no_kta,' . $id,
            ], [
                'no_kta.required' => 'Nomor KTA wajib diisi.',
                'no_kta.unique'   => 'Nomor KTA ini sudah terpakai.',
            ]);

            // Simpan ke DB (Pastikan status_verifikasi bernilai 'disetujui')
            $anggota->update([
                'no_kta'            => $request->no_kta,
                'status_verifikasi' => 'disetujui',
                'is_active'         => 1,
            ]);

            return redirect()->route('admin.verifikasi.index')->with('success', "Anggota {$anggota->user->name} berhasil disetujui!");

        } elseif (in_array(strtolower($status), ['ditolak', 'rejected', 'reject'])) {
            
            $anggota->update([
                'status_verifikasi' => 'ditolak',
                'is_active'         => 0,
            ]);

            return redirect()->route('admin.verifikasi.index')->with('success', "Pendaftaran ditolak.");
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }
}