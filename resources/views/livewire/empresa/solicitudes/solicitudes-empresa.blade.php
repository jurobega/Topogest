<x-mios.base>
    <div class="min-h-screen bg-[#F5F5F0] p-4 md:p-8 font-sans text-[#2D1B0F]">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-[2px] w-8 bg-[#D4AF37]"></span>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-[0.4em]">Administración</p>
                </div>
                <h1 class="text-4xl font-black uppercase tracking-tighter italic flex items-center gap-4">
                    Gestión de Solicitudes
                    <span
                        class="text-sm bg-[#2D1B0F] text-[#D4AF37] px-4 py-1 rounded-full not-italic tracking-widest">{{ count($solicitudes) }}</span>
                </h1>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[35px] shadow-sm border border-gray-100 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative">
                    <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4 mb-2 block">Buscar
                        Cliente / Asunto</label>
                    <div class="relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="text" wire:model.live="buscar" placeholder="Ej: Juan Pérez o Deslinde..."
                            class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 pl-12 pr-4 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                    </div>
                </div>
                <div>
                    <label
                        class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4 mb-2 block">Estado</label>
                    <select wire:model.live="estado"
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-5 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                        <option value="">Todas las solicitudes</option>ç
                        @foreach ($estados as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach


                    </select>
                </div>
                <div>
                    <label
                        class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-4 mb-2 block">Servicio
                        solicitado</label>
                    <select wire:model.live="servicio_id"
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-5 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                        <option value="">Cualquier servicio</option>
                        @foreach ($servicios as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                @if (count($solicitudes))
                    <table class="w-full text-left border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-[#2D1B0F] text-white">
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest">Cliente</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest">Asunto</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest">Servicio</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest">Estado</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-widest">Fecha Envío</th>
                                <th class="px-8 py-5 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-[#2D1B0F]">
                            @foreach ($solicitudes as $item)
                                <tr class="hover:bg-[#F5F5F0]/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">

                                            <span
                                                class="text-[11px] font-black uppercase tracking-tighter">{{ $item->cliente->nombre_completo }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-[10px] font-bold">{{ $item->asunto }}</td>
                                    <td class="px-8 py-5 text-[9px] font-black text-[#8B7355] uppercase">
                                        {{ $item->servicio->nombre }}</td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="px-4 py-1.5 bg-amber-50 text-amber-600 border border-amber-200 rounded-full text-[8px] font-black uppercase tracking-widest">{{ $item->estado }}</span>
                                    </td>
                                    <td class="px-8 py-5 text-[10px] font-bold text-gray-400">
                                        {{ $item->created_at?->format('d/m/Y') ?? 'Desconocido' }}</td>
                                    <td class="px-8 py-5 text-right">
                                        <button wire:click="mostrarDetallesSolicitudes({{ $item->id }})"
                                            class="bg-[#2D1B0F] text-[#D4AF37] px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-[#8B7355] hover:text-white transition-all">Ver
                                            detalle</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-8 py-6 bg-[#FAFAF8] border-t border-gray-100">
                        {{ $solicitudes->links() }}
                    </div>
                @else
                    <x-mios.aviso>Actualmente no hay solicitudes que requieran atención o coincidan con tus filtros de
                        búsqueda.</x-mios.aviso>
                @endif
            </div>

        </div>

        @if ($solicitud)
            <x-dialog-modal wire:model="mostrarSolicitudes" maxWidth="5xl">
                <x-slot name="title">
                    <div
                        class="flex flex-col md:flex-row justify-between items-start gap-4 pb-6 border-b border-gray-100">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="h-[2px] w-8 bg-[#D4AF37]"></span>
                                <p class="text-[10px] font-black text-[#D4AF37] uppercase tracking-[0.4em]">Detalle de
                                    Solicitud</p>
                            </div>
                            <h2 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                                {{ $solicitud->asunto }}</h2>
                        </div>
                        <div
                            class="px-4 py-2 bg-amber-50 border-2 border-amber-200 text-amber-600 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            {{ $solicitud->estado }}
                        </div>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-10 py-4 max-h-[70vh] overflow-y-auto pr-2 custom-scrollbar">

                        <div class="lg:col-span-7 space-y-8">

                            <div
                                class="grid grid-cols-2 gap-6 bg-[#F5F5F0] p-6 rounded-[30px] border border-[#2D1B0F]/5">
                                <div class="col-span-2 md:col-span-1">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Cliente</p>
                                    <p class="text-sm font-black text-[#2D1B0F] uppercase tracking-tight italic">
                                        {{ $solicitud->cliente->nombre_completo }}</p>
                                </div>
                                <div class="md:col-span-1">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Provincia</p>
                                    <p class="text-sm font-bold text-[#2D1B0F]">{{ $solicitud->cliente->provincia }}
                                    </p>
                                </div>
                                <div class="md:col-span-1">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Teléfono</p>
                                    <p class="text-sm font-bold text-[#2D1B0F]">{{ $solicitud->cliente->telefono }}</p>
                                </div>
                                <div class="md:col-span-1">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Fecha de envío</p>
                                    <p class="text-sm font-bold text-[#2D1B0F]">
                                        {{ $solicitud->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <div class="space-y-3 italic leading-relaxed text-[#2D1B0F]/80 text-sm">
                                <h4
                                    class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2 not-italic">
                                    <i class="fa-solid fa-align-left text-[#D4AF37]"></i> Descripción del encargo
                                </h4>
                                <p class="bg-white border border-gray-100 p-6 rounded-[25px]">
                                    {{ $solicitud->descripcion }}</p>
                            </div>

                            <div class="space-y-4">
                                <h4
                                    class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2">
                                    <i class="fa-solid fa-paperclip text-[#D4AF37]"></i> Archivos adjuntos
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
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

                        <div
                            class="lg:col-span-5 flex flex-col h-full bg-white border border-gray-100 rounded-[35px] shadow-sm overflow-hidden">
                            <div class="bg-[#2D1B0F] p-4 flex items-center gap-3">

                                <p class="text-[9px] font-black text-white uppercase tracking-[0.2em]">Canal de
                                    Comunicación
                                </p>
                            </div>

                            <div
                                class="flex-1 p-6 space-y-6 bg-gray-50/50 overflow-y-auto min-h-[400px] max-h-[500px] custom-scrollbar">

                                @foreach ($solicitud->mensajes as $mensaje)
                                    @php
                                        // Comprobamos si el mensaje es nuestro o del otro (cliente/otro usuario)
                                        $esMio = $mensaje->remitente_id === auth()->id();
                                    @endphp

                                    <div
                                        class="flex flex-col {{ $esMio ? 'items-end ml-auto' : 'items-start' }} max-w-[85%]">

                                        <div
                                            class="p-4 rounded-2xl shadow-sm border {{ $esMio
                                                ? 'bg-[#2D1B0F] text-white rounded-tr-none border-transparent shadow-xl shadow-[#2D1B0F]/10'
                                                : 'bg-white text-gray-700 rounded-tl-none border-gray-100' }}">

                                            <p class="text-xs font-medium leading-relaxed">
                                                {{ $mensaje->mensaje }}
                                            </p>
                                        </div>

                                        <div class="flex items-center gap-2 mt-1 px-1">
                                            <span
                                                class="text-[8px] font-black uppercase tracking-[0.15em] {{ $esMio ? 'text-[#8B7355]' : 'text-gray-400' }}">
                                                {{ $esMio ? 'Tú' : 'Cliente' }}
                                            </span>
                                            <span class="text-[7px] font-bold text-gray-300 uppercase tracking-widest">
                                                • {{ $mensaje->created_at->format('H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="p-4 bg-white border-t border-gray-100 flex gap-2">
                                <input type="text" placeholder="Escribe tu mensaje..."
                                    wire:model.live="nuevoMensaje"
                                    class="flex-1 bg-[#F5F5F0] border-none rounded-xl text-xs py-3 px-4 focus:ring-1 focus:ring-[#D4AF37]">
                                <button wire:click="enviarMensaje"
                                    class="bg-[#D4AF37] text-[#2D1B0F] p-3 rounded-xl hover:bg-[#2D1B0F] hover:text-white transition-all">
                                    <i class="fa-solid fa-paper-plane text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex flex-col md:flex-row justify-between items-center w-full gap-4">
                        <div class="flex gap-3">
                            @if ($solicitud->estado == 'vista' || $solicitud->estado == 'en_negociacion')
                                <button wire:click="mostrarConfirmacion"
                                    class="bg-[red] text-[#2D1B0F] px-6 py-3 rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] border border-gray-200 hover:bg-gray-200 transition-all">
                                    Rechazar
                                </button>
                                @if ($solicitud->estado != 'en_negociacion')
                                    <button wire:click="marcarEnNegociacion"
                                        class="bg-[#F5F5F0] text-[#2D1B0F] px-6 py-3 rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] border border-gray-200 hover:bg-gray-200 transition-all">
                                        Marcar en Negociación
                                    </button>
                                @endif

                                <button wire:click="abrirConvertir({{ $solicitud->id }})"
                                    class="bg-[#D4AF37] text-[#2D1B0F] px-6 py-3 rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] shadow-lg shadow-[#D4AF37]/20 hover:scale-105 transition-all">
                                    Convertir en Proyecto <i class="fa-solid fa-rocket ml-1"></i>
                                </button>

                            @endif
                        </div>
                        <button wire:click="$set('mostrarSolicitudes', false)"
                            class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-red-500 transition-all">
                            Cerrar ventana
                        </button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endif

    </div>

    <style>
        /* Estilización del scroll para el modal */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #8B7355;
            border-radius: 10px;
        }
    </style>
    
    @livewire('empresa.solicitudes.convertir-solicitud')
</x-mios.base>
