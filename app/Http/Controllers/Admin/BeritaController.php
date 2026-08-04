<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB sebelum dikompres
        ]);

        $path = $this->compressAndStoreImage($request->file('gambar'));

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(5),
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit(strip_tags($request->konten), 150),
            'konten' => $request->konten,
            'gambar' => $path,
            'is_headline' => $request->has('is_headline') ? true : false,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(3),
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit(strip_tags($request->konten), 150),
            'konten' => $request->konten,
            'is_headline' => $request->has('is_headline') ? true : false,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $this->compressAndStoreImage($request->file('gambar'));
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Helper Function: Compress Image ke WebP/JPEG dengan Quality 70%
     */
    private function compressAndStoreImage($file)
    {
        $fileName = 'berita/' . time() . '_' . Str::random(8) . '.jpg';
        $destinationPath = storage_path('app/public/' . $fileName);

        // Pastikan direktori ada
        if (!file_exists(storage_path('app/public/berita'))) {
            mkdir(storage_path('app/public/berita'), 0755, true);
        }

        $info = getimagesize($file->getRealPath());
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file->getRealPath());
                break;
            case 'image/png':
                $image = imagecreatefrompng($file->getRealPath());
                // Handle transparansi PNG jika ada
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($file->getRealPath());
                break;
            default:
                return $file->store('berita', 'public');
        }

        // Simpan gambar dengan kompresi Kualitas 65 - 75 (Sangat Ringan)
        imagejpeg($image, $destinationPath, 70);
        imagedestroy($image);

        return $fileName;
    }
}