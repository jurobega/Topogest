<x-mios.base>
    <div class="p-6 md:p-12 bg-[#F5F5F0] min-h-screen font-sans selection:bg-[#2D1B0F] selection:text-white">
        <div class="max-w-6xl mx-auto">

            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-20 gap-6 px-4">
                <div>
                    <h1 class="text-4xl font-black text-[#2D1B0F] tracking-tighter uppercase italic leading-none">Mis
                        Proyectos</h1>
                    <div class="flex items-center gap-3 mt-3">
                        <span class="h-[1px] w-8 bg-[#D4AF37]"></span>
                        <p class="text-[#8B7355] text-[10px] font-bold uppercase tracking-[0.5em]">Panel de Cliente</p>
                    </div>
                </div>
                <div class="relative w-full md:w-80 group">
                    <input type="text" placeholder="BUSCAR PROYECTO..."
                        class="w-full bg-transparent border-b-2 border-[#2D1B0F]/10 py-2 pl-0 pr-8 focus:border-[#2D1B0F] focus:ring-0 transition-all text-xs font-black text-[#2D1B0F] placeholder-[#2D1B0F]/20 uppercase tracking-widest">
                    <i
                        class="fa-solid fa-search absolute right-0 top-3 text-[#2D1B0F]/20 group-focus-within:text-[#2D1B0F] transition-colors"></i>
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-20">

                @foreach ($proyectos as $item)
                    <div class="group relative flex animate-fade-in">
                        <div
                            class="w-1.5 h-full bg-[#D4AF37] rounded-full mr-6 group-hover:w-2 transition-all duration-500 shadow-[0_0_15px_rgba(212,175,55,0.3)]">
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <span
                                    class="text-[9px] font-black text-[#D4AF37] uppercase tracking-widest bg-[#D4AF37]/10 px-2 py-1 rounded">
                                    Expediente {{ $item->estado }}
                                </span>
                            </div>

                            <h2
                                class="text-2xl font-black text-[#2D1B0F] uppercase tracking-tighter leading-none mb-3 group-hover:text-[#D4AF37] transition-colors">
                                {{ $item->nombre }}
                            </h2>

                            <p class="text-[10px] font-bold text-[#8B7355] uppercase tracking-[0.2em] mb-8 italic">
                                {{ $item->empresa->nombre_fiscal }}</p>

                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <div>
                                    <p
                                        class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Estado</p>
                                    <p class="text-[10px] font-black text-[#2D1B0F] uppercase">{{ $item->estado }}</p>
                                </div>

                                <div>
                                    <p
                                        class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Inicio</p>
                                    <p class="text-[10px] font-black text-[#2D1B0F]">
                                        {{ $item->fecha_inicio->format('d/m/Y') }}</p>
                                </div>

                                <div>
                                    @if ($item->estado == 'cerrado')
                                        <p
                                            class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                            Cerrado</p>
                                        <p class="text-[10px] font-black text-[#D4AF37]">
                                            {{ $item->updated_at->format('d/m/Y') }}</p>
                                    @else
                                        <p
                                            class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                            Previsto</p>
                                        <p class="text-[10px] font-black text-[#D4AF37]">
                                            {{ $item->fecha_fin_prevista->format('d/m/Y') }}</p>
                                    @endif

                                </div>
                            </div>

                            <button wire:click="mostrarDetallesProyectos({{ $item->id }})"
                                class="inline-flex items-center gap-4 text-[9px] font-black uppercase tracking-[0.4em] text-[#2D1B0F] hover:text-[#D4AF37] transition-all">
                                Ver Detalles
                                <span
                                    class="h-[1px] w-8 bg-[#2D1B0F]/20 group-hover:w-16 group-hover:bg-[#D4AF37] transition-all duration-500"></span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <footer class="mt-32 pt-8 border-t border-[#2D1B0F]/5 flex justify-between items-center">
                <span class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.4em] italic">TopoGest v2.0 ·
                    Central de Proyectos</span>
                <div class="flex gap-12">
                    <button class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300">Anterior</button>
                    <button
                        class="text-[10px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] hover:text-[#D4AF37]">Siguiente</button>
                </div>
            </footer>
        </div>
    </div>

    @if ($proyecto)
        <x-dialog-modal wire:model="mostrarProyectos" maxWidth="5xl">
    <x-slot name="title">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4 pb-6 border-b border-[#2D1B0F]/10">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-[2px] w-8 bg-[#D4AF37]"></span>
                    <p class="text-[10px] font-black text-[#D4AF37] uppercase tracking-[0.4em]">Expediente de Proyecto</p>
                </div>
                <h2 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic leading-none">
                    {{ $proyecto->nombre }}
                </h2>
            </div>

            <div @class([
                'px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 shadow-sm',
                'bg-white border-gray-300 text-gray-400' => in_array($proyecto->estado, ['borrador', 'cerrado']),
                'bg-amber-50 border-[#D4AF37] text-[#D4AF37]' => $proyecto->estado === 'pendiente_aceptacion',
                'bg-green-50 border-green-500 text-green-600' => $proyecto->estado === 'activo',
                'bg-blue-50 border-blue-500 text-blue-600' => $proyecto->estado === 'entregado',
                'bg-red-50 border-red-500 text-red-600' => $proyecto->estado === 'rechazado',
            ])>
                {{ str_replace('_', ' ', $proyecto->estado) }}
            </div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="space-y-10 py-4">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <h3 class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-[#8B7355]"></i> Memoria Descriptiva
                    </h3>
                    <div class="bg-[#F5F5F0] p-6 rounded-[25px] text-sm text-[#2D1B0F]/80 leading-relaxed italic border border-[#2D1B0F]/5">
                        {{ $proyecto->descripcion ?: 'No hay una descripción detallada para este proyecto.' }}
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2">
                        <i class="fa-solid fa-calendar text-[#8B7355]"></i> Plazos
                    </h3>
                    <div class="bg-white border border-[#2D1B0F]/10 p-5 rounded-[25px] space-y-4 shadow-sm">
                        <div>
                            <p class="text-[8px] font-black text-gray-400 uppercase italic">Fecha de Inicio</p>
                            <p class="text-xs font-bold text-[#2D1B0F]">{{ $proyecto->fecha_inicio ? \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') : 'Pendiente' }}</p>
                        </div>
                        <div class="pt-3 border-t border-gray-50">
                            <p class="text-[8px] font-black text-gray-400 uppercase italic">Finalización Prevista</p>
                            <p class="text-xs font-black text-[#D4AF37]">{{ $proyecto->fecha_fin_prevista ? \Carbon\Carbon::parse($proyecto->fecha_fin_prevista)->format('d/m/Y') : 'Por definir' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h3 class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center justify-between">
                        <span><i class="fa-solid fa-box-archive text-[#D4AF37] mr-2"></i> Entregables Finales</span>
                    </h3>
                    <div class="space-y-3">
                        @forelse($proyecto->documentos->where('tipo', 'entregable') as $doc)
                            <div class="flex items-center justify-between p-4 bg-[#2D1B0F] rounded-2xl shadow-lg group hover:scale-[1.02] transition-transform">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-file-pdf text-[#D4AF37] text-lg"></i>
                                    <span class="text-[10px] font-bold text-white uppercase tracking-tight truncate w-32 md:w-48">{{ $doc->nombre_archivo }}</span>
                                </div>
                                <a href="{{ Storage::url($doc->path) }}" download class="bg-[#D4AF37] text-[#2D1B0F] p-2 rounded-lg hover:bg-white transition-colors">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        @empty
                            <p class="text-[10px] italic text-gray-400 p-4 border border-dashed border-gray-200 rounded-2xl text-center">No hay entregables disponibles aún.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2">
                        <i class="fa-solid fa-paperclip text-[#8B7355]"></i> Documentación Técnica
                    </h3>
                    <div class="space-y-2">
                        @forelse($proyecto->documentos->where('tipo', '!=', 'entregable') as $doc)
                            <div class="flex items-center gap-3 p-3 bg-white border border-gray-100 rounded-xl">
                                <i class="fa-solid fa-file text-gray-300 text-sm"></i>
                                <span class="text-[10px] font-bold text-[#2D1B0F] uppercase tracking-tight opacity-70">{{ $doc->nombre_archivo }}</span>
                            </div>
                        @empty
                            <p class="text-[10px] italic text-gray-400 p-4 text-center">No se han adjuntado otros documentos.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-[#F5F5F0] rounded-[35px] p-8 relative overflow-hidden group">
                <i class="fa-solid fa-building absolute -right-4 -bottom-4 text-8xl text-[#2D1B0F]/5 -rotate-12 transition-transform group-hover:rotate-0 group-hover:scale-110"></i>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <p class="text-[9px] font-black text-[#D4AF37] uppercase tracking-[0.3em] mb-2">Gabinete Responsable</p>
                        <h4 class="text-xl font-black text-[#2D1B0F] uppercase tracking-tighter">{{ $proyecto->empresa->nombre_fiscal }}</h4>
                    </div>
                    <div class="flex gap-8">
                        <div class="text-center md:text-left">
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Atención Telefónica</p>
                            <p class="text-xs font-bold text-[#2D1B0F]">{{ $proyecto->empresa->telefono }}</p>
                        </div>
                       
                    </div>
                </div>
            </div>

            @if($proyecto->estado === 'pendiente_aceptacion')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-gray-100">
                    <button wire:click="aceptarProyecto" class="bg-[#2D1B0F] text-[#D4AF37] py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] shadow-xl hover:bg-[#1a0f08] transition-all">
                        <i class="fa-solid fa-check mr-2"></i> Aceptar Proyecto y Presupuesto
                    </button>
                    <button wire:click="rechazarProyecto" class="bg-white border-2 border-red-500 text-red-500 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-red-50 transition-all">
                        <i class="fa-solid fa-xmark mr-2"></i> Rechazar Propuesta
                    </button>
                </div>
            @endif

        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-between items-center w-full">
            <p class="hidden md:block text-[9px] font-black text-gray-300 uppercase tracking-[0.4em] italic">TopoGest Engineering System</p>
            <x-secondary-button wire:click="$set('mostrarProyectos', false)" class="rounded-xl px-8 py-3 text-[10px] font-black uppercase tracking-widest">
                Cerrar Detalles
            </x-secondary-button>
        </div>
    </x-slot>
</x-dialog-modal>
    @endif
</x-mios.base>
