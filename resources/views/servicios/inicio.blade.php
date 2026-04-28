<x-layouts.app>
    <x-mios.base>
       <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
    <div class="p-8 bg-white flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-extrabold text-[#2D1B0F] tracking-tight">Servicios Técnicos</h3>
            <p class="text-sm text-[#8B7355] mt-1 font-medium">Configuración del catálogo de prestaciones</p>
        </div>
       <a href="{{ route('admin.servicios.create') }}" class="bg-[#D4AF37] hover:bg-[#B8962D] text-white px-4 py-2 rounded-lg text-sm font-bold transition shadow-lg shadow-[#D4AF37]/20">
            + NUEVO SERVICIO
       </a>
    </div>

    <table class="w-full text-left">
        <thead class="border-b border-gray-100">
            <tr>
                <th class="px-8 py-5 text-[11px] uppercase tracking-[0.2em] text-[#8B7355] font-bold">Servicio</th>
                <th class="px-8 py-5 text-[11px] uppercase tracking-[0.2em] text-[#8B7355] font-bold">Detalles de la Prestación</th>
                <th class="px-8 py-5 text-[11px] uppercase tracking-[0.2em] text-[#8B7355] font-bold text-right">Gestión</th>
            </tr>
        </thead>
        
        <tbody class="divide-y divide-gray-50">
            @foreach ( $servicios as $item )
            <tr class="group hover:bg-[#F5F5F0]/50 transition-all duration-200">
                <td class="px-8 py-6">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full bg-[#D4AF37] mr-4 shadow-[0_0_8px_rgba(212,175,55,0.5)]"></div>
                        <span class="font-bold text-[#2D1B0F] text-base">{{ $item->nombre }}</span>
                    </div>
                </td>
                <td class="px-8 py-6 text-sm text-gray-500 leading-relaxed max-w-md">
                    {{ $item->descripcion }}
                </td>
                <td class="px-8 py-6 text-right">
                    <form method="POST" id="form-eliminar-{{ $item->id }}" action="{{ route('admin.servicios.destroy' , $item->id) }}">
                        @csrf
                        @method('DELETE')
                    <div class="flex justify-end items-center gap-2">
                        <a href="{{ route('admin.servicios.edit',$item->id) }}" class="p-2.5 bg-gray-50 text-[#8B7355] hover:bg-[#D4AF37]/10 hover:text-[#D4AF37] rounded-lg transition-colors group/edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 14.207l-5 1 1-5 9.914-9.914z" /></svg>
                        </a>
                        
                        <button class="p-2.5 bg-gray-50 text-[#8B7355] hover:bg-red-50 hover:text-red-500 rounded-lg transition-colors" type="button" onclick="confirmarEliminar({{ $item->id }})">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
    </x-mios.base>
</x-layouts.app>