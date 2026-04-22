<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-stone-800 leading-tight">
            {{ __('Início') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Boas Vindas -->
            <div class="bg-white rounded-3xl p-8 border border-stone-200/50 shadow-sm flex items-center justify-between">
                <div>
                    <h3 class="text-3xl font-light text-stone-800 mb-2">Bom dia, <span class="font-medium text-teal-700">{{ Auth::user()->name }}</span>.</h3>
                    <p class="text-stone-500 text-lg">Um excelente dia para cuidar dos seus pacientes.</p>
                </div>
                <div class="hidden md:flex h-20 w-20 bg-teal-50 rounded-full items-center justify-center text-teal-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('patients.index') }}" class="group block bg-white rounded-3xl p-8 border border-stone-200/50 shadow-sm hover:border-teal-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="h-14 w-14 bg-stone-100 rounded-full flex items-center justify-center text-stone-500 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-medium text-stone-800 group-hover:text-teal-700 transition-colors">Consultar Pacientes</h4>
                            <p class="text-stone-500 mt-1">Acesse a lista completa ou busque por alguém.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('patients.create') }}" class="group block bg-white rounded-3xl p-8 border border-stone-200/50 shadow-sm hover:border-teal-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="h-14 w-14 bg-stone-100 rounded-full flex items-center justify-center text-stone-500 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-medium text-stone-800 group-hover:text-teal-700 transition-colors">Novo Cadastro</h4>
                            <p class="text-stone-500 mt-1">Adicione um novo paciente ao sistema.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
