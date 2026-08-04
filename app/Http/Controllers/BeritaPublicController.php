<?php 

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index()
    {
        // 1. Ambil 1 Berita Headline Terbaru
        $headline = Berita::where('is_headline', true)->latest()->first();

        // Jika tidak ada berita yang di-set headline, pakai berita terbaru pertama
        if (!$headline) {
            $headline = Berita::latest()->first();
        }

        // 2. Ambil Berita Lainnya dengan Pagination (6 items per halaman)
        $beritaQuery = Berita::latest();
        
        if ($headline) {
            $beritaQuery->where('id', '!=', $headline->id);
        }

        $beritas = $beritaQuery->paginate(6);

        return view('berita.index', compact('headline', 'beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaTerkait = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}