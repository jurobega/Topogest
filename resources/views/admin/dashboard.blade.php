<x-layouts.app>
   <div class="min-h-screen bg-[#FDFDFB] py-8 px-4 sm:px-12">
        <header class="max-w-7xl mx-auto mb-10">
            <h1 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                {{ __('Panel de Control') }}
            </h1>
            <div class="flex items-center gap-3 mt-2">
                <span class="h-[1px] w-12 bg-[#D4AF37]"></span>
                <span class="text-[10px] font-bold text-[#8B7355] uppercase tracking-[0.6em]">
                    {{ __('Administración del Sistema') }}
                </span>
            </div>
        </header>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-[30px] p-6 shadow-sm border border-[#D4AF37]/10 flex items-center gap-5 transition-transform hover:scale-105 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-[#F5F5F0] flex items-center justify-center text-[#D4AF37]">
                    <i class="fa-solid fa-building text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-[#2D1B0F]">{{ $totalEmpresas }}</p>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Empresas') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[30px] p-6 shadow-sm border border-blue-100 flex items-center gap-5 transition-transform hover:scale-105 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-[#2D1B0F]">{{ $totalClientes }}</p>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Clientes') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[30px] p-6 shadow-sm border border-green-100 flex items-center gap-5 transition-transform hover:scale-105 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-500">
                    <i class="fa-solid fa-map-location-dot text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-[#2D1B0F]">{{ $proyectosActivos }}</p>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Proyectos') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[30px] p-6 shadow-sm border border-amber-100 flex items-center gap-5 transition-transform hover:scale-105 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <i class="fa-solid fa-envelope-open-text text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-[#2D1B0F]">{{ $solicitudesPendientes }}</p>
                    <p class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Pendientes') }}</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-[40px] p-8 shadow-xl border border-gray-100/50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[12px] font-black text-[#8B7355] uppercase tracking-[0.3em] flex items-center gap-3">
                        <span class="w-2 h-2 bg-[#D4AF37] rounded-full"></span> 
                        {{ __('Empresas Recientes') }}
                    </h3>
                    <a href="{{-- {{ route('admin.empresas.index') }} --}}" wire:navigate class="text-[9px] font-black text-[#D4AF37] uppercase tracking-widest hover:text-[#2D1B0F] transition-colors">
                        {{ __('Ver todos') }} <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-[#F5F5F0]">
                                <th class="pb-4 text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Nombre Fiscal') }}</th>
                                <th class="pb-4 text-[10px] font-black text-[#8B7355] uppercase tracking-widest text-right">{{ __('Registro') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F0]">
                            @foreach($empresasRecientes as $empresa)
                            <tr class="group hover:bg-[#FDFDFB] transition-colors">
                                <td class="py-4 text-sm font-bold text-[#2D1B0F]">{{ $empresa->nombre_fiscal }}</td>
                                <td class="py-4 text-[11px] font-bold text-[#8B7355] text-right">{{ $empresa->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-[40px] p-8 shadow-xl border border-gray-100/50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[12px] font-black text-[#8B7355] uppercase tracking-[0.3em] flex items-center gap-3">
                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span> 
                        {{ __('Clientes Recientes') }}
                    </h3>
                    <a href="{{-- {{ route('admin.clientes.index') }} --}}" wire:navigate class="text-[9px] font-black text-blue-500 uppercase tracking-widest hover:text-[#2D1B0F] transition-colors">
                        {{ __('Ver todos') }} <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-[#F5F5F0]">
                                <th class="pb-4 text-[10px] font-black text-[#8B7355] uppercase tracking-widest">{{ __('Nombre Completo') }}</th>
                                <th class="pb-4 text-[10px] font-black text-[#8B7355] uppercase tracking-widest text-right">{{ __('Registro') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F0]">
                            @foreach($clientesRecientes as $cliente)
                            <tr class="group hover:bg-[#FDFDFB] transition-colors">
                                <td class="py-4 text-sm font-bold text-[#2D1B0F]">{{ $cliente->nombre_completo }}</td>
                                <td class="py-4 text-[11px] font-bold text-[#8B7355] text-right">{{ $cliente->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>