<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::all();
        return view('admin.kabupaten.index', compact('kabupatens'));
    }

    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'email_sekretariat' => 'nullable|email|max:255',
            'alamat_sekretariat' => 'nullable|string',
        ]);

        $kabupaten->update([
            'email_sekretariat' => $request->email_sekretariat,
            'alamat_sekretariat' => $request->alamat_sekretariat,
        ]);

        return redirect()->back()->with('success', 'Data Sekretariat berhasil diperbarui!');
    }
}