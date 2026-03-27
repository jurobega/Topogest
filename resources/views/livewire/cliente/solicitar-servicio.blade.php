
    <x-mios.base>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm">

            <div
                class="bg-white w-full max-w-2xl rounded-[35px] shadow-2xl overflow-hidden flex flex-col border border-slate-200">

                <div class="bg-slate-900 p-8 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none"
                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0ibm9uZSIvPjxwYXRoIGQ9Ik0wIDEwaDQwdjFINHoiIGZpbGw9IiMwN0NCQkIiLz48L3N2Zz4=');">
                    </div>

                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <h3 class="text-white text-2xl font-black uppercase tracking-tighter italic">Solicitud de
                                Presupuesto</h3>
                            <p class="text-[#07CBBB] text-[10px] font-bold uppercase tracking-[0.3em] mt-1">Expediente
                                Técnico de Consultoría</p>
                        </div>
                        <div class="bg-[#07CBBB]/10 p-3 rounded-2xl">
                            <svg class="w-6 h-6 text-[#07CBBB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="enviarSolicitud" class="p-8 space-y-6">

                    <div class="relative">
                        <label
                            class="absolute -top-2 left-5 bg-white px-2 text-[10px] font-black text-slate-500 uppercase tracking-widest z-10">Asunto
                            de la Medición</label>
                        <input type="text" wire:model="asunto" placeholder="Ej: Levantamiento topográfico finca rústica"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-6 focus:ring-0 focus:border-[#07CBBB] transition-all text-sm font-bold text-slate-700 placeholder-slate-300">
                        @error('asunto') <span
                            class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-tighter">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative">
                        <label
                            class="absolute -top-2 left-5 bg-white px-2 text-[10px] font-black text-slate-500 uppercase tracking-widest z-10">Tipo
                            de Servicio Requerido</label>
                        <select wire:model="servicio_id"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-6 focus:ring-0 focus:border-[#07CBBB] transition-all text-sm font-bold text-slate-700 appearance-none cursor-pointer">
                            <option value="">Seleccione una especialidad...</option>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        @error('servicio_id') <span
                            class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-tighter">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative">
                        <label
                            class="absolute -top-2 left-5 bg-white px-2 text-[10px] font-black text-slate-500 uppercase tracking-widest z-10">Descripción
                            del Proyecto (Opcional)</label>
                        <textarea wire:model="descripcion" rows="4"
                            placeholder="Detalle aquí las particularidades del terreno, ubicación o plazos..."
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-6 focus:ring-0 focus:border-[#07CBBB] transition-all text-sm font-medium text-slate-600 placeholder-slate-300 resize-none"></textarea>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Documentación
                            de Referencia (Catastro, Fotos, GML)</h4>
                        <div
                            class="relative border-2 border-dashed border-slate-200 rounded-[25px] p-8 flex flex-col items-center justify-center bg-slate-50/50 hover:bg-slate-50 hover:border-[#07CBBB]/30 transition-all cursor-pointer group">
                            <input type="file" wire:model="documentos_solicitud" multiple
                                class="absolute inset-0 opacity-0 cursor-pointer">

                            <svg class="w-8 h-8 text-slate-300 group-hover:text-[#07CBBB] transition-colors mb-2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span class="text-[11px] font-black text-slate-500 uppercase tracking-tighter">Arrastra tus
                                archivos o haz click aquí</span>
                            <span class="text-[9px] text-slate-400 mt-1">PDF, JPG o PNG (Máx. 10MB)</span>
                        </div>

                        <div wire:loading wire:target="documentos_solicitud"
                            class="text-[10px] font-bold text-[#07CBBB] uppercase animate-pulse">
                            Procesando cartografía...
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                        <button type="button" wire:click="cancelar"
                            class="w-full sm:w-auto px-8 py-4 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-slate-700 transition-colors">
                            Cancelar
                        </button>

                        <button type="submit"
                            class="w-full flex-1 bg-slate-900 text-white py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] shadow-xl hover:bg-[#07CBBB] transition-all transform active:scale-95 flex items-center justify-center gap-3 group">
                            <span>Enviar Solicitud Técnica</span>
                            <svg class="w-4 h-4 text-[#07CBBB] group-hover:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-mios.base>
