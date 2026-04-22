<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-stone-800 leading-tight">
                {{ __('Meu Perfil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition.duration.500ms class="p-4 rounded-2xl bg-teal-50 border border-teal-100 flex justify-between items-center shadow-sm">
                    <div class="flex items-center text-teal-800">
                        <div class="bg-teal-100 rounded-full p-1 mr-3">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-medium text-sm">Perfil atualizado com sucesso!</span>
                    </div>
                    <button @click="show = false" class="text-teal-600 hover:text-teal-800 transition-colors p-1 rounded-full hover:bg-teal-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-stone-200/50 shadow-sm overflow-hidden">
                
                <!-- Informações do Perfil -->
                <div class="p-8 sm:p-10 border-b border-stone-100">
                    <header class="mb-8">
                        <h2 class="text-xl font-semibold text-stone-800">
                            {{ __('Informações Pessoais') }}
                        </h2>
                        <p class="mt-1 text-sm text-stone-500">
                            {{ __("Atualize suas informações de conta, e-mail e foto de perfil.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 max-w-2xl">
                        @csrf
                        @method('patch')

                        <!-- Foto de Perfil -->
                        <div class="mb-8">
                            <label class="block font-medium text-sm text-stone-600 mb-2">Foto de Perfil</label>
                            <div class="relative group cursor-pointer w-32 h-32" x-data="{ photoName: null, photoPreview: '{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}' }">
                                <input type="file" name="profile_image" id="profile_image" class="hidden" x-ref="photo" 
                                    x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                    " accept="image/*" />
                                
                                <label for="profile_image" class="cursor-pointer block w-32 h-32 rounded-full overflow-hidden border-4 border-stone-50 bg-stone-50 shadow-sm group-hover:border-teal-100 transition-all duration-300 relative">
                                    <div x-show="!photoPreview" class="w-full h-full flex items-center justify-center text-stone-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div x-show="photoPreview" style="display: none;" class="w-full h-full">
                                        <span class="block w-full h-full bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                                    </div>
                                    <div class="absolute inset-0 bg-stone-800 bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                </label>
                            </div>
                            @error('profile_image')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Nome Completo') }}</label>
                            <input id="name" name="name" type="text" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block font-medium text-sm text-stone-600 mb-2">{{ __('E-mail') }}</label>
                            <input id="email" name="email" type="email" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                            @error('email')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-600 border border-transparent rounded-full font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all">
                                {{ __('Salvar Alterações') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Alterar Senha -->
                <div class="p-8 sm:p-10 border-b border-stone-100">
                    <header class="mb-8">
                        <h2 class="text-xl font-semibold text-stone-800">
                            {{ __('Alterar Senha') }}
                        </h2>
                        <p class="mt-1 text-sm text-stone-500">
                            {{ __('Certifique-se de usar uma senha longa e aleatória para manter sua conta segura.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-2xl">
                        @csrf
                        @method('put')

                        <div>
                            <label for="update_password_current_password" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Senha Atual') }}</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" autocomplete="current-password" />
                            @error('current_password', 'updatePassword')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Nova Senha') }}</label>
                            <input id="update_password_password" name="password" type="password" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" autocomplete="new-password" />
                            @error('password', 'updatePassword')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password_confirmation" class="block font-medium text-sm text-stone-600 mb-2">{{ __('Confirmar Nova Senha') }}</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-3 transition-colors" autocomplete="new-password" />
                            @error('password_confirmation', 'updatePassword')
                                <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-600 border border-transparent rounded-full font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all">
                                {{ __('Atualizar Senha') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Excluir Conta -->
                <div class="p-8 sm:p-10 bg-stone-50/50">
                    <header class="mb-8">
                        <h2 class="text-xl font-semibold text-rose-600">
                            {{ __('Excluir Conta') }}
                        </h2>
                        <p class="mt-1 text-sm text-stone-500 max-w-2xl">
                            {{ __('Uma vez que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, baixe quaisquer dados ou informações que você deseja reter.') }}
                        </p>
                    </header>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="inline-flex items-center px-6 py-3 bg-white border-2 border-rose-100 rounded-full font-medium text-rose-600 hover:bg-rose-50 hover:border-rose-200 focus:outline-none focus:ring-4 focus:ring-rose-50 transition-all">
                        {{ __('Excluir Conta Permanentemente') }}
                    </button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
                            @csrf
                            @method('delete')

                            <h2 class="text-xl font-semibold text-stone-800">
                                {{ __('Tem certeza que deseja excluir sua conta?') }}
                            </h2>

                            <p class="mt-2 text-sm text-stone-500">
                                {{ __('Esta ação é irreversível. Por favor, insira sua senha para confirmar.') }}
                            </p>

                            <div class="mt-6">
                                <label for="password" class="sr-only">{{ __('Senha') }}</label>
                                <input id="password" name="password" type="password" class="block w-full bg-stone-50 border-0 focus:ring-2 focus:ring-rose-200 text-stone-800 rounded-2xl py-3 transition-colors" placeholder="{{ __('Senha') }}" />
                                @error('password', 'userDeletion')
                                    <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-8 flex justify-end gap-3">
                                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center px-6 py-3 bg-white border border-stone-200 rounded-full font-medium text-stone-600 hover:bg-stone-50 focus:outline-none transition-all">
                                    {{ __('Cancelar') }}
                                </button>
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-rose-600 border border-transparent rounded-full font-medium text-white hover:bg-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-100 transition-all">
                                    {{ __('Excluir Conta') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
