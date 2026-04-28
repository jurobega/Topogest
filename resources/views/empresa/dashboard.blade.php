<x-layouts.app>
    <x-mios.base>
        <div class="min-h-screen bg-[#F5F5F0] p-4 md:p-8 space-y-10 font-sans text-[#2D1B0F]">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white p-6 rounded-[35px] shadow-sm border border-[#2D1B0F]/5 flex items-center justify-between group hover:bg-[#2D1B0F] transition-all duration-500">
                    <div>
                        <p
                            class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em] group-hover:text-[#D4AF37]">
                            Solicitudes
                        </p>
                        <h3 class="text-3xl font-black group-hover:text-white mt-1">{{ $totalSolicitudes }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center relative">
                        <i class="fa-solid fa-envelope-open-text text-xl"></i>
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-ping"></span>
                    </div>
                </div>

                <div
                    class="bg-[#2D1B0F] p-6 rounded-[35px] shadow-xl border border-[#2D1B0F]/5 flex items-center justify-between">
                    <div>
                        <p class="text-[9px] font-black text-[#D4AF37] uppercase tracking-[0.2em]">Proyectos Activos
                        </p>
                        <h3 class="text-3xl font-black text-white mt-1">{{ $proyectosActivos }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-white/5 text-[#D4AF37] rounded-2xl flex items-center justify-center border border-white/10">
                        <i class="fa-solid fa-map-location-dot text-xl"></i>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-[35px] shadow-sm border border-[#2D1B0F]/5 flex items-center justify-between">
                    <div>
                        <p class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em]">Entregados Mes</p>
                        <h3 class="text-3xl font-black mt-1">{{ $entregadosMes }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-[#F5F5F0] text-[#2D1B0F] rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-check-double text-xl"></i>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-[35px] shadow-sm border border-[#2D1B0F]/5 flex items-center justify-between">
                    <div>
                        <p class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em]">Total Clientes</p>
                        <h3 class="text-3xl font-black mt-1">{{ $totalClientes }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-[#F5F5F0] text-[#2D1B0F] rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <div class="space-y-4">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-[11px] font-black uppercase tracking-[0.3em] flex items-center gap-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span> Bandeja de Entrada
                        </h2>
                        <a href="{{ route('empresa.solicitudes.index') }}"
                            class="text-[9px] font-bold text-[#D4AF37] uppercase tracking-widest hover:underline">Ver
                            todas</a>
                    </div>

                    <div class="bg-[#2D1B0F] rounded-[40px] p-6 shadow-2xl space-y-3">
                        @forelse ($ultimasSolicitudes as $item)
                            @php
                                $nombreCliente = $item->cliente->nombre_completo ?? $item->cliente->nombre ?? 'Cliente';
                                $partes = explode(' ', trim($nombreCliente));
                                $iniciales = collect($partes)
                                    ->filter()
                                    ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp

                            <div
                                class="flex items-center justify-between p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#D4AF37] flex items-center justify-center font-black text-[#2D1B0F] text-xs">
                                        {{ $iniciales ?: 'CL' }}
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-white uppercase tracking-tight">
                                            {{ $nombreCliente }}
                                        </p>
                                        <p class="text-[9px] text-gray-400 italic">
                                            {{ $item->asunto }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-6">
                                    <span
                                        class="hidden md:block text-[8px] font-bold text-gray-500 uppercase tracking-widest">
                                        {{ $item->created_at?->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                No hay solicitudes recientes
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.3em] flex items-center gap-2 px-2">
                        <i class="fa-solid fa-clock text-[#D4AF37]"></i> Esperando al Cliente
                    </h2>

                    <div class="bg-white rounded-[40px] p-6 shadow-sm border border-[#2D1B0F]/5 space-y-3">
                        @forelse ($esperandoCliente as $item)
                            <div
                                class="flex flex-col md:flex-row md:items-center justify-between p-4 border border-gray-100 rounded-2xl gap-4">
                                <div>
                                    <h4
                                        class="text-[11px] font-black text-[#2D1B0F] uppercase tracking-tighter italic">
                                        {{ $item->nombre }}
                                    </h4>
                                    <p class="text-[9px] text-[#8B7355] font-bold">
                                        Cliente:
                                        {{ $item->cliente->nombre_completo ?? $item->cliente_externo_nombre ?? 'Sin cliente' }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between md:justify-end gap-6">
                                    <div class="text-right">
                                        <p
                                            class="text-[8px] font-black text-gray-400 uppercase tracking-widest leading-none">
                                            Esperando hace
                                        </p>
                                        <p class="text-xs font-black text-amber-500 leading-none mt-1">
                                            {{ $item->updated_at?->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                No hay proyectos pendientes del cliente
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-[11px] font-black uppercase tracking-[0.3em] flex items-center gap-2 px-2">
                    <i class="fa-solid fa-person-digging text-[#2D1B0F]"></i> Proyectos en Curso
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse ($proyectosEnCurso as $item)
                        <div
                            class="bg-white rounded-[45px] p-8 shadow-sm border border-gray-100 relative overflow-hidden group">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-[#F5F5F0] rounded-bl-full -mr-16 -mt-16 transition-all group-hover:bg-[#D4AF37]/10">
                            </div>

                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-600 text-[8px] font-black uppercase tracking-widest rounded-full border border-green-100">
                                            {{ str_replace('_', ' ', $item->estado) }}
                                        </span>

                                        <h3 class="text-xl font-black uppercase tracking-tighter italic mt-3">
                                            {{ $item->nombre }}
                                        </h3>

                                        <p class="text-[10px] font-bold text-[#8B7355] uppercase tracking-widest">
                                            {{ $item->cliente->nombre_completo ?? $item->cliente_externo_nombre ?? 'Sin cliente' }}
                                        </p>
                                    </div>

                                   
                                </div>

                                <div class="space-y-4">
                                    <div
                                        class="flex justify-between text-[9px] font-black uppercase tracking-widest text-gray-400">
                                        <span>Estado del Proyecto</span>
                                        <span>{{ str_replace('_', ' ', $item->estado) }}</span>
                                    </div>
                                    <div class="flex justify-between items-end pt-2">
                                        <div>
                                            <p
                                                class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">
                                                Inicio
                                            </p>
                                            <p class="text-[11px] font-bold">
                                                {{ $item->fecha_inicio?->format('d/m/Y') ?? 'Pendiente' }}
                                            </p>
                                        </div>

                                        <div class="text-right">
                                            <p
                                                class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">
                                                Entrega Estimada
                                            </p>
                                            <p class="text-[11px] font-black text-[#2D1B0F]">
                                                {{ $item->fecha_fin_prevista?->format('d/m/Y') ?? 'Por definir' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="md:col-span-2 bg-white rounded-[35px] p-8 shadow-sm border border-gray-100 text-center text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                            No hay proyectos activos en este momento
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-[11px] font-black uppercase tracking-[0.3em] flex items-center gap-2 px-2">
                    <i class="fa-solid fa-history text-[#2D1B0F]"></i> Historial de Solicitudes
                </h2>

                <div class="bg-white rounded-[40px] overflow-hidden shadow-sm border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#2D1B0F] text-white">
                                    <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.2em]">Cliente</th>
                                    <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.2em]">Asunto</th>
                                    <th
                                        class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.2em] hidden md:table-cell">
                                        Servicio</th>
                                    <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.2em]">Estado</th>
                                    <th
                                        class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.2em] hidden sm:table-cell">
                                        Fecha
                                    </th>
                                   
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-50">
                                @forelse ($historialSolicitudes as $item)
                                    <tr class="hover:bg-[#F5F5F0]/50 transition-colors">
                                        <td
                                            class="px-8 py-5 font-bold text-[11px] uppercase tracking-tighter italic text-[#2D1B0F]">
                                            {{ $item->cliente->nombre_completo ?? $item->cliente->nombre ?? 'Cliente' }}
                                        </td>

                                        <td class="px-8 py-5 text-[10px] font-medium text-gray-600">
                                            {{ $item->asunto }}
                                        </td>

                                        <td
                                            class="px-8 py-5 text-[9px] font-black text-[#8B7355] uppercase hidden md:table-cell">
                                            {{ $item->servicio->nombre ?? 'Sin servicio' }}
                                        </td>

                                        <td class="px-8 py-5">
                                            <span
                                                class="px-3 py-1 text-[8px] font-black uppercase tracking-widest rounded-full border
                                                @if ($item->estado === 'pendiente') bg-amber-50 text-amber-600 border-amber-100
                                                @elseif($item->estado === 'vista') bg-blue-50 text-blue-600 border-blue-100
                                                @elseif($item->estado === 'convertida') bg-green-50 text-green-600 border-green-100
                                                @elseif($item->estado === 'rechazada') bg-red-50 text-red-600 border-red-100
                                                @else bg-gray-50 text-gray-500 border-gray-200 @endif">
                                                {{ str_replace('_', ' ', $item->estado) }}
                                            </span>
                                        </td>

                                        <td class="px-8 py-5 text-[10px] font-bold text-gray-400 hidden sm:table-cell">
                                            {{ $item->created_at?->format('d/m/Y') }}
                                        </td>

                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-8 py-8 text-center text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                            No hay historial de solicitudes
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-mios.base>
</x-layouts.app>