<x-mios.base>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#2D1B0F]/60 backdrop-blur-sm">

        <div
            class="bg-white w-full max-w-2xl rounded-[35px] shadow-2xl overflow-hidden flex flex-col border border-gray-100">

            <div class="bg-[#2D1B0F] p-8 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0ibm9uZSIvPjxwYXRoIGQ9Ik0wIDQwbDQwLTQwTTAgMGg0MCA0MCIgc3Ryb2tlPSIjRDRBRjM3IiBzdHJva2Utd2lkdGg9IjAuNSIvPjwvc3ZnPg==');">
                </div>

                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <h3 class="text-white text-2xl font-black uppercase tracking-tighter italic leading-none">
                            Solicitud de Presupuesto</h3>
                        <p class="text-[#D4AF37] text-[10px] font-bold uppercase tracking-[0.4em] mt-2">TopoGest ·
                            Gestión Técnica</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-3 rounded-2xl shadow-2xl">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <form class="p-8 space-y-6 bg-white overflow-y-auto max-h-[80vh]">
                @csrf

                <div class="relative">
                    <label
                        class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest z-10">Localización
                        / Asunto</label>
                    <input type="text" wire:model="cform.asunto"
                        placeholder="Ej: Levantamiento topográfico finca Almería..."
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm font-medium text-[#2D1B0F] placeholder-gray-400">
                    <x-input-error for="cform.asunto" />
                </div>

                <div class="relative">
                    <label
                        class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest z-10">Especialidad
                        técnica</label>
                    <div class="relative">
                        <select wire:model="cform.servicio_id"
                            class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm text-gray-600 font-medium appearance-none cursor-pointer">
                            <option value="">Seleccione el servicio requerido...</option>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-[#8B7355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error for="cform.servicio_id" />
                </div>

                <div class="relative">
                    <label
                        class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest z-10">Detalles
                        del Proyecto</label>
                    <textarea wire:model="cform.descripcion" rows="3"
                        placeholder="Describa brevemente las necesidades del trabajo..."
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm font-medium text-gray-600 resize-none">
                    </textarea>
                    <x-input-error for="cform.descripcion" />

                </div>

                <div class="space-y-4">
                    <h4 class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-2">Documentación de
                        Referencia</h4>

                    <div
                        class="relative border-2 border-dashed border-[#F5F5F0] rounded-[25px] p-8 flex flex-col items-center justify-center bg-[#FDFDFB] hover:border-[#D4AF37]/30 transition-all cursor-pointer group">
                        <input type="file" wire:model="documentos_solicitud" multiple
                            class="absolute inset-0 opacity-0 cursor-pointer z-20">

                        <div
                            class="w-10 h-10 rounded-full bg-[#F5F5F0] flex items-center justify-center mb-2 group-hover:bg-[#D4AF37]/10 transition-colors">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">Arrastrar GML, PDF
                            o Fotos</span>
                        <p class="text-[9px] text-gray-400 mt-1 uppercase font-bold tracking-tighter">Click para
                            seleccionar múltiples archivos</p>
                    </div>

                    <div wire:loading wire:target="documentos_solicitud"
                        class="flex items-center justify-center gap-2 text-[9px] font-black text-[#D4AF37] uppercase animate-pulse">
                        <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Procesando planimetría...
                    </div>

                    @if($todos_los_documentos)
                        <div class="grid grid-cols-1 gap-2 mt-2">
                            @foreach($todos_los_documentos as $index => $file)
                                <div
                                    class="flex items-center justify-between bg-[#F5F5F0] p-3 rounded-xl border border-gray-100 group/file animate-fade-in">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-[#2D1B0F] flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
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

                                    <button type="button" wire:click="eliminarDocumento({{ $index }})">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 border-t border-gray-50">
                    <button type="button" wire:click="cancelar"
                        class="w-full sm:w-auto px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#2D1B0F] transition-colors">
                        Cancelar
                    </button>

                    <button wire:click="crearSolicitud" type="button"
                        class="w-full flex-1 bg-[#2D1B0F] text-[#D4AF37] py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-[#1A0F08] transition-all shadow-xl shadow-[#2D1B0F]/10 transform active:scale-95 flex items-center justify-center gap-3">
                        <span>Enviar Solicitud</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-mios.base>