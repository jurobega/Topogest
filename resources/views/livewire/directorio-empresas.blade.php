    <div class="max-w-6xl mx-auto px-4 py-12 select-none">

        <div class="max-w-6xl mx-auto px-4 py-4 select-none">
        
        <div class="bg-white rounded-[35px] shadow-sm border border-gray-100 p-4 mb-12 flex flex-col md:flex-row items-center gap-4">
            
            <div class="hidden md:flex w-12 h-12 bg-[#2D1B0F] rounded-2xl items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <div class="relative w-full md:flex-1">
                <label class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">Localización</label>
                <input type="text" 
                    wire:model.live="provincia"
                    placeholder="Escribe una provincia (ej. Almería)..." 
                    class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm placeholder-gray-400 font-medium">
            </div>

            <div class="relative w-full md:flex-1">
                <label class="absolute -top-2 left-5 bg-white px-2 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">Especialidad técnica</label>
                <select wire:model.live="servicio_id" 
                        class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-sm text-gray-600 font-medium appearance-none cursor-pointer">
                    <option value=0>Todos los servicios disponibles</option>
                    @foreach ( $servicios as $item )
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                    
                    
                </select>
            </div>

            <button wire:click="limpiar" class="w-full md:w-auto px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#2D1B0F] transition-colors">
                Limpiar
            </button>
        </div>

        <div class="space-y-8">
            </div>

        <style>
            /* Estilizado de la flecha del select para que encaje con TopoGest */
            select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%238b7355' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
                background-position: right 1.5rem center;
                background-repeat: no-repeat;
                background-size: 1.2em 1.2em;
            }
        </style>
    </div>

        @foreach ( $empresa as $item )
        <div class="group bg-white rounded-[35px] p-2 mb-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col lg:flex-row items-stretch overflow-hidden">
            
            <div class="lg:w-1/4 bg-[#2D1B0F] rounded-[30px] p-8 flex flex-col items-center justify-center text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0ibm9uZSIvPjxwYXRoIGQ9Ik0wIDQwbDQwLTQwTTAgMGw0MCA0MCIgc3Ryb2tlPSIjRDRBRjM3IiBzdHJva2Utd2lkdGg9IjAuNSIvPjwvc3ZnPg==');"></div>
                
                <div class="relative z-10 w-24 h-24 rounded-3xl bg-white/5 border border-white/10 flex items-center justify-center mb-4 shadow-2xl group-hover:scale-110 transition-transform duration-500">
                    @if($item->logo_path)
                        <img src="{{ asset('storage/' . $item->logo_path) }}" class="w-full h-full object-cover rounded-3xl">
                    @else
                        <span class="text-4xl font-black text-[#D4AF37]">{{ substr($item->nombre_fiscal, 0, 2) }}</span>
                    @endif
                </div>
                
                <span class="relative z-10 text-[9px] font-black text-[#D4AF37] uppercase tracking-[0.4em] mb-1">Certificado</span>
                <span class="relative z-10 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $item->nif_cif }}</span>
            </div>

            <div class="lg:w-2/4 p-8 lg:p-10 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-3">
                    <h3 class="text-2xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                        {{ $item->nombre_fiscal }}
                    </h3>
                </div>

                <div class="flex flex-wrap gap-5 mb-6">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-[#F5F5F0] flex items-center justify-center">
                            <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-[#8B7355] uppercase tracking-widest">{{ $item->provincia }}</span>
                    </div>
                    
                    @if($item->telefono)
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-[#F5F5F0] flex items-center justify-center">
                            <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-[#8B7355] uppercase tracking-widest">{{ $item->telefono }}</span>
                    </div>
                    @endif
                </div>

                <p class="text-gray-500 text-sm leading-relaxed mb-6 italic">
                    "{{ $item->descripcion ?? 'Servicios profesionales de topografía e ingeniería con equipos de última generación para garantizar la máxima precisión en cada proyecto.' }}"
                </p>

                <div class="flex flex-wrap gap-2">
                    @foreach ( $item->servicios as $servicios )
                        <span class="text-[9px] font-bold text-[#2D1B0F] bg-[#F5F5F0] px-4 py-1.5 rounded-lg border border-gray-100 uppercase tracking-tighter">{{ $servicios->nombre }}</span>
                    @endforeach
                </div>  
                    
            </div>

            <div class="lg:w-1/4 p-8 bg-[#FDFDFB] border-l border-gray-50 flex flex-col justify-center gap-4">
                <a href="{{ route('cliente.solicitar-servicio' , $item->id) }}" class="w-full text-center bg-[#2D1B0F] text-[#D4AF37] py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-[#1A0F08] transition-all shadow-xl shadow-[#2D1B0F]/10 transform active:scale-95">
                    Solicitar Servicio
                </a>
                
                <a href="{{ route('empresa.perfil' , $item->id) }}" class="w-full text-center bg-white text-[#2D1B0F] border-2 border-[#F5F5F0] py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:border-[#D4AF37]/30 transition-all transform active:scale-95">
                    Más Información
                </a>
                
                <p class="text-[9px] text-center text-gray-400 font-bold uppercase tracking-widest mt-2">Respuesta en < 24h</p>
            </div>
        </div>
        @endforeach
    </div>