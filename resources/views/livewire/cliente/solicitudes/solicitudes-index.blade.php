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
        {{-- Ampliamos el ancho a 5xl para que quepa el chat al lado --}}
        <x-dialog-modal wire:model="openMostrar" maxWidth="5xl">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#2D1B0F] uppercase tracking-tighter italic leading-none">
                            Detalle de Solicitud</h2>
                        <p
                            class="text-[#8B7355] text-[9px] font-black uppercase tracking-[0.3em] mt-2 flex items-center gap-2 font-sans">
                            <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                            Expediente Técnico: {{ $solicitud->asunto }}
                        </p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 py-4 text-left">

                    <div class="lg:col-span-7 space-y-8 max-h-[65vh] overflow-y-auto pr-2 custom-scrollbar">

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
                                        class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-1">Asunto</label>
                                    <p class="text-sm font-medium text-gray-700 font-sans leading-relaxed">
                                        {{ $solicitud->asunto }}</p>
                                </div>
                            </div>
                            <div
                                class="bg-[#F5F5F0] p-4 rounded-[25px] flex flex-col justify-center items-center border border-gray-100 self-start shadow-sm">
                                <label
                                    class="text-[8px] font-black text-[#8B7355] uppercase tracking-widest mb-2">Estado</label>
                                <span
                                    class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-orange-50 text-orange-600 border border-orange-100">
                                    {{ $solicitud->estado }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border-l-2 border-[#D4AF37] pl-4">
                                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">Fecha
                                    Solicitud</label>
                                <p class="text-xs font-bold text-[#2D1B0F]">
                                    {{ $solicitud->created_at->format('d/m/Y') }}</p>
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
                                Adjunta</label>
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
                                                    {{ number_format($documento->size_bytes / 1024, 2) }} KB
                                                </span>
                                            </div>
                                        </div>
                                            <a href="{{ Storage::url($documento->path) }}" download="{{ $documento->nombre_archivo }}"
                                                class="w-7 h-7 flex items-center justify-center bg-gray-50 text-gray-400 rounded-lg hover:bg-[#2D1B0F] hover:text-white transition-all">
                                                <i class="fa-solid fa-download text-[10px]"></i>
                                            </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div
                        class="lg:col-span-5 flex flex-col bg-white border border-gray-100 rounded-[35px] shadow-sm overflow-hidden h-[65vh]">
                        <div class="bg-[#2D1B0F] p-4 flex items-center gap-3">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-lg flex items-center justify-center font-black text-[#2D1B0F] text-[10px]">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                            <p class="text-[9px] font-black text-white uppercase tracking-[0.2em]">Centro de Mensajes
                            </p>
                        </div>

                        <div class="flex-1 p-4 space-y-4 bg-gray-50/30 overflow-y-auto custom-scrollbar">
                            @forelse ($solicitud->mensajes as $mensaje)
                                @php $esMio = $mensaje->remitente_id === auth()->id(); @endphp

                                <div
                                    class="flex flex-col {{ $esMio ? 'items-end ml-auto' : 'items-start' }} max-w-[90%]">
                                    <div
                                        class="p-4 rounded-2xl shadow-sm border {{ $esMio
                                            ? 'bg-[#2D1B0F] text-white rounded-tr-none border-transparent'
                                            : 'bg-white text-gray-700 rounded-tl-none border-gray-100' }}">
                                        <p class="text-[11px] font-medium leading-relaxed">{{ $mensaje->mensaje }}</p>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1 px-1">
                                        <span
                                            class="text-[7px] font-black uppercase tracking-widest {{ $esMio ? 'text-[#8B7355]' : 'text-gray-400' }}">
                                            {{ $esMio ? 'Tú' : $mensaje->remitente->name }}
                                        </span>
                                        <span class="text-[7px] font-bold text-gray-300 uppercase italic">
                                            {{ $mensaje->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center p-6">
                                    <i class="fa-solid fa-comment-slash text-gray-200 text-3xl mb-2"></i>
                                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest italic">No
                                        hay mensajes aún</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-4 bg-white border-t border-gray-100">
                            <div class="flex gap-2">
                                <input type="text" wire:model.defer="nuevoMensaje"
                                    placeholder="Escribe un mensaje..."
                                    class="flex-1 bg-[#F5F5F0] border-none rounded-xl text-xs py-3 px-4 focus:ring-1 focus:ring-[#D4AF37] placeholder-gray-400 font-medium">
                                <button wire:click="enviarMensaje"
                                    class="bg-[#D4AF37] text-[#2D1B0F] p-3 rounded-xl hover:bg-[#2D1B0F] hover:text-white transition-all shadow-md active:scale-95">
                                    <i class="fa-solid fa-paper-plane text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-col sm:flex-row justify-end gap-3 w-full border-t border-gray-50 pt-4">
                    <button wire:click="$set('openMostrar', false)"
                        class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-[#2D1B0F] transition-colors">
                        Cerrar Ventana
                    </button>
                    {{-- <button
                        class="px-8 py-3 rounded-xl bg-[#2D1B0F] text-[#D4AF37] text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-[#2D1B0F]/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Editar Solicitud
                    </button> --}}
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E5E7EB;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }
    </style>
</x-mios.base>
