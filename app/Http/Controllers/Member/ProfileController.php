<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Tampilkan form pengisian biodata atau status verifikasi
     */
    public function index()
    {
        $user = Auth::user();

        // Jika Admin nyasar ke /dashboard biasa, alihkan dengan mulus ke /admin/dashboard
        if (in_array($user->role, ['admin', 'superadmin', 'admin_dpw', 'admin_dpd'])) {
            return redirect()->route('admin.dashboard');
        }
        
        // Ambil data registrasi anggota milik user yang sedang login
        $anggota = Anggota::where('user_id', $user->id)->first();
        
        // Ambil daftar kabupaten untuk pilihan di dalam form pendaftaran
        $kabupatens = Kabupaten::all();

        return view('dashboard', compact('user', 'anggota', 'kabupatens'));
    }

    /**
     * Simpan / Update biodata anggota baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'nik' => 'required|numeric|digits:16|unique:anggotas,nik,' . ($user->anggota->id ?? 'NULL'),
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg,webp',
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar di sistem!',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'pas_foto.image' => 'File yang diunggah harus berupa gambar.',
        ]);

        // Path foto lama (jika ada)
        $fotoPath = $user->anggota?->pas_foto;

        // Proses kompresi dan crop pas foto otomatis
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            $filename = 'pas_foto_' . $user->id . '_' . time() . '.webp';
            $destinationFolder = storage_path('app/public/pas_foto');

            if (!file_exists($destinationFolder)) {
                mkdir($destinationFolder, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->cover(450, 600, 'center');
            $image->toWebp(75)->save($destinationFolder . '/' . $filename);

            $fotoPath = 'pas_foto/' . $filename;
        }

        // UPDATE / CREATE DATA ANGGOTA (Mencegah duplicate key error)
        Anggota::updateOrCreate(
            ['user_id' => $user->id],
            [
                'kabupaten_id' => $request->kabupaten_id,
                'nama_lengkap' => $user->name,
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pas_foto' => $fotoPath,
                'status_verifikasi' => 'pending',
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Biodata berhasil dikirim! Mohon tunggu verifikasi dari Admin DPD.');
    }
}