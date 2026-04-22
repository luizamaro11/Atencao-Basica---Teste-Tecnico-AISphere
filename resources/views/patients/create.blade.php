<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('patients.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-stone-100 text-stone-500 hover:bg-stone-200 hover:text-stone-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-stone-800 leading-tight">
                {{ __('Novo Paciente') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl overflow-hidden border border-stone-200/50 shadow-sm">
                
                <div class="p-8 sm:p-12">
                    <form method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data" class="space-y-10" x-data="{ isSubmitting: false }" @submit="isSubmitting = true">
                        @csrf

                        <!-- Profile Image Section -->
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="relative group cursor-pointer" x-data="{ photoName: null, photoPreview: null }">
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
                                @error('profile_image')
                                    <p class="text-sm text-rose-600 mt-2 text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-sm text-stone-500 font-medium">Adicionar foto do paciente</div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Name Input -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="name" class="block font-medium text-stone-600 mb-2">Nome Completo <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                    class="w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-4 px-4 transition-colors @error('name') ring-2 ring-rose-200 @enderror">
                                @error('name')
                                    <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="email" class="block font-medium text-stone-600 mb-2">E-mail</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-4 transition-colors @error('email') ring-2 ring-rose-200 @enderror">
                                </div>
                                @error('email')
                                    <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Input -->
                            <div>
                                <label for="phone" class="block font-medium text-stone-600 mb-2">Telefone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="(00) 00000-0000"
                                        class="pl-12 w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-4 transition-colors @error('phone') ring-2 ring-rose-200 @enderror">
                                </div>
                                @error('phone')
                                    <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Birth Date Input -->
                            <div>
                                <label for="birth_date" class="block font-medium text-stone-600 mb-2">Data de Nascimento</label>
                                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                    class="w-full bg-stone-50 border-0 focus:ring-2 focus:ring-teal-200 text-stone-800 rounded-2xl py-4 px-4 transition-colors @error('birth_date') ring-2 ring-rose-200 @enderror">
                                @error('birth_date')
                                    <p class="text-sm text-rose-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-8 flex items-center justify-end space-x-4">
                            <a href="{{ route('patients.index') }}" class="px-8 py-4 bg-stone-100 rounded-full font-medium text-stone-600 hover:bg-stone-200 focus:outline-none transition-colors">
                                Voltar
                            </a>
                            <button type="submit" :disabled="isSubmitting" class="relative px-8 py-4 bg-teal-600 rounded-full font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all disabled:opacity-75 disabled:cursor-not-allowed">
                                <span x-show="!isSubmitting">Registrar Paciente</span>
                                <span x-show="isSubmitting" class="flex items-center" style="display: none;">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Salvando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
