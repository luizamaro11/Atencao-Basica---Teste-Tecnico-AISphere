<x-guest-layout>
    <!-- Cabeçalho -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-semibold text-stone-800">Novo Cadastro</h2>
        <p class="text-sm text-stone-500 mt-2">Crie sua conta para acessar o sistema.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Nome Completo') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors @error('name') ring-2 ring-rose-200 @enderror" placeholder="João da Silva">
            </div>
            @error('name')
                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-stone-600 mb-2">{{ __('E-mail') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
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
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors @error('password') ring-2 ring-rose-200 @enderror" placeholder="••••••••">
            </div>
            @error('password')
                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Confirmar Senha') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" placeholder="••••••••">
            </div>
            @error('password_confirmation')
                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all">
                {{ __('Criar Conta') }}
            </button>
        </div>
    </form>

    <!-- Área de Voltar para Login -->
    <div class="mt-8 pt-8 border-t border-stone-100 text-center">
        <p class="text-sm text-stone-500 mb-4">Já tem uma conta?</p>
        <a href="{{ route('login') }}" class="w-full flex justify-center items-center py-4 px-4 border border-stone-200 rounded-full shadow-sm text-sm font-medium text-stone-600 bg-white hover:bg-stone-50 focus:outline-none transition-colors">
            {{ __('Fazer Login') }}
        </a>
    </div>
</x-guest-layout>
