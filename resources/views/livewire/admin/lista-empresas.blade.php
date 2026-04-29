<x-mios.base>
    <div class="min-h-screen bg-[#FDFDFB] py-8 px-4 sm:px-12">
        <header class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                    {{ __('Gestión de Empresas') }}
                </h1>
                <div class="flex items-center gap-3 mt-2">
                    <span class="h-[1px] w-12 bg-[#D4AF37]"></span>
                    <span class="text-[10px] font-bold text-[#8B7355] uppercase tracking-[0.6em]">
                        {{ $empresas->total() }} {{ __('Empresas Registradas') }}
                    </span>
                </div>
            </div>

            <div class="w-full md:w-96">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#D4AF37]">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                           wire:model.live="buscar"
                           placeholder="Buscar por nombre o provincia..."
                           class="w-full bg-white rounded-2xl border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 py-3 pl-11 pr-4 text-[11px] font-bold uppercase tracking-widest text-[#2D1B0F] transition-all placeholder:text-gray-300 shadow-sm">
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-[40px] shadow-xl border border-gray-100/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F5F5F0]/50 border-b border-[#F5F5F0]">
                                <th class="px-8 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Empresa') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Provincia') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Teléfono') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em] text-center">{{ __('Directorio') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Registro') }}</th>
                                <th class="px-8 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em] text-right">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F0]">
                            @forelse($empresas as $empresa)
                                <tr class="group hover:bg-[#FDFDFB] transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-[#2D1B0F] flex items-center justify-center text-[#D4AF37] text-[10px] font-black">
                                                {{ substr($empresa->nombre_fiscal, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-black text-[#2D1B0F] uppercase tracking-tight">{{ $empresa->nombre_fiscal }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-bold text-[#8B7355] uppercase tracking-widest italic">
                                            <i class="fa-solid fa-location-dot me-1 text-[#D4AF37]/50"></i> {{ $empresa->provincia }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-bold text-[#2D1B0F] tracking-widest">{{ $empresa->telefono ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($empresa->visible_directorio)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-[9px] font-black text-green-600 uppercase tracking-widest border border-green-100">
                                                {{ __('Visible') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-50 text-[9px] font-black text-gray-400 uppercase tracking-widest border border-gray-100">
                                                {{ __('Oculto') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-medium text-gray-500">{{ $empresa->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-end gap-3">
                                            <button wire:click="toggleVisibilidad({{ $empresa->id }})" 
                                                    class="flex items-center gap-2 px-4 py-2 rounded-xl border-2 {{ $empresa->visible_directorio ? 'border-[#2D1B0F] text-[#2D1B0F]' : 'border-[#D4AF37] text-[#D4AF37]' }} text-[9px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95">
                                                @if($empresa->visible_directorio)
                                                    <i class="fa-solid fa-eye-slash"></i> {{ __('Ocultar') }}
                                                @else
                                                    <i class="fa-solid fa-eye"></i> {{ __('Mostrar') }}
                                                @endif
                                            </button>

                                            <button wire:click="eliminar({{ $empresa->id }})" 
                                                    wire:confirm="¿Estás seguro de que deseas eliminar esta empresa?"
                                                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 flex items-center justify-center shadow-sm">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-folder-open text-4xl text-[#F5F5F0] mb-4"></i>
                                            <p class="text-[11px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('No se encontraron empresas coincidentes') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($empresas->hasPages())
                    <div class="px-8 py-6 bg-[#FDFDFB] border-t border-[#F5F5F0]">
                        {{ $empresas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-mios.base>