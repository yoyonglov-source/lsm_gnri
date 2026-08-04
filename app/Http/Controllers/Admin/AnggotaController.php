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
     * Simpan Data Anggota Baru (INPUT NO KTA MANUAL)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
            'nik'           => 'required|string|size:16|unique:anggotas,nik',
            'no_kta'        => 'required|string|max:50|unique:anggotas,no_kta', // FIX: Validasi No KTA Manual Unik
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
            'kabupaten_id' => $request->kabupaten_id,
        ]);

        // 2. Upload, Crop 3:4 & Compress Pas Foto
        $pasFotoPath = null;
        if ($request->hasFile('pas_foto')) {
            $pasFotoPath = $this->cropAndCompressImage($request->file('pas_foto'), 'pas_foto');
        }

        // 3. Buat Profile Anggota menggunakan No KTA yang Diinputkan Manual
        Anggota::create([
            'user_id'           => $user->id,
            'nik'               => $request->nik,
            'no_kta'            => $request->no_kta, // FIX: Menggunakan inputan manual
            'no_hp'             => $request->no_hp,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'kabupaten_id'      => $request->kabupaten_id,
            'jabatan'           => $request->jabatan ?? 'ANGGOTA',
            'status_verifikasi' => 'disetujui',
            'pas_foto'          => $pasFotoPath,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota baru berhasil ditambahkan!');
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
     * Update Data Anggota (Bisa Edit No KTA Juga)
     */
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nik'            => 'required|string|size:16|unique:anggotas,nik,' . $anggota->id,
            'no_kta'         => 'required|string|max:50|unique:anggotas,no_kta,' . $anggota->id, // FIX: Validasi Update No KTA
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
            'kabupaten_id' => $request->kabupaten_id,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // 2. Update Pas Foto dengan Crop & Compress
        $pasFotoPath = $anggota->pas_foto;

        if ($request->hasFile('pas_foto')) {
            if ($anggota->pas_foto && Storage::disk('public')->exists($anggota->pas_foto)) {
                Storage::disk('public')->delete($anggota->pas_foto);
            }
            
            $pasFotoPath = $this->cropAndCompressImage($request->file('pas_foto'), 'pas_foto');
        }

        // 3. Update Data Anggota
        $anggota->update([
            'nik'           => $request->nik,
            'no_kta'        => $request->no_kta, // FIX: simpan perbaikan No. KTA
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
        $targetWidth  = 600;  
        $targetHeight = 800;  
        $quality      = 75;   

        $filename = uniqid() . '_' . time() . '.jpg';
        $destinationPath = storage_path('app/public/' . $folder);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fullPath = $destinationPath . '/' . $filename;
        $realPath = $file->getRealPath();

        list($origWidth, $origHeight, $type) = getimagesize($realPath);

        switch ($type) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($realPath);
                
                if (function_exists('exif_read_data')) {
                    @$exif = exif_read_data($realPath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $sourceImage = imagerotate($sourceImage, 180, 0);
                                break;
                            case 6:
                                $sourceImage = imagerotate($sourceImage, -90, 0);
                                list($origWidth, $origHeight) = [$origHeight, $origWidth];
                                break;
                            case 8:
                                $sourceImage = imagerotate($sourceImage, 90, 0);
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

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        imagecopyresampled(
            $canvas, $sourceImage,
            0, 0, $srcX, $srcY,
            $targetWidth, $targetHeight, $cropWidth, $cropHeight
        );

        imagejpeg($canvas, $fullPath, $quality);

        imagedestroy($sourceImage);
        imagedestroy($canvas);

        return $folder . '/' . $filename;
    }
}