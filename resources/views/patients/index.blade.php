<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-stone-800 leading-tight">
                {{ __('Pacientes') }}
            </h2>
            <a href="{{ route('patients.create') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 rounded-full font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-100 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Cadastrar Paciente
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Toast de Sucesso -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.500ms class="p-4 rounded-2xl bg-teal-50 border border-teal-100 flex justify-between items-center shadow-sm">
                    <div class="flex items-center text-teal-800">
                        <div class="bg-teal-100 rounded-full p-1 mr-3">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-teal-600 hover:text-teal-800 transition-colors p-1 rounded-full hover:bg-teal-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <!-- Filtros Simples -->
            <div class="bg-white rounded-2xl border border-stone-200/60 p-2 shadow-sm">
                <form action="{{ route('patients.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou e-mail..." class="pl-12 block w-full border-0 focus:ring-0 text-stone-700 placeholder-stone-400 bg-transparent py-3 text-lg">
                    </div>
                    <div class="flex items-center gap-2 pr-2">
                        @if(request('search'))
                            <a href="{{ route('patients.index') }}" class="px-4 py-2 text-stone-500 hover:text-stone-800 font-medium text-sm transition-colors rounded-full hover:bg-stone-100">
                                Limpar
                            </a>
                        @endif
                        <button type="submit" class="px-8 py-3 bg-stone-800 rounded-full font-medium text-white hover:bg-stone-900 focus:outline-none focus:ring-4 focus:ring-stone-200 transition-all duration-300">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabela de Pacientes -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-stone-200/50">
                @if($patients->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-stone-50 border-b border-stone-200/50 text-stone-500 text-sm font-semibold uppercase tracking-wide">
                                    <th scope="col" class="px-6 py-4">Paciente</th>
                                    <th scope="col" class="px-6 py-4">Contato</th>
                                    <th scope="col" class="px-6 py-4">Data de Nascimento</th>
                                    <th scope="col" class="px-6 py-4 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @foreach($patients as $patient)
                                    <tr class="hover:bg-stone-50/50 transition-colors duration-200 group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-4">
                                                <div class="flex-shrink-0">
                                                    @if($patient->profile_image)
                                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-stone-100 group-hover:border-teal-100 transition-colors" src="{{ asset('storage/' . $patient->profile_image) }}" alt="">
                                                    @else
                                                        <div class="h-12 w-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-500 font-medium border-2 border-stone-100 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                                                            {{ substr($patient->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-base font-semibold text-stone-800">{{ $patient->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-600 flex items-center mb-1">
                                                <svg class="w-4 h-4 mr-1.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ $patient->email ?? 'Sem e-mail' }}
                                            </div>
                                            <div class="text-sm text-stone-500 flex items-center">
                                                <svg class="w-4 h-4 mr-1.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                {{ $patient->phone ?? 'Sem telefone' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($patient->birth_date)
                                                <div class="text-sm text-stone-800">{{ $patient->birth_date->format('d/m/Y') }}</div>
                                            @else
                                                <div class="text-sm text-stone-500">Não informado</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('patients.edit', $patient) }}" class="p-2 text-stone-400 hover:text-teal-600 hover:bg-teal-50 rounded-full transition-colors" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </a>
                                                <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente remover este paciente do sistema?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-stone-400 hover:text-orange-700 hover:bg-orange-50 rounded-full transition-colors" title="Excluir">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($patients->hasPages())
                        <div class="px-6 py-4 border-t border-stone-200/50 bg-stone-50/30">
                            {{ $patients->links() }}
                        </div>
                    @endif
                @else
                    <!-- Estado Vazio -->
                    <div class="p-12 text-center">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-stone-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-light text-stone-800 mb-2">Tudo tranquilo por aqui.</h3>
                        <p class="text-stone-500 max-w-sm mx-auto mb-8 text-lg">
                            Nenhum paciente encontrado. Que tal registrar o primeiro atendimento agora mesmo?
                        </p>
                        <a href="{{ route('patients.create') }}" class="inline-flex items-center px-8 py-4 bg-teal-600 text-white rounded-full font-medium hover:bg-teal-700 transition-colors shadow-sm">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Adicionar Novo Paciente
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
