<x-layouts.app>
    
   <section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-[#2D1B0F] py-20">
    
    <div class="absolute inset-0 opacity-20 pointer-events-none" 
         style="background-image: 
            radial-gradient(#D4AF37 0.5px, transparent 0.5px), 
            url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAsNTBDMTAsMzAgNDAsMzAgNTAsNTBTOTAsNzAgMTAwLDUwTTEwMCwyMEM5MCwwIDYwLDAgNTAsMjBTMTAsNDAgMCwyME0wLDgwQzEwLDYwIDQwLDYwIDUwLDgwUzkwLDEwMCAxMDAsODAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI0Q0QUYzNyIgc3Ryb2tlLXdpZHRoPSIwLjUiLz48L3N2Zz4='); 
            background-size: 40px 40px, 400px 400px;">
    </div>

    <div class="absolute top-1/4 -left-20 w-96 h-96 bg-[#D4AF37] rounded-full blur-[150px] opacity-10"></div>
    <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-[#8B7355] rounded-full blur-[150px] opacity-10"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-full mb-8 backdrop-blur-md">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#D4AF37] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#D4AF37]"></span>
            </span>
            <span class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Red Nacional de Topografía</span>
        </div>

        <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter leading-none mb-6 italic">
            Mide el <span class="text-[#D4AF37] not-italic">mundo</span>,<br>
            gestiona el <span class="text-[#D4AF37] not-italic">éxito</span>.
        </h1>

        <p class="max-w-2xl mx-auto text-gray-400 text-base md:text-xl font-medium leading-relaxed mb-12">
            La plataforma definitiva para conectar con ingenieros topógrafos verificados, gestionar levantamientos y visualizar el territorio con precisión milimétrica.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="#directorio" class="group relative bg-[#D4AF37] text-[#2D1B0F] px-10 py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] transition-all hover:scale-105 shadow-[0_20px_40px_rgba(212,175,55,0.2)]">
                Explorar Directorio
                <div class="absolute inset-0 rounded-2xl border-2 border-[#D4AF37] group-hover:scale-110 opacity-0 group-hover:opacity-100 transition-all"></div>
            </a>
            @guest
                <a href="{{ route('register') }}" class="text-white border border-white/20 px-10 py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] hover:bg-white hover:text-[#2D1B0F] transition-all">
                    Registrar Empresa
                </a> 
            @endguest
               
        </div>

        <div class="mt-20 flex flex-col items-center gap-4 opacity-40">
            <span class="text-[9px] font-bold text-white uppercase tracking-[0.5em]">Desliza para buscar</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-[#D4AF37] to-transparent"></div>
        </div>
    </div>
</section>

<div id="directorio" class="bg-[#F0F0EB] py-4">
    @livewire('directorio-empresas')
</div>

   
    
</x-layouts.app>