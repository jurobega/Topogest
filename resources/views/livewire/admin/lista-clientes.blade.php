<x-mios.base>
    <div class="min-h-screen bg-[#FDFDFB] py-8 px-4 sm:px-12">
        <header class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                    {{ __('Gestión de Clientes') }}
                </h1>
                <div class="flex items-center gap-3 mt-2">
                    <span class="h-[1px] w-12 bg-blue-400"></span>
                    <span class="text-[10px] font-bold text-[#8B7355] uppercase tracking-[0.6em]">
                        {{ $clientes->total() }} {{ __('Clientes Registrados') }}
                    </span>
                </div>
            </div>

            <div class="w-full md:w-96">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-blue-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                           wire:model.live="buscar"
                           placeholder="Buscar por nombre o provincia..."
                           class="w-full bg-white rounded-2xl border-2 border-blue-100 focus:border-blue-400 focus:ring-0 py-3 pl-11 pr-4 text-[11px] font-bold uppercase tracking-widest text-[#2D1B0F] transition-all placeholder:text-gray-300 shadow-sm">
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-[40px] shadow-xl border border-gray-100/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-50/30 border-b border-blue-50">
                                <th class="px-8 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Cliente') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Provincia') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Teléfono') }}</th>
                                <th class="px-6 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('Registro') }}</th>
                                <th class="px-8 py-5 text-[10px] font-black text-[#8B7355] uppercase tracking-[0.2em] text-right">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F0]">
                            @forelse($clientes as $cliente)
                                <tr class="group hover:bg-[#FDFDFB] transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center text-white text-[10px] font-black shadow-sm">
                                                {{ substr($cliente->nombre_completo, 0, 1) }}{{ substr(strrchr($cliente->nombre_completo, " "), 1, 1) }}
                                            </div>
                                            <span class="text-sm font-black text-[#2D1B0F] uppercase tracking-tight">{{ $cliente->nombre_completo }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-bold text-[#8B7355] uppercase tracking-widest italic">
                                            <i class="fa-solid fa-map-pin me-1 text-blue-400/50"></i> {{ $cliente->provincia }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-bold text-[#2D1B0F] tracking-widest italic">{{ $cliente->telefono ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-[11px] font-medium text-gray-400">{{ $cliente->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-end">
                                            <button wire:click="eliminar({{ $cliente->id }})" 
                                                    wire:confirm="¿Estás seguro de que deseas eliminar este cliente?"
                                                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 flex items-center justify-center shadow-sm">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <i class="fa-solid fa-user-slash text-2xl text-gray-200"></i>
                                            </div>
                                            <p class="text-[11px] font-black text-[#8B7355] uppercase tracking-[0.2em]">{{ __('No hay clientes que coincidan con la búsqueda') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($clientes->hasPages())
                    <div class="px-8 py-6 bg-[#FDFDFB] border-t border-gray-50">
                        {{ $clientes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-mios.base>