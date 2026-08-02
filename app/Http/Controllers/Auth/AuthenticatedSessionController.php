<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Cek dulu apakah user ada dan status anggotanya non-aktif (SEBELUM login)
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->anggota && ! $user->anggota->is_active) {
            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan oleh Admin. Silakan hubungi pengurus.',
            ]);
        }

        // 2. Jika user aktif (atau user belum terdaftar/salah email), jalankan otentikasi Breeze normal
        $request->authenticate();

        // 3. Regenerasi session untuk user yang lolos login
        $request->session()->regenerate();

        // Ambil data user yang sedang login
        $user = Auth::user();
        $userRole = strtolower($user->role);
        $adminRoles = ['super_admin', 'admin_dpd', 'admin_dpw', 'admin'];

        // 4. Logic Redirect Berdasarkan Role (Case-Insensitive)
        if (in_array($userRole, $adminRoles)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
