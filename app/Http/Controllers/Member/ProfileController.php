<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;
// Import Intervention Image kelas utama dan driver GD bawaan PHP
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
        
        // Ambil data registrasi anggota milik user yang sedang login
        $anggota = Anggota::where('user_id', $user->id)->first();
        
        // Ambil daftar kabupaten untuk pilihan di dalam form pendaftaran
        $kabupatens = Kabupaten::all();

        // JANGAN gunakan 'admin.dashboard' atau 'admin.index'!
        // Pastikan mengarah ke file 'dashboard' (resources/views/dashboard.blade.php)
        return view('dashboard', compact('user', 'anggota', 'kabupatens'));
    }

    /**
     * Simpan biodata anggota baru
     */
    public function store(Request $request)
    {
        // Validasi input tanpa membatasi ukuran maksimal (max) file foto
        $request->validate([
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'nik' => 'required|numeric|digits:16|unique:anggotas,nik',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg,webp',
        ], [
            // Pesan error kustom agar lebih informatif
            'nik.unique' => 'NIK ini sudah terdaftar di sistem!',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'pas_foto.image' => 'File yang diunggah harus berupa gambar.',
        ]);

        $user = Auth::user();

        // Path default jika upload gagal (meski divalidasi required)
        $fotoPath = null;

        // Proses kompresi dan crop pas foto otomatis
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            
            // Generate nama file unik dengan ekstensi .webp
            $filename = 'pas_foto_' . $user->id . '_' . time() . '.webp';
            
            // Tentukan folder penyimpanan di storage/app/public/pas_foto
            $destinationFolder = storage_path('app/public/pas_foto');

            // Buat folder jika belum ada di dalam storage
            if (!file_exists($destinationFolder)) {
                mkdir($destinationFolder, 0755, true);
            }

            // Inisialisasi ImageManager dengan Driver GD PHP
            $manager = new ImageManager(new Driver());
            
            // Baca berkas gambar asli
            $image = $manager->read($file);

            // Crop otomatis dari bagian tengah dengan rasio 3:4 (lebar 450px, tinggi 600px)
            $image->cover(450, 600, 'center');

            // Simpan gambar dengan format WebP dan kualitas kompresi 75%
            $image->toWebp(75)->save($destinationFolder . '/' . $filename);

            // Path relatif yang disimpan di database (sesuai setelan storage link)
            $fotoPath = 'pas_foto/' . $filename;
        }

        // Simpan data ke tabel anggotas
        Anggota::create([
            'user_id' => $user->id,
            'kabupaten_id' => $request->kabupaten_id,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pas_foto' => $fotoPath,
            'status_verifikasi' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Biodata berhasil dikirim! Mohon tunggu verifikasi dari Admin DPD.');
    }
}