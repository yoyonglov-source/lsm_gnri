<x-guest-layout>
    <!-- Header/Branding Mini -->
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-800">Masuk Akun</h2>
        <p class="text-xs text-slate-500 mt-1">Sistem Informasi Keanggotaan GNRI Riau</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <input id="email" 
                   class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="nama@email.com"
                   required 
                   autofocus 
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-emerald-600 hover:text-emerald-700 font-medium transition" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <input id="password" 
                   class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required 
                   autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-md border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-xs font-medium text-slate-600">Ingat Saya</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold text-sm rounded-xl shadow-sm transition-all flex justify-center items-center gap-2">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

        <!-- Footer Register Link -->
        @if (Route::has('register'))
            <div class="pt-4 text-center border-t border-slate-100">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun keanggotaan? 
                    <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition">Daftar Akun</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>