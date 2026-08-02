<x-guest-layout>
    <!-- Header/Branding Mini -->
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-800">Registrasi Akun Baru</h2>
        <p class="text-xs text-slate-500 mt-1">Sistem Informasi Keanggotaan GNRI Riau</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
            <input id="name" 
                   class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Sesuai KTP"
                   required 
                   autofocus 
                   autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

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
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
            <input id="password" 
                   class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                   type="password"
                   name="password"
                   placeholder="Minimal 8 karakter"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Konfirmasi Password</label>
            <input id="password_confirmation" 
                   class="w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                   type="password"
                   name="password_confirmation"
                   placeholder="Ulangi password"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold text-sm rounded-xl shadow-sm transition-all flex justify-center items-center gap-2">
                <span>Daftar Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

        <!-- Footer Login Link -->
        <div class="pt-4 text-center border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>