<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     * Menerima parameter role tunggal maupun banyak (misal: 'role:superadmin,admin_dpw')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Jika belum login, tendang ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = strtolower($user->role);

        // Kumpulan semua role bertipe Admin
        $adminRoles = ['superadmin', 'super_admin', 'admin_dpw', 'admin_dpd', 'admin'];

        // Normalisasi parameter $roles yang di-pass dari route
        $allowedRoles = array_map('strtolower', $roles);

        // 2. Jika route meminta role spesifik dan user MEMILIKI role tersebut -> Lolos
        if (!empty($allowedRoles) && in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // 3. Proteksi Akses:
        // Jika User Biasa / Anggota mencoba masuk ke Route Admin (URL diawali /admin)
        if (!in_array($userRole, $adminRoles) && $request->is('admin*')) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Admin.');
        }

        // Jika Admin mencoba masuk ke halaman User biasa (/dashboard), langsung auto-redirect ke Admin Dashboard
        if (in_array($userRole, $adminRoles) && !$request->is('admin*')) {
            return redirect()->route('admin.dashboard');
        }

        // Jika user mempunyai akses sesuai kriteria di atas
        if (empty($allowedRoles)) {
            return $next($request);
        }

        // default fallback jika role tidak cocok sama sekali
        abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
    }
}