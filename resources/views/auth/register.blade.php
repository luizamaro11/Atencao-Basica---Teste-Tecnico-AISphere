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
                    class="pl-12 pr-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors @error('password') ring-2 ring-rose-200 @enderror" placeholder="••••••••">
                <!-- Botão show/hide -->
                <button type="button" id="toggle-password" aria-label="Mostrar/ocultar senha"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-stone-400 hover:text-stone-600 transition-colors">
                    <!-- Olho aberto (senha oculta) -->
                    <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <!-- Olho fechado (senha visível) -->
                    <svg class="eye-closed h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>

            <!-- Barra de força -->
            <div id="password-bars" class="mt-2 flex gap-1">
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
            </div>

            <!-- Checklist de requisitos -->
            <div id="password-hints" class="mt-3 space-y-1.5">
                <p id="hint-length" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Mínimo 8 caracteres
                </p>
                <p id="hint-upper" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Letras maiúsculas e minúsculas
                </p>
                <p id="hint-number" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Pelo menos 1 número
                </p>
                <p id="hint-symbol" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Pelo menos 1 caractere especial (!@#$%...)
                </p>
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
                    class="pl-12 pr-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" placeholder="••••••••">
                <!-- Botão show/hide da confirmação -->
                <button type="button" id="toggle-password-confirm" aria-label="Mostrar/ocultar confirmação de senha"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-stone-400 hover:text-stone-600 transition-colors">
                    <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg class="eye-closed h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
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

    <!-- Script do indicador de força de senha -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initPasswordStrength({
                inputId:      'password',
                hintsId:      'password-hints',
                barsId:       'password-bars',
                toggleBtnId:  'toggle-password',
            });

            // Show/hide simples para o campo de confirmação
            initPasswordStrength({
                inputId:     'password_confirmation',
                toggleBtnId: 'toggle-password-confirm',
            });
        });
    </script>
    @endpush
</x-guest-layout>
