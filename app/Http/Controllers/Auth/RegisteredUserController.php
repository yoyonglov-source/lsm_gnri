<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Tambahkan validasi kabupaten jika di form register ada dropdown kabupaten:
            'kabupaten_id' => ['nullable', 'exists:kabupatens,id'], 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat record draft/awal Anggota
        Anggota::create([
            'user_id' => $user->id,
            'nama_lengkap' => $user->name,
            'status_verifikasi' => 'pending',
            'kabupaten_id' => $request->kabupaten_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // OPSIONAL 1: Jika ingin langsung diarahkan ke halaman lengkapi profil
        // return redirect()->route('profile.edit')->with('info', 'Pendaftaran berhasil! Silakan lengkapi biodata Anda.');

        // OPSIONAL 2: Tetap ke dashboard (pengecekan kelengkapan nanti dilakukan di DashboardController / Blade)
        return redirect('/dashboard');
    }
}