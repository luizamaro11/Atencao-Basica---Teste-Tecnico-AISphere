<x-guest-layout>
    <!-- Cabeçalho -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-semibold text-stone-800">Bem-vindo de volta</h2>
        <p class="text-sm text-stone-500 mt-2">Faça login para gerenciar seus pacientes.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-stone-600 mb-2">{{ __('E-mail') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors @error('email') ring-2 ring-rose-200 @enderror" placeholder="seu@email.com">
            </div>
            @error('email')
                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Senha') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors @error('password') ring-2 ring-rose-200 @enderror" placeholder="••••••••">
            </div>
            @error('password')
                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-md border-stone-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                <span class="ms-2 text-sm text-stone-600 group-hover:text-stone-800 transition-colors">{{ __('Lembrar de mim') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-teal-600 hover:text-teal-800 font-medium transition-colors" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all">
                {{ __('Entrar no Sistema') }}
            </button>
        </div>
    </form>

    <!-- Área de Registro (Novo) -->
    <div class="mt-8 pt-8 border-t border-stone-100 text-center">
        <p class="text-sm text-stone-500 mb-4">Ainda não possui uma conta na clínica?</p>
        <a href="{{ route('register') }}" class="w-full flex justify-center items-center py-4 px-4 border border-stone-200 rounded-full shadow-sm text-sm font-medium text-stone-600 bg-white hover:bg-stone-50 focus:outline-none transition-colors">
            {{ __('Criar nova conta') }}
        </a>
    </div>
</x-guest-layout>
