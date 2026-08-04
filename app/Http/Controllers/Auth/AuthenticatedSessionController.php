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
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Normalisasi role agar "admin", "Admin", "ADMIN" dianggap sama
        $userRole = strtolower(trim($user->role ?? ''));

        // Role yang dianggap sebagai Admin
        $adminRoles = [
            'admin',
            'superadmin',
            'admin_dpw',
            'admin_dpd',
        ];

        // Jika yang login adalah Admin -> langsung ke Dashboard Admin
        if (in_array($userRole, $adminRoles)) {
            return redirect()->route('admin.dashboard');
        }

        // Jika User / Anggota biasa -> ke Dashboard Anggota
        return redirect()->intended(route('dashboard'));
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
