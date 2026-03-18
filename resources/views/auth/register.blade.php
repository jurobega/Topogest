<x-layouts.guest>
    <div class="min-h-screen bg-[#F0F0EB] flex items-center justify-center py-12 px-4 select-none" x-data="{ tipo: 'cliente' }">
        
        <div class="relative w-full max-w-6xl bg-white rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] overflow-hidden min-h-[850px] flex border border-white/20">
            
            <div class="absolute top-0 bottom-0 w-1/2 bg-[#2D1B0F] z-20 transition-all duration-700 ease-[cubic-bezier(0.77,0,0.175,1)] flex flex-col items-center justify-center p-12 text-center overflow-hidden"
                 :class="tipo === 'cliente' ? 'left-1/2 rounded-l-[60px]' : 'left-0 rounded-r-[60px]'">
                
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAsNTBDMTAsMzAgNDAsMzAgNTAsNTBTOTAsNzAgMTAwLDUwTTEwMCwyMEM5MCwwIDYwLDAgNTAsMjBTMTAsNDAgMCwyME0wLDgwQzEwLDYwIDQwLDYwIDUwLDgwUzkwLDEwMCAxMDAsODAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI0Q0QUYzNyIgc3Ryb2tlLXdpZHRoPSIwLjUiLz48L3N2Zz4=');">
                </div>

                <div class="relative z-30 mb-12">
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-8 h-0.5 bg-[#D4AF37] mr-3"></div>
                        <span class="text-[9px] font-black text-[#D4AF37] tracking-[0.4em] uppercase">Est. 2026</span>
                        <div class="w-8 h-0.5 bg-[#D4AF37] ml-3"></div>
                    </div>
                    <h1 class="text-6xl font-black text-white tracking-tighter italic">Topo<span class="text-[#D4AF37] not-italic">Gest</span></h1>
                    <p class="text-[9px] font-bold text-[#8B7355] uppercase tracking-[0.5em] mt-3 text-center">Engineering Precision Systems</p>
                </div>

                <div class="relative z-30 max-w-xs">
                    <div x-show="tipo === 'cliente'" x-transition:enter="delay-300 duration-500 opacity-0 scale-95" class="space-y-6">
                        <h2 class="text-xl font-bold text-white uppercase tracking-widest">¿Eres una Empresa?</h2>
                        <p class="text-gray-400 text-xs leading-relaxed font-medium">Gestione múltiples proyectos, equipos de campo y descargue informes técnicos avanzados.</p>
                        <button @click="tipo = 'empresa'" class="mt-8 bg-[#D4AF37] text-[#2D1B0F] px-12 py-4 rounded-full text-[10px] font-black uppercase tracking-[0.3em] hover:scale-105 transition-all shadow-xl shadow-[#D4AF37]/10">
                            CAMBIAR A MODO EMPRESA
                        </button>
                    </div>

                    <div x-show="tipo === 'empresa'" x-transition:enter="delay-300 duration-500 opacity-0 scale-95" class="space-y-6">
                        <h2 class="text-xl font-bold text-white uppercase tracking-widest">¿Eres Particular?</h2>
                        <p class="text-gray-400 text-xs leading-relaxed font-medium">Solicite levantamientos de parcelas, mediciones GPS y deslindes para sus propiedades personales.</p>
                        <button @click="tipo = 'cliente'" class="mt-8 bg-white text-[#2D1B0F] px-12 py-4 rounded-full text-[10px] font-black uppercase tracking-[0.3em] hover:scale-105 transition-all shadow-xl">
                            CAMBIAR A MODO CLIENTE
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-1/2 p-16 flex flex-col justify-center bg-white">
                <div class="mb-10">
                    <h3 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter">Nuevo Cliente</h3>
                    <div class="w-12 h-1 bg-[#D4AF37] mt-2"></div>
                </div>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="cliente">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Nombre Completo</label>
                            <input type="text" name="name" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required placeholder="Juan Pérez García">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">NIF / NIE</label>
                            <input type="text" name="nif_nie" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Teléfono</label>
                            <input type="tel" name="telefono" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Dirección Particular</label>
                        <input type="text" name="direccion" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Provincia</label>
                            <input type="text" name="provincia" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Email Acceso</label>
                            <input type="email" name="email" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <input type="password" name="password" placeholder="Contraseña" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm" required>
                        <input type="password" name="password_confirmation" placeholder="Confirmar" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm" required>
                    </div>

                    <button type="submit" class="w-full bg-[#2D1B0F] text-[#D4AF37] py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl hover:bg-[#1A0F08] transition-all transform hover:scale-[1.02] mt-6">
                        Crear Cuenta Cliente
                    </button>
                </form>
            </div>

            <div class="w-1/2 p-16 flex flex-col justify-center bg-white">
                <div class="mb-10 text-right">
                    <h3 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter">Nueva Empresa</h3>
                    <div class="w-12 h-1 bg-[#D4AF37] mt-2 ml-auto"></div>
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="empresa">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Nombre Fiscal</label>
                            <input type="text" name="nombre_fiscal" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                        <div class="col-span-1">
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">CIF / NIF</label>
                            <input type="text" name="nif_cif" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Provincia</label>
                            <input type="text" name="provincia" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Teléfono Corp.</label>
                            <input type="tel" name="telefono" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-1 block">Breve Descripción</label>
                        <textarea name="descripcion" rows="2" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm text-sm"></textarea>
                    </div>

                    <div class="bg-[#F5F5F0] p-4 rounded-2xl flex items-center justify-between gap-4">
                        <div class="flex flex-col">
                            <label class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em]">Logo de Empresa</label>
                            <input type="file" name="logo" class="text-[10px] mt-1 text-gray-500">
                        </div>
                        <div class="flex flex-col items-center border-l border-gray-200 pl-4">
                            <span class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em] mb-1">Visible</span>
                            <input type="checkbox" name="visible" value="1" class="rounded border-none bg-white text-[#D4AF37] focus:ring-[#D4AF37] w-5 h-5 shadow-sm">
                        </div>
                    </div>

                    <input type="email" name="email" placeholder="Correo Corporativo" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm" required>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <input type="password" name="password" placeholder="Contraseña" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm" required>
                        <input type="password" name="password_confirmation" placeholder="Confirmar" class="w-full bg-[#F5F5F0] border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-[#D4AF37]/30 shadow-sm" required>
                    </div>

                    <button type="submit" class="w-full bg-[#D4AF37] text-[#2D1B0F] py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl hover:bg-[#B8962D] transition-all transform hover:scale-[1.02] mt-4">
                        Finalizar Registro Corp.
                    </button>
                </form>
            </div>

        </div>
    </div>

    <style>
        /* Personalización de inputs para que no se vean genéricos */
        input::placeholder { color: #A0A090; font-weight: 500; font-size: 0.8rem; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 10px; }
    </style>
</x-layouts.guest>