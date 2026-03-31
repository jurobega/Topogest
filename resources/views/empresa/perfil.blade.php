<x-layouts.app>
    <x-mios.base>
        @if ($empresa)
            
        
        <div class="bg-[#FDFDFB] border-b border-gray-100 py-4 px-4 sm:px-12">
            <div
                class="max-w-7xl mx-auto flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                <a href="/" class="hover:text-[#2D1B0F] transition-colors">Inicio</a>
                <span>/</span>
                <a href="/topografos" class="hover:text-[#2D1B0F] transition-colors">Directorio</a>
                <span>/</span>
                <span class="text-[#8B7355]">{{ $empresa->nombre_fiscal}}</span>
            </div>
        </div>

        <div class="min-h-screen bg-[#FDFDFB] pb-20">
            <div
                class="relative h-64 sm:h-80 bg-[#2D1B0F] flex flex-col items-center justify-center text-center p-6 overflow-hidden">
                <div class="absolute inset-0 opacity-15 pointer-events-none"
                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAsNTBDMTAsMzAgNDAsMzAgNTAsNTBTOTAsNzAgMTAwLDUwTTEwMCwyMEM5MCwwIDYwLDAgNTAsMjBTMTAsNDAgMCwyME0wLDgwQzEwLDYwIDQwLDYwIDUwLDgwUzkwLDEwMCAxMDAsODAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI0Q0QUYzNyIgc3Ryb2tlLXdpZHRoPSIwLjUiLz48L3N2Zz4='); background-size: 300px;">
                </div>

                <div
                    class="relative z-10 w-32 h-32 sm:w-40 sm:h-40 rounded-[3rem] bg-white shadow-2xl flex items-center justify-center overflow-hidden border-4 border-[#D4AF37]/20 mb-6 transition-transform hover:scale-105 duration-500">
                    @if ($empresa->logo_path)
                        <img src="{{ asset('storage/' . $empresa->logo_path) }}" class="w-full h-full object-cover">
                    @else
                        <span
                            class="text-5xl sm:text-6xl font-black text-[#2D1B0F] tracking-tighter">{{ substr($empresa->nombre_fiscal, 0, 2) }}</span>
                    @endif
                </div>

                <h1 class="relative z-10 text-3xl sm:text-5xl font-black text-white uppercase tracking-tighter italic">
                    {{ $empresa->nombre_fiscal }}
                </h1>

                <div class="relative z-10 flex items-center gap-3 mt-4">
                    <span class="h-[1px] w-12 bg-[#D4AF37]"></span>
                    <span class="text-[10px] font-bold text-[#D4AF37] uppercase tracking-[0.6em]">Perfil Técnico
                        Certificado</span>
                    <span class="h-[1px] w-12 bg-[#D4AF37]"></span>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-12 -mt-10 relative z-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    <div class="lg:col-span-8 space-y-8">
                        <div class="bg-white rounded-[40px] p-8 sm:p-12 shadow-xl border border-gray-100/50">
                            <div class="mb-12">
                                <h4
                                    class="text-[12px] font-black text-[#8B7355] uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                                    <span class="w-2 h-2 bg-[#D4AF37] rounded-full"></span> Resumen Ejecutivo
                                </h4>
                                <div
                                    class="text-gray-600 leading-relaxed text-lg italic border-l-4 border-[#F5F5F0] pl-8 py-2">
                                    "{{ $empresa->descripcion }}"
                                </div>
                            </div>

                            <div class="mb-12">
                                <h4 class="text-[12px] font-black text-[#8B7355] uppercase tracking-[0.3em] mb-4">Radio
                                    de Operaciones</h4>
                                <div
                                    class="flex items-center gap-4 text-base text-[#2D1B0F] font-bold bg-[#F5F5F0] w-fit px-6 py-4 rounded-2xl border border-gray-100">
                                    <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m6-3l5.447 2.724a1 1 0 01.553.894v10.764a1 1 0 01-1.447.894L15 17m-6 3V7m6-10V17" />
                                    </svg>
                                    {{ $empresa->zona_actuacion }}
                                </div>
                            </div>

                            <div>
                                <h4 class="text-[12px] font-black text-[#8B7355] uppercase tracking-[0.3em] mb-6">
                                    Cartera de Servicios Técnicos</h4>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($empresa->servicios as $servicio)
                                        <span
                                            class="bg-white border border-gray-200 text-[#2D1B0F] text-[11px] font-black px-6 py-3 rounded-xl uppercase tracking-tighter shadow-sm hover:border-[#D4AF37] hover:shadow-md transition-all cursor-default">
                                            {{ $servicio->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-6">
                        <div
                            class="bg-[#2D1B0F] rounded-[40px] p-10 text-white space-y-8 shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#D4AF37]/5 rounded-full -mr-16 -mt-16">
                            </div>

                            <h4 class="text-[11px] font-black text-[#D4AF37] uppercase tracking-[0.3em]">Información de
                                Enlace</h4>

                            <div class="space-y-6">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Sede
                                            Central</p>
                                        <p class="text-sm font-bold mt-1">{{ $empresa->direccion }},
                                            {{ $empresa->provincia }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Línea
                                            Directa</p>
                                        <p class="text-sm font-bold mt-1">{{ $empresa->telefono }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Portal
                                            Corporativo</p>
                                        <a href="{{ $empresa->web }}" target="_blank"
                                            class="text-sm font-bold mt-1 text-[#D4AF37] underline underline-offset-4 cursor-pointer">
                                            {{ $empresa->web }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8 border-t border-white/10">
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Atención al
                                    cliente</p>
                                <p class="text-[13px] font-medium mt-3 leading-relaxed text-gray-300 italic">
                                    {{ $empresa->horario_atencion }}</p>
                            </div>
                            <a href="{{ route('cliente.solicitar-servicio') }}"
                                class="flex  text-center items-center justify-center w-full bg-[#D4AF37] text-[#2D1B0F] py-6 rounded-[25px] font-black text-[11px] uppercase tracking-[0.3em] shadow-[0_20px_50px_rgba(212,175,55,0.3)] hover:bg-white hover:shadow-2xl transition-all duration-300 transform active:scale-95 group">
                                <span>Solicitar Presupuesto Técnico</span>
                            </a>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white border border-gray-100 p-8 rounded-[40px] shadow-lg text-center">
                                <p class="text-5xl font-black text-[#2D1B0F] tracking-tighter">
                                    {{ $empresa->anios_experiencia }}</p>
                                <p class="text-[10px] font-black text-[#D4AF37] uppercase tracking-widest mt-3">Años
                                    Exp.</p>
                            </div>
                            <div class="bg-white border border-gray-100 p-8 rounded-[40px] shadow-lg text-center">
                                <p class="text-5xl font-black text-[#2D1B0F] tracking-tighter">
                                    {{ $empresa->numero_proyectos }}</p>
                                <p class="text-[10px] font-black text-[#D4AF37] uppercase tracking-widest mt-3">
                                    Proyectos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-mios.base>
</x-layouts.app>
