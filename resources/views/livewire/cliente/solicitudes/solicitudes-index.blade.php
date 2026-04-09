<x-mios.base>
    <div class="p-4 md:p-8 bg-[#F5F5F0] min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 px-2">
                <div>
                    <h1 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic leading-none">Mis
                        Solicitudes</h1>
                    <p class="text-[#8B7355] text-[10px] font-black uppercase tracking-[0.4em] mt-2">Historial de
                        mediciones y presupuestos técnicos</p>
                </div>
            </div>

            <div
                class="bg-white rounded-[30px] p-4 mb-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-4">
                <div class="relative w-full md:flex-1">
                    <label
                        class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest z-10">Buscar
                        Proyecto</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-5 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="Referencia, empresa o asunto..." wire:model.live="buscar"
                            class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 pl-12 pr-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm font-medium text-[#2D1B0F] placeholder-gray-400">
                    </div>
                </div>

                <div class="relative w-full md:w-72">
                    <label
                        class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest z-10">Filtrar
                        por Estado</label>
                    <select wire:model.live="estado"
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm text-gray-600 font-medium appearance-none cursor-pointer">
                        <option value="">Todos los estados</option>
                        @foreach ($estados as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach


                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-[#8B7355]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[35px] border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#FDFDFB] border-b border-gray-50">
                                <th class="px-8 py-6 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">
                                    Empresa Destino</th>
                                <th class="px-6 py-6 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">
                                    Asunto Técnica</th>
                                <th
                                    class="px-6 py-6 text-[9px] font-black text-[#8B7355] uppercase tracking-widest text-center">
                                    Estado Gestión</th>
                                <th
                                    class="px-6 py-6 text-[9px] font-black text-[#8B7355] uppercase tracking-widest text-right">
                                    Fecha Registro</th>
                                <th class="px-8 py-6"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($solicitudes as $item)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">

                                            <span
                                                class="font-black text-[#2D1B0F] text-[11px] uppercase tracking-tighter italic">{{ $item->empresa->nombre_fiscal }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-xs font-medium text-gray-500 italic">{{ $item->asunto }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span @class([
                                            'px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border transition-colors duration-300',
                                        
                                            'bg-amber-50 text-amber-600 border-amber-100' =>
                                                $item->estado === 'pendiente',
                                        
                                            'bg-blue-50 text-blue-600 border-blue-100' => $item->estado === 'vista',
                                        
                                            'bg-orange-50 text-orange-600 border-orange-100' =>
                                                $item->estado === 'en_negociacion',
                                        
                                            'bg-green-50 text-green-600 border-green-100' =>
                                                $item->estado === 'convertida',
                                        
                                            'bg-red-50 text-red-600 border-red-100' => $item->estado === 'rechazada',
                                        ])>
                                            {{ str_replace('_', ' ', $item->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right text-[10px] font-bold text-gray-400 uppercase">
                                        {{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="px-8 py-5 text-right">
                                        <button wire:click="mostrarSolicitud({{ $item->id }})"
                                            class="bg-[#F5F5F0] text-[#2D1B0F] px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-[#D4AF37] hover:text-white transition-all shadow-sm">
                                            Detalle
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-[#FDFDFB]  border-gray-50 px-8 py-6  ">
                    {{ $solicitudes->links() }}
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Suavizado de bordes para tablas con scroll en móvil */
        .overflow-x-auto {
            scrollbar-width: thin;
            scrollbar-color: #D4AF37 #F5F5F0;
        }
    </style>

    @if ($solicitud)
        <x-dialog-modal wire:model="openMostrar" maxWidth="3xl">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#2D1B0F] uppercase tracking-tighter italic leading-none">
                            Detalle de Solicitud</h2>
                        <p
                            class="text-[#8B7355] text-[9px] font-black uppercase tracking-[0.3em] mt-2 flex items-center gap-2 font-sans">
                            <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                            Expediente Técnico
                        </p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-8 py-4 text-left">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2 space-y-4">
                            <div>
                                <label
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-1">Empresa
                                    Destino</label>
                                <p class="text-sm font-bold text-[#2D1B0F] uppercase italic">
                                    {{ $solicitud->empresa->nombre_fiscal }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-1">Asunto
                                    de la Solicitud</label>
                                <p class="text-sm font-medium text-gray-700 font-sans leading-relaxed">
                                    {{ $solicitud->asunto }}</p>
                            </div>
                        </div>
                        <div
                            class="bg-[#F5F5F0] p-4 rounded-[25px] flex flex-col justify-center items-center border border-gray-100 self-start">
                            <label class="text-[8px] font-black text-[#8B7355] uppercase tracking-widest mb-2">Estado
                                Actual</label>
                            <span
                                class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-orange-50 text-orange-600 border border-orange-100">
                                {{ $solicitud->estado }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border-l-2 border-[#D4AF37] pl-4">
                            <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">Fecha
                                Solicitud</label>
                            <p class="text-xs font-bold text-[#2D1B0F]"> {{ $item->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="border-l-2 border-[#D4AF37] pl-4">
                            <label
                                class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">Servicio</label>
                            <p class="text-xs font-bold text-[#2D1B0F]">{{ $solicitud->servicio->nombre }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[30px] border border-gray-100 shadow-sm">
                        <label
                            class="text-[9px] font-black text-[#2D1B0F] uppercase tracking-[0.2em] block mb-3 italic">Descripción
                            del Trabajo</label>
                        <p class="text-xs text-gray-600 leading-relaxed font-sans">
                            {{ $solicitud->descripcion }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="text-[9px] font-black text-[#8B7355] uppercase tracking-widest block mb-4 ml-2 italic">Documentación
                            Adjunta (2)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($solicitud->documentos as $documento)
                                <div
                                    class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-2xl hover:border-[#D4AF37]/50 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-[#2D1B0F] flex items-center justify-center text-[#D4AF37] flex-shrink-0">
                                            <i class="fa-solid fa-file-pdf text-xs"></i>
                                        </div>
                                        <div class="flex flex-col truncate">
                                            <span
                                                class="text-[10px] font-bold text-[#2D1B0F] uppercase tracking-tighter truncate">{{ $documento->nombre_archivo }}</span>
                                            <span
                                                class="text-[8px] font-black text-[#8B7355] uppercase tracking-widest">
                                                @if ($documento->size_bytes < 1024)
                                                    {{ $documento->size_bytes }} B
                                                @elseif($documento->size_bytes < 1048576)
                                                    {{ number_format($documento->size_bytes / 1024, 2) }} KB
                                                @else
                                                    {{ number_format($documento->size_bytes / 1048576, 2) }} MB
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <i
                                        class="fa-solid fa-download text-gray-300 group-hover:text-[#D4AF37] text-xs"></i>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-col sm:flex-row justify-end gap-3 w-full">
                    <button wire:click="$set('openMostrar', false)"
                        class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-[#2D1B0F] transition-colors">
                        Cerrar Ventana
                    </button>
                    <button
                        class="px-8 py-3 rounded-xl bg-[#2D1B0F] text-[#D4AF37] text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-[#2D1B0F]/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Editar Solicitud
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
</x-mios.base>
