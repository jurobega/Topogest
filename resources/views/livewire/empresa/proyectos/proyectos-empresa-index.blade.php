<x-mios.base>
    <div class="min-h-screen bg-[#F5F5F0] p-4 lg:p-8 font-sans text-[#2D1B0F]">
    <div class="max-w-[1600px] mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-[2px] w-12 bg-[#D4AF37]"></span>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-[0.5em]">Panel Operativo</p>
                </div>
                <h1 class="text-5xl font-black uppercase tracking-tighter italic leading-none">
                    Gestión de Proyectos
                </h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 text-center">Total Activos</p>
                    <p class="text-xl font-black text-[#2D1B0F] text-center leading-none">{{ count($proyectos) }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <aside class="lg:col-span-3 space-y-6 sticky top-8">
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-8">
                        <i class="fa-solid fa-sliders text-[#D4AF37]"></i>
                        <h2 class="text-[11px] font-black uppercase tracking-[0.3em]">Filtros Avanzados</h2>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-[#8B7355] ml-2 mb-3 block italic">Búsqueda Global</label>
                            <div class="relative">
                                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                                <input type="text" wire:model.live="buscar" placeholder="Proyecto o cliente..." 
                                    class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 pl-10 pr-4 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                            </div>
                        </div>

                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-[#8B7355] ml-2 mb-3 block italic">Filtrar por Estado</label>
                            <select wire:model.live="estado" class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                                <option value="">Todos los estados</option>
                                <option value="borrador">Borrador</option>
                                <option value="pendiente_aceptacion">Pendiente Aceptación</option>
                                <option value="activo">Activo</option>
                                <option value="entregado">Entregado</option>
                                <option value="cerrado">Cerrado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-[#8B7355] ml-2 mb-3 block italic">Prioridad de Visualización</label>
                            <select wire:model.live="orden" class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                                <option value="reciente">Más reciente</option>
                                <option value="antiguo">Más antiguo</option>
                                <option value="nombre">Nombre A-Z</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-50">
                        <button wire:click="$set('buscar', ''), $set('estado', '')" class="w-full text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-red-500 transition-colors">
                            Limpiar Selección
                        </button>
                    </div>
                </div>
            </aside>

            <main class="lg:col-span-9 space-y-4">
                @forelse($proyectos as $proyecto)
                    <div class="bg-white rounded-[30px] p-1 shadow-sm border border-gray-100 hover:border-[#D4AF37]/30 hover:shadow-xl hover:shadow-[#2D1B0F]/5 transition-all group">
                        <div class="flex flex-col md:flex-row items-center gap-6 p-5">
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-2">
                                    @php
                                        $color = match($proyecto->estado) {
                                            'pendiente_aceptacion' => 'bg-amber-100 text-amber-600 border-amber-200',
                                            'activo' => 'bg-emerald-100 text-emerald-600 border-emerald-200',
                                            'entregado' => 'bg-blue-100 text-blue-600 border-blue-200',
                                            'cerrado' => 'bg-gray-100 text-gray-500 border-gray-200',
                                            'rechazado' => 'bg-red-100 text-red-600 border-red-200',
                                            default => 'bg-gray-50 text-gray-400'
                                        };
                                    @endphp
                                    <span class="px-3 py-0.5 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $color }}">
                                        {{ str_replace('_', ' ', $proyecto->estado) }}
                                    </span>
                                    <span class="text-[9px] font-black text-[#8B7355] uppercase tracking-tighter italic">Exp. #{{ $proyecto->id + 1000 }}</span>
                                </div>
                                <h3 class="text-lg font-black text-[#2D1B0F] uppercase tracking-tighter truncate italic group-hover:text-[#D4AF37] transition-colors">
                                    {{ $proyecto->nombre }}
                                </h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                                    <i class="fa-solid fa-user-tie mr-1 text-[#8B7355]/50"></i> {{ $proyecto->cliente->nombre_completo }}
                                </p>
                            </div>

                            <div class="hidden xl:flex items-center gap-6 px-6 border-x border-gray-50">
                                <div class="text-center">
                                    <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest mb-1 italic">Inicio</p>
                                    <p class="text-[11px] font-bold text-[#2D1B0F]">{{ $proyecto->fecha_inicio?->format('d/m/Y') ?? '--/--/--' }}</p>
                                </div>
                                <i class="fa-solid fa-arrow-right-long text-gray-100"></i>
                                <div class="text-center">
                                    <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest mb-1 italic">Fin Previsto</p>
                                    <p class="text-[11px] font-bold text-[#2D1B0F]">{{ $proyecto->fecha_fin_prevista?->format('d/m/Y') ?? '--/--/--' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                @if(in_array($proyecto->estado, ['activo', 'entregado']))
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" class="bg-[#F5F5F0] hover:bg-[#2D1B0F] hover:text-white text-[#2D1B0F] px-4 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
                                            Avanzar <i class="fa-solid fa-chevron-down text-[8px]"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-10 overflow-hidden">
                                            @if($proyecto->estado === 'activo')
                                                <button wire:click="cambiarEstado({{ $proyecto->id }}, 'entregado')" class="w-full text-left px-5 py-3 text-[9px] font-black uppercase tracking-widest text-[#2D1B0F] hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                                    Marcar Entregado
                                                </button>
                                            @endif
                                            @if($proyecto->estado === 'entregado')
                                                <button wire:click="cambiarEstado({{ $proyecto->id }}, 'cerrado')" class="w-full text-left px-5 py-3 text-[9px] font-black uppercase tracking-widest text-[#2D1B0F] hover:bg-gray-100 hover:text-gray-600 transition-colors">
                                                    Cerrar Proyecto
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <button wire:click="mostrarDetalle({{ $proyecto->id }})" 
                                    class="flex-1 md:flex-none bg-[#2D1B0F] text-[#D4AF37] px-6 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-[#8B7355] hover:text-white transition-all shadow-lg shadow-[#2D1B0F]/10">
                                    Ver detalle
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-24 bg-white rounded-[40px] border border-dashed border-gray-200">
                        <div class="w-20 h-20 bg-[#F5F5F0] rounded-full flex items-center justify-center mb-6">
                            <i class="fa-solid fa-folder-open text-3xl text-gray-300"></i>
                        </div>
                        <h3 class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-[0.4em] mb-2">No se hallaron proyectos</h3>
                        <p class="text-[10px] font-medium text-[#8B7355] italic tracking-widest">Ajusta los filtros para obtener otros resultados.</p>
                    </div>
                @endforelse

                <div class="mt-10">
                   
                </div>
            </main>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 10px; }
</style>
</x-mios.base>