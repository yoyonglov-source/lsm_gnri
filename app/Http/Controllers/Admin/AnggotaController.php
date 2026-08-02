<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar master data anggota
     */
    public function index(Request $request)
    {
        $query = Anggota::with(['user', 'kabupaten']);

        // Filter Search (Nama, NIK, No KTA, No HP)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('no_kta', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan Kabupaten/DPD
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        $anggotas = $query->latest()
                          ->take(100) 
                          ->paginate(20)
                          ->withQueryString();

        $kabupatens = Kabupaten::all();

        return view('admin.anggota.index', compact('anggotas', 'kabupatens'));
    }

    /**
     * Fitur Cepat: Non-aktifkan / Aktifkan Anggota
     */
    public function toggleStatus($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->is_active = !$anggota->is_active;
        $anggota->save();

        $statusText = $anggota->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()->with('success', "Status anggota {$anggota->user->name} berhasil {$statusText}!");
    }

    /**
     * Cetak KTA Anggota
     */
    public function cetakKta($id)
    {
        $anggota = Anggota::with(['user', 'kabupaten'])->findOrFail($id);
        
        return view('admin.anggota.cetak-kta', compact('anggota'));
    }

    public function create()
    {
        $kabupatens = Kabupaten::all();
        return view('admin.anggota.create', compact('kabupatens'));
    }

    /**
     * Simpan Data Anggota Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
            'nik'           => 'required|string|size:16|unique:anggotas,nik',
            'no_hp'         => 'required|string|max:20',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'kabupaten_id'  => 'required|exists:kabupatens,id',
            'jabatan'       => 'nullable|string|max:100',
            'pas_foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // max 10MB
        ]);

        // 1. Buat User Login (Termasuk KABUPATEN_ID agar tidak kosong)
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => 'user',
            'kabupaten_id' => $request->kabupaten_id, // FIX: simpan ke tabel users
        ]);

        // 2. Upload, Crop 3:4 & Compress Pas Foto
        $pasFotoPath = null;
        if ($request->hasFile('pas_foto')) {
            $pasFotoPath = $this->cropAndCompressImage($request->file('pas_foto'), 'pas_foto');
        }

        // 3. Generate No KTA
        $noKta = 'GNRI.' . date('Ym') . '.' . sprintf('%04d', $user->id);

        // 4. Buat Profile Anggota
        Anggota::create([
            'user_id'       => $user->id,
            'nik'           => $request->nik,
            'no_kta'        => $noKta,
            'no_hp'         => $request->no_hp,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'kabupaten_id'  => $request->kabupaten_id,
            'jabatan'       => $request->jabatan ?? 'ANGGOTA',
            'status_verifikasi' => 'disetujui',
            'pas_foto'      => $pasFotoPath,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Form Edit Anggota
     */
    public function edit($id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);
        $kabupatens = Kabupaten::all();

        return view('admin.anggota.edit', compact('anggota', 'kabupatens'));
    }

    /**
     * Update Data Anggota
     */
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nik'            => 'required|string|size:16|unique:anggotas,nik,' . $anggota->id,
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'no_hp'          => 'required|string|max:15',
            'kabupaten_id'   => 'required|exists:kabupatens,id',
            'jabatan'        => 'nullable|string|max:100',
            'alamat'         => 'required|string',
            'pas_foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        // 1. Update User (Akun Login & KABUPATEN_ID)
        $userData = [
            'name'         => $request->name,
            'email'        => $request->email,
            'kabupaten_id' => $request->kabupaten_id, // FIX: update kabupaten_id di tabel users
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // 2. Update Pas Foto dengan Crop & Compress
        $pasFotoPath = $anggota->pas_foto;

        if ($request->hasFile('pas_foto')) {
            // Hapus foto lama jika ada
            if ($anggota->pas_foto && Storage::disk('public')->exists($anggota->pas_foto)) {
                Storage::disk('public')->delete($anggota->pas_foto);
            }
            
            // Simpan foto baru (cropped & compressed)
            $pasFotoPath = $this->cropAndCompressImage($request->file('pas_foto'), 'pas_foto');
        }

        // 3. Update Data Anggota
        $anggota->update([
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'         => $request->no_hp,
            'kabupaten_id'  => $request->kabupaten_id,
            'alamat'        => $request->alamat,
            'is_active'     => $request->has('is_active') ? 1 : 0,
            'pas_foto'      => $pasFotoPath,
            'jabatan'       => $request->jabatan,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Hapus Data Anggota
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;

        if ($anggota->pas_foto && Storage::disk('public')->exists($anggota->pas_foto)) {
            Storage::disk('public')->delete($anggota->pas_foto);
        }

        $anggota->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }

    /**
     * Helper Function: Fix EXIF Rotation + Crop 3:4 + Compress Gambar
     */
    private function cropAndCompressImage($file, $folder)
    {
        $targetWidth  = 600;  // Lebar standar pas foto HD
        $targetHeight = 800;  // Tinggi rasio 3:4
        $quality      = 75;   // Kompresi JPG

        $filename = uniqid() . '_' . time() . '.jpg';
        $destinationPath = storage_path('app/public/' . $folder);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fullPath = $destinationPath . '/' . $filename;
        $realPath = $file->getRealPath();

        // 1. Ambil info gambar
        list($origWidth, $origHeight, $type) = getimagesize($realPath);

        // Load Resource Gambar
        switch ($type) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($realPath);
                
                // 2. BACA DATA EXIF DAN FIX ORIENTASI (KHUSUS JPG/JPEG)
                if (function_exists('exif_read_data')) {
                    @$exif = exif_read_data($realPath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $sourceImage = imagerotate($sourceImage, 180, 0);
                                break;
                            case 6: // Rotasi 90 derajat searah jarum jam (paling sering di HP)
                                $sourceImage = imagerotate($sourceImage, -90, 0);
                                // Swap dimensi karena gambar diputar 90 derajat
                                list($origWidth, $origHeight) = [$origHeight, $origWidth];
                                break;
                            case 8: // Rotasi 90 derajat berlawanan jarum jam
                                $sourceImage = imagerotate($sourceImage, 90, 0);
                                // Swap dimensi
                                list($origWidth, $origHeight) = [$origHeight, $origWidth];
                                break;
                        }
                    }
                }
                break;

            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($realPath);
                break;

            default:
                return $file->store($folder, 'public');
        }

        // 3. Kalkulasi Center-Crop (Rasio 3:4)
        $targetRatio = $targetWidth / $targetHeight;
        $sourceRatio = $origWidth / $origHeight;

        if ($sourceRatio > $targetRatio) {
            $cropWidth  = (int)($origHeight * $targetRatio);
            $cropHeight = $origHeight;
            $srcX       = (int)(($origWidth - $cropWidth) / 2);
            $srcY       = 0;
        } else {
            $cropWidth  = $origWidth;
            $cropHeight = (int)($origWidth / $targetRatio);
            $srcX       = 0;
            $srcY       = (int)(($origHeight - $cropHeight) / 2);
        }

        // 4. Buat Canvas Baru ukuran 600x800
        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        // Resize & Crop dari Source ke Canvas
        imagecopyresampled(
            $canvas, $sourceImage,
            0, 0, $srcX, $srcY,
            $targetWidth, $targetHeight, $cropWidth, $cropHeight
        );

        // 5. Simpan sebagai JPG Terkompresi
        imagejpeg($canvas, $fullPath, $quality);

        // Clean Up Memory
        imagedestroy($sourceImage);
        imagedestroy($canvas);

        return $folder . '/' . $filename;
    }
}