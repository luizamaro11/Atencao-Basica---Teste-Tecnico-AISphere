<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Atualizar Senha') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Use uma senha longa e aleatória para manter sua conta segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Senha Atual -->
        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-stone-600 mb-1">
                {{ __('Senha Atual') }}
            </label>
            <div class="relative">
                <input id="update_password_current_password" name="current_password" type="password"
                    autocomplete="current-password"
                    class="pr-12 w-full bg-stone-50 border border-stone-200 focus:ring-2 focus:ring-teal-200 focus:border-transparent text-stone-800 rounded-xl py-2.5 px-3 transition-colors
                        @error('current_password', 'updatePassword') ring-2 ring-rose-200 @enderror"
                    placeholder="••••••••">
                <button type="button" id="toggle-current-password" aria-label="Mostrar/ocultar senha atual"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600 transition-colors">
                    <svg class="eye-open h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg class="eye-closed h-4 w-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nova Senha -->
        <div>
            <label for="update_password_password" class="block font-medium text-sm text-stone-600 mb-1">
                {{ __('Nova Senha') }}
            </label>
            <div class="relative">
                <input id="update_password_password" name="password" type="password"
                    autocomplete="new-password"
                    class="pr-12 w-full bg-stone-50 border border-stone-200 focus:ring-2 focus:ring-teal-200 focus:border-transparent text-stone-800 rounded-xl py-2.5 px-3 transition-colors
                        @error('password', 'updatePassword') ring-2 ring-rose-200 @enderror"
                    placeholder="••••••••">
                <button type="button" id="toggle-new-password" aria-label="Mostrar/ocultar nova senha"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600 transition-colors">
                    <svg class="eye-open h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg class="eye-closed h-4 w-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>

            <!-- Barra de força -->
            <div id="profile-password-bars" class="mt-2 flex gap-1">
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
                <div data-bar class="h-1.5 flex-1 rounded-full bg-stone-200 transition-all duration-300"></div>
            </div>

            <!-- Checklist de requisitos -->
            <div id="profile-password-hints" class="mt-2 space-y-1">
                <p id="profile-hint-length" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Mínimo 8 caracteres
                </p>
                <p id="profile-hint-upper" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Maiúsculas e minúsculas
                </p>
                <p id="profile-hint-number" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Pelo menos 1 número
                </p>
                <p id="profile-hint-symbol" class="flex items-center gap-2 text-xs text-stone-400 transition-colors duration-200">
                    <span class="hint-icon font-bold">○</span> Pelo menos 1 caractere especial
                </p>
            </div>

            @error('password', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar Nova Senha -->
        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-stone-600 mb-1">
                {{ __('Confirmar Nova Senha') }}
            </label>
            <div class="relative">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password"
                    class="pr-12 w-full bg-stone-50 border border-stone-200 focus:ring-2 focus:ring-teal-200 focus:border-transparent text-stone-800 rounded-xl py-2.5 px-3 transition-colors"
                    placeholder="••••••••">
                <button type="button" id="toggle-confirm-password" aria-label="Mostrar/ocultar confirmação"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600 transition-colors">
                    <svg class="eye-open h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg class="eye-closed h-4 w-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-2.5 rounded-full text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all">
                {{ __('Salvar') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-teal-600 font-medium"
                >{{ __('Senha atualizada!') }}</p>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof initPasswordStrength === 'function') {
                initPasswordStrength({
                    inputId:     'update_password_current_password',
                    toggleBtnId: 'toggle-current-password',
                });
                initPasswordStrength({
                    inputId:     'update_password_password',
                    hintsId:     'profile-password-hints',
                    barsId:      'profile-password-bars',
                    toggleBtnId: 'toggle-new-password',
                });
                initPasswordStrength({
                    inputId:     'update_password_password_confirmation',
                    toggleBtnId: 'toggle-confirm-password',
                });
            }
        });
    </script>
</section>
