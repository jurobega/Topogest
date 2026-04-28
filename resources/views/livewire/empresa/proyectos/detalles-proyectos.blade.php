<x-mios.base>
    <div class="min-h-screen bg-[#F8F8F5] font-sans text-[#2D1B0F]" x-data="{ dragging: false }">

        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm px-6 py-4">
            <div class="max-w-[1800px] mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-6">
                    <a href="{{ route('empresa.proyectos.index') }}" wire:navigate
                        class="group flex items-center gap-2 text-gray-400 hover:text-[#2D1B0F] transition-colors">
                        <div
                            class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-[#D4AF37] group-hover:text-white transition-all">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest">Panel</span>
                    </a>
                    <div class="h-10 w-[1px] bg-gray-100 hidden md:block"></div>
                    <div>
                        <div class="flex items-center gap-3 mb-0.5">
                            <h1 class="text-2xl font-black uppercase tracking-tighter italic leading-none">
                                {{ $proyecto->nombre }}</h1>
                            @php
                                $statusClasses = match ($proyecto->estado) {
                                    'activo' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'entregado' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'cerrado' => 'bg-gray-100 text-gray-500 border-gray-200',
                                    'pendiente_aceptacion' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    default => 'bg-gray-100 text-gray-400',
                                };
                            @endphp
                            <span
                                class="px-3 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusClasses }}">
                                {{ str_replace('_', ' ', $proyecto->estado) }}
                            </span>
                        </div>
                        <p class="text-[10px] font-bold text-[#8B7355] uppercase tracking-widest">
                            <i class="fa-solid fa-user-tie mr-1 opacity-50"></i>
                            {{ $proyecto->cliente->nombre_completo ?? ($proyecto->cliente_externo_nombre ?? 'Cliente externo') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @if ($proyecto->estado === 'activo')
                        <button wire:click="solicitarCambioEstado('entregado')"
                            class="bg-[#2D1B0F] text-[#D4AF37] px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all shadow-lg shadow-[#2D1B0F]/10">
                            <i class="fa-solid fa-check-double mr-2"></i> Finalizar y Entregar
                        </button>
                    @elseif($proyecto->estado === 'entregado')
                        <button wire:click="solicitarCambioEstado('cerrado')"
                            class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/10">
                            <i class="fa-solid fa-box-archive mr-2"></i> Cerrar Expediente
                        </button>
                    @endif
                </div>
            </div>
        </header>

        <div class="max-w-[1800px] mx-auto px-6 py-8">
            <div class="grid grid-cols-1 {{ $proyecto->tipo === 'interno' ? 'lg:grid-cols-12' : '' }} gap-8">

                <div class="{{ $proyecto->tipo === 'interno' ? 'lg:col-span-8' : 'w-full' }} space-y-8">

                    <section class="bg-white rounded-[35px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-info text-[#D4AF37]"></i>
                                <h2 class="text-[11px] font-black uppercase tracking-[0.3em]">Especificaciones del
                                    Encargo</h2>
                            </div>
                            @if (!$editando)
                                <button wire:click="$set('editando', true)"
                                    class="flex items-center gap-2 text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-[#2D1B0F] transition-colors">
                                    <i class="fa-solid fa-pen text-[#D4AF37]"></i> Editar
                                </button>
                            @else
                                <div class="flex items-center gap-4">
                                    <button wire:click="$set('editando', false)"
                                        class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-red-500 transition-colors">
                                        Cancelar
                                    </button>
                                    <button wire:click="guardarCambios"
                                        class="bg-[#D4AF37] text-[#2D1B0F] px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-[#2D1B0F] hover:text-[#D4AF37] transition-all">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                            <div class="md:col-span-2">
                                <label
                                    class="text-[9px] font-black uppercase text-gray-400 tracking-widest block mb-2 italic">
                                    Memoria Descriptiva
                                </label>
                                @if ($editando)
                                    <textarea wire:model="descripcionEditar" rows="6"
                                        class="w-full bg-[#F5F5F0] border-2 border-[#D4AF37]/30 focus:border-[#D4AF37] focus:ring-0 rounded-2xl p-5 text-sm text-[#2D1B0F] leading-relaxed resize-none transition-all">
                                    </textarea>
                                    <x-input-error for="descripcionEditar" />
                                @else
                                    <p
                                        class="text-sm  whitespace-pre-wrap text-[#2D1B0F]/80 leading-relaxed bg-[#F5F5F0] p-5 rounded-2xl border border-gray-100 italic min-h-[120px]">
                                        {{ $proyecto->descripcion ?? 'Sin descripción técnica detallada.' }}
                                    </p>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div class="bg-white border border-gray-100 p-4 rounded-2xl">
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-3">
                                        Cronograma</p>

                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-[9px] font-bold text-gray-400 uppercase mb-1">Inicio</p>
                                            <p class="text-xs font-black text-[#2D1B0F]">
                                                {{ $proyecto->fecha_inicio?->format('d/m/Y') ?? '--' }}
                                            </p>
                                        </div>

                                        <div class="pt-3 border-t border-gray-50">
                                            @if ($proyecto->estado == 'cerrado' || $proyecto->estado == 'entregado')
                                                <p class="text-[9px] font-bold text-[#D4AF37] uppercase mb-1">Entrega
                                                    Realizada</p>
                                            @else
                                                <p class="text-[9px] font-bold text-[#D4AF37] uppercase mb-1">Entrega
                                                    Prevista</p>
                                            @endif

                                            @if ($editando)
                                                <input type="date" wire:model="fechaFinEditar"
                                                    class="w-full bg-[#F5F5F0] border-2 border-[#D4AF37]/30 focus:border-[#D4AF37] focus:ring-0 rounded-xl py-2 px-3 text-xs font-bold transition-all">
                                                <x-input-error for="fechaFinEditar" />
                                            @else
                                                <p class="text-xs font-black text-[#D4AF37]">
                                                    {{ $proyecto->fecha_fin_prevista?->format('d/m/Y') ?? 'Por definir' }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- CAMBIO 2: Sección Datos del Cliente (Solo Externo) --}}
                    @if ($proyecto->tipo === 'externo')
                        <section class="bg-white rounded-[35px] p-8 shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <i class="fa-solid fa-address-card text-[#D4AF37]"></i>
                                <h2 class="text-[11px] font-black uppercase tracking-[0.3em]">Datos del Cliente</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-[#F5F5F0] p-4 rounded-2xl border border-gray-50">
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Nombre / Razón Social</p>
                                    <p class="text-xs font-black text-[#2D1B0F] uppercase tracking-tighter">{{ $proyecto->cliente_externo_nombre }}</p>
                                </div>
                                
                                @if($proyecto->cliente_externo_telefono)
                                <div class="bg-[#F5F5F0] p-4 rounded-2xl border border-gray-50">
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Teléfono de contacto</p>
                                    <p class="text-xs font-black text-[#2D1B0F]">{{ $proyecto->cliente_externo_telefono }}</p>
                                </div>
                                @endif

                                @if($proyecto->cliente_externo_email)
                                <div class="bg-[#F5F5F0] p-4 rounded-2xl border border-gray-50">
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Email corporativo</p>
                                    <p class="text-xs font-black text-[#2D1B0F]">{{ $proyecto->cliente_externo_email }}</p>
                                </div>
                                @endif
                            </div>
                        </section>
                    @endif

                    <section class="bg-white rounded-[35px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-folder-tree text-[#D4AF37]"></i>
                                <h2 class="text-[11px] font-black uppercase tracking-[0.3em]">Gestión de Archivos y
                                    Planos</h2>
                            </div>
                            <div wire:loading wire:target="archivos, subirDocumentos">
                                <span
                                    class="text-[9px] font-black text-[#D4AF37] animate-pulse uppercase tracking-widest">Procesando...</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">
                            <div class="md:col-span-1 space-y-3">
                                <label
                                    class="text-[9px] font-black uppercase text-gray-400 tracking-widest block italic">Categoría</label>
                                <select wire:model="tipoSubida"
                                    class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37]">
                                    <option value="documento">Documento Interno</option>
                                    <option value="entregable">Entregable Cliente</option>
                                    <option value="otro">Otros Archivos</option>
                                </select>
                                <button wire:click="subirDocumentos" wire:loading.attr="disabled"
                                    class="w-full bg-[#D4AF37] text-[#2D1B0F] py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#2D1B0F] hover:text-white transition-all">
                                    Subir Archivos
                                </button>
                            </div>
                            <div class="md:col-span-3">
                                <div @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                                    @drop.prevent="dragging = false"
                                    :class="dragging ? 'border-[#D4AF37] bg-[#D4AF37]/5 scale-[1.01]' :
                                        'border-gray-200 bg-gray-50'"
                                    class="relative border-2 border-dashed rounded-[25px] h-32 flex flex-col items-center justify-center transition-all group">
                                    <input type="file" wire:model="archivos" multiple
                                        class="absolute inset-0 opacity-0 cursor-pointer">
                                    <i
                                        class="fa-solid fa-cloud-arrow-up text-2xl text-gray-300 group-hover:text-[#D4AF37] transition-colors mb-2"></i>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Arrastra o
                                        haz clic para adjuntar</p>
                                </div>
                            </div>

                            @if ($todosLosArchivos)
                                <div class="grid grid-cols-1 gap-2 mt-4">
                                    @foreach ($todosLosArchivos as $index => $file)
                                        <div
                                            class="flex items-center justify-between bg-[#F5F5F0] p-3 rounded-xl border border-gray-100">
                                            <div class="flex items-center gap-3 overflow-hidden">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-[#2D1B0F] flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid fa-file text-[#D4AF37] text-xs"></i>
                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <span
                                                        class="text-[10px] font-bold text-[#2D1B0F] truncate uppercase tracking-tighter">
                                                        {{ $file->getClientOriginalName() }}
                                                    </span>
                                                    <span class="text-[8px] font-black text-[#8B7355] uppercase">
                                                        {{ number_format($file->getSize() / 1024, 1) }} KB
                                                    </span>
                                                </div>
                                            </div>
                                            <button wire:click="quitarArchivo({{ $index }})"
                                                class="text-gray-300 hover:text-red-500 transition-colors">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Loading al procesar --}}
                            <div wire:loading wire:target="archivos, subirDocumentos"
                                class="flex items-center gap-2 text-[9px] font-black text-[#D4AF37] uppercase animate-pulse mt-2">
                                <i class="fa-solid fa-spinner animate-spin"></i> Procesando archivos...
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <h3
                                    class="text-[9px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2 pb-2 border-b border-gray-50">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Entregables del Cliente
                                </h3>
                                <div class="space-y-2">
                                    @forelse($proyecto->documentos->where('tipo', 'entregable') as $doc)
                                        <div
                                            class="flex items-center justify-between p-3 bg-[#2D1B0F] rounded-2xl group">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <i class="fa-solid fa-file-pdf text-[#D4AF37]"></i>
                                                <div class="truncate">
                                                    <p class="text-[10px] font-bold text-white truncate">
                                                        {{ $doc->nombre_archivo }}</p>
                                                    <p
                                                        class="text-[8px] text-gray-400 font-medium uppercase tracking-tighter">
                                                        {{ number_format($doc->size_bytes / 1024, 2) }} KB •
                                                        {{ $doc->created_at->format('d/m/y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex gap-1 ml-4">
                                                <a href="{{ Storage::url($doc->path) }}"
                                                    download="{{ $doc->nombre_archivo }}"
                                                    class="w-7 h-7 flex items-center justify-center bg-white/10 text-white rounded-lg hover:bg-[#D4AF37] hover:text-[#2D1B0F] transition-all">
                                                    <i class="fa-solid fa-download text-[10px]"></i>
                                                </a>
                                                <button
                                                    x-on:click="confirm('¿Eliminar este entregable?') ? @this.eliminarDocumento({{ $doc->id }}) : null"
                                                    class="w-7 h-7 flex items-center justify-center bg-white/10 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-all">
                                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-[9px] italic text-gray-400 text-center py-4 uppercase">No hay
                                            entregables finales</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3
                                    class="text-[9px] font-black text-[#2D1B0F] uppercase tracking-widest flex items-center gap-2 pb-2 border-b border-gray-50">
                                    <span class="w-2 h-2 rounded-full bg-gray-300"></span> Documentación Interna
                                </h3>
                                <div class="space-y-2">
                                    @forelse($proyecto->documentos->where('tipo', '!=', 'entregable') as $doc)
                                        <div
                                            class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-2xl hover:border-gray-300 transition-colors">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <i class="fa-solid fa-file text-gray-300"></i>
                                                <div class="truncate">
                                                    <p class="text-[10px] font-bold text-[#2D1B0F] truncate">
                                                        {{ $doc->nombre_archivo }}</p>
                                                    <p
                                                        class="text-[8px] text-gray-400 font-medium uppercase tracking-tighter">
                                                        {{ $doc->created_at->format('d/m/y') }} •
                                                        {{ $doc->user->name ?? 'Sistema' }}</p>
                                                </div>
                                            </div>
                                            <div class="flex gap-1 ml-4">
                                                <a href="{{ Storage::url($doc->path) }}"
                                                    download="{{ $doc->nombre_archivo }}"
                                                    class="w-7 h-7 flex items-center justify-center bg-gray-50 text-gray-400 rounded-lg hover:bg-[#2D1B0F] hover:text-white transition-all">
                                                    <i class="fa-solid fa-download text-[10px]"></i>
                                                </a>
                                                <button
                                                    x-on:click="confirm('¿Eliminar documento interno?') ? @this.eliminarDocumento({{ $doc->id }}) : null"
                                                    class="w-7 h-7 flex items-center justify-center bg-gray-50 text-gray-400 rounded-lg hover:bg-red-500 hover:text-white transition-all">
                                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-[9px] italic text-gray-400 text-center py-4 uppercase">Sin
                                            documentos técnicos</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                @if ($proyecto->tipo == 'interno')
                    <aside class="lg:col-span-4">
                    <div
                        class="sticky top-28 h-[calc(100vh-140px)] flex flex-col bg-white rounded-[35px] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-[#FAFAF8]">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <h2 class="text-[11px] font-black uppercase tracking-[0.2em]">Canal de Comunicación
                                </h2>
                            </div>
                            <i class="fa-solid fa-comments text-gray-200"></i>
                        </div>

                        <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar" id="chat-container"
                            wire:poll.2s="refrescarMensajes">
                            @foreach ($proyecto->mensajes as $mensaje)
                                <div @class([
                                    'flex flex-col',
                                    'items-end' => $mensaje->remitente_id === auth()->id(),
                                    'items-start' => $mensaje->remitente_id !== auth()->id(),
                                ])>
                                    <div @class([
                                        'max-w-[85%] p-4 rounded-2xl shadow-sm border transition-all',
                                        'bg-[#2D1B0F] border-[#2D1B0F] text-white rounded-tr-none' =>
                                            $mensaje->remitente_id === auth()->id(),
                                        'bg-[#F5F5F0] border-gray-100 text-[#2D1B0F] rounded-tl-none' =>
                                            $mensaje->remitente_id !== auth()->id(),
                                    ])>
                                        <p class="text-[11px] leading-relaxed">{{ $mensaje->mensaje }}</p>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1 px-1">
                                        <span
                                            class="text-[8px] font-black uppercase text-gray-300 tracking-tighter italic">
                                            {{ $mensaje->remitente->name }} •
                                            {{ $mensaje->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-6 bg-white border-t border-gray-50">
                            <div class="relative group">
                                <textarea wire:model="nuevoMensaje" rows="2"
                                    class="w-full bg-[#F5F5F0] border-none rounded-[20px] py-4 pl-5 pr-14 text-xs font-bold focus:ring-2 focus:ring-[#D4AF37] placeholder-gray-300 resize-none transition-all"
                                    placeholder="Escribir mensaje..."></textarea>
                                <button wire:click="enviarMensaje"
                                    class="absolute right-3 bottom-3 w-10 h-10 bg-[#2D1B0F] text-[#D4AF37] rounded-xl flex items-center justify-center hover:bg-[#D4AF37] hover:text-[#2D1B0F] transition-all shadow-lg">
                                    <i class="fa-solid fa-paper-plane text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>
                @endif
                
            </div>
        </div>
    </div>

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