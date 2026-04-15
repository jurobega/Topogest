<x-layouts.app>
    <div class="min-h-screen bg-[#F5F5F0] p-4 md:p-8 font-sans selection:bg-[#D4AF37]/30">

        <header class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter italic">Panel de Control</h1>
                <p class="text-[#8B7355] text-[10px] font-black uppercase tracking-[0.4em] mt-1">Bienvenido de nuevo a
                    TopoGest · Gestión Técnica</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                @php
                    $iniciales = collect(explode(' ', $cliente->nombre_completo))
                        ->map(fn($p) => strtoupper(substr($p, 0, 1)))
                        ->take(2)
                        ->implode('');
                @endphp
                <div class="w-10 h-10 rounded-xl bg-[#2D1B0F] flex items-center justify-center text-[#D4AF37] font-bold">
                    {{ $iniciales }}
                </div>
                <div class="pr-4">
                    <p class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-tight">
                        {{ $cliente->nombre_completo }}
                    </p>
                    <p class="text-[9px] font-bold text-[#8B7355] uppercase">Cliente Particular</p>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto space-y-10">

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white rounded-[30px] p-6 shadow-sm border border-gray-100 flex items-center gap-5 group hover:shadow-md transition-all">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#F5F5F0] flex items-center justify-center group-hover:bg-[#2D1B0F] transition-colors">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em]">Solicitudes Enviadas
                        </p>
                        <p class="text-3xl font-black text-[#2D1B0F]">{{ $totalSolicitudes }}</p>
                    </div>
                </div>
                <div
                    class="bg-[#2D1B0F] rounded-[30px] p-6 shadow-xl border border-[#2D1B0F] flex items-center gap-5 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-5 pointer-events-none"
                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgNDBsNDAtNDBNMCAwbDQwIDQwIiBzdHJva2U9IiNENEFGMzciIHN0cm9rZS13aWR0aD0iMC41Ii8+PC9zdmc+');">
                    </div>
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[9px] font-black text-[#D4AF37] uppercase tracking-[0.2em]">Proyectos Activos</p>
                        <p class="text-3xl font-black text-white text-shadow">{{ $proyectosActivos }}</p>
                    </div>
                </div>
                <div
                    class="bg-white rounded-[30px] p-6 shadow-sm border border-gray-100 flex items-center gap-5 group hover:shadow-md transition-all">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#F5F5F0] flex items-center justify-center group-hover:bg-[#2D1B0F] transition-colors">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-[#8B7355] uppercase tracking-[0.2em]">Entregables Listos
                        </p>
                        <p class="text-3xl font-black text-[#2D1B0F]">{{ $entregablesListos }}</p>
                    </div>
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-4 px-2">
                    <h2 class="text-sm font-black text-[#2D1B0F] uppercase tracking-widest italic">Mis Solicitudes de
                        Presupuesto</h2>
                    <a href="{{ route('cliente.solicitudes.index') }}"
                        class="text-[9px] font-black text-[#D4AF37] uppercase tracking-widest hover:underline">Ver
                        todas</a>
                </div>

                <div class="bg-white rounded-[35px] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#FDFDFB] border-b border-gray-50">
                                    <th
                                        class="px-8 py-5 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">
                                        Empresa Destino</th>
                                    <th
                                        class="px-6 py-5 text-[9px] font-black text-[#8B7355] uppercase tracking-widest">
                                        Asunto</th>
                                    <th
                                        class="px-6 py-5 text-[9px] font-black text-[#8B7355] uppercase tracking-widest text-center">
                                        Estado</th>
                                    <th
                                        class="px-6 py-5 text-[9px] font-black text-[#8B7355] uppercase tracking-widest text-right">
                                        Fecha</th>
                                    <th class="px-8 py-5"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($solicitudes as $item)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td
                                            class="px-8 py-4 font-black text-[#2D1B0F] text-[11px] uppercase tracking-tighter italic">
                                            {{ $item->empresa->nombre_fiscal }}
                                        </td>
                                        <td class="px-6 py-4 text-xs font-medium text-gray-500 italic">
                                            {{ $item->asunto }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span @class([
                                                'px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border transition-colors duration-300',
                                            
                                                // Estado: Borrador (Gris suave)
                                                'bg-gray-50 text-gray-500 border-gray-200' => $item->estado === 'borrador',
                                            
                                                // Estado: Pendiente Aceptación (Amarillo/Naranja)
                                                'bg-orange-50 text-orange-600 border-orange-100' =>
                                                    $item->estado === 'pendiente_aceptacion',
                                            
                                                // Estado: Activo (Verde TopoGest)
                                                'bg-green-50 text-green-600 border-green-100' => $item->estado === 'activo',
                                            
                                                // Estado: Entregado (Azul informativo)
                                                'bg-blue-50 text-blue-600 border-blue-100' => $item->estado === 'entregado',
                                            
                                                // Estado: Cerrado (Zinc/Oscuro)
                                                'bg-zinc-100 text-zinc-600 border-zinc-200' => $item->estado === 'cerrado',
                                            
                                                // Estado: Rechazado (Rojo error)
                                                'bg-red-50 text-red-600 border-red-100' => $item->estado === 'rechazado',
                                            
                                                // Estado: Vista / Pendiente (Si usas otros estados del dashboard)
                                                'bg-amber-50 text-amber-600 border-amber-100' =>
                                                    $item->estado === 'pendiente',
                                            ])>
                                                {{ ucfirst(str_replace('_', ' ', $item->estado)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-[10px] font-bold text-gray-400">
                                             {{ $item->created_at?->format('d/m/Y') ?? 'Pendiente'}}
                                        </td>
                                        <td class="px-8 py-4 text-right">
                                            <button
                                                class="bg-[#F5F5F0] text-[#2D1B0F] px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-[#D4AF37] hover:text-white transition-all">
                                                Detalle
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-4 px-2">
                    <h2 class="text-sm font-black text-[#2D1B0F] uppercase tracking-widest italic">Proyectos en Curso
                    </h2>
                    <a href="{{ route('cliente.proyectos.index') }}"
                        class="text-[9px] font-black text-[#D4AF37] uppercase tracking-widest hover:underline">Gestionar
                        Proyectos</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[600px] overflow-y-auto pr-2">
                    @foreach ($proyectos as $item)
                        <div
                            class="bg-white rounded-[35px] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col group relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-6">
                                <span
                                    class="px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest bg-green-50 text-green-600 border border-green-100">{{ $item->estado }}</span>
                            </div>

                            <h3
                                class="text-xl font-black text-[#2D1B0F] uppercase tracking-tighter italic mb-1 group-hover:text-[#D4AF37] transition-colors">
                                {{ $item->nombre }}
                            </h3>
                            <p
                                class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">
                                Gestor: {{ $item->empresa->nombre_fiscal }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div class="bg-[#FDFDFB] p-3 rounded-2xl border border-gray-50">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Fecha Inicio</p>
                                    <p class="text-[11px] font-bold text-[#2D1B0F]">
                                        {{ $item->fecha_inicio?->format('d/m/Y') ?? 'Pendiente' }}</p>
                                </div>
                                <div class="bg-[#FDFDFB] p-3 rounded-2xl border border-gray-50">
                                    <p
                                        class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">
                                        Finalización Prev.</p>
                                    <p class="text-[11px] font-bold text-[#2D1B0F]">
                                        {{ $item->fecha_fin_prevista?->format('d/m/Y') ?? 'Pendiente' }}</p>
                                </div>
                            </div>

                            <a href="#"
                                class="w-full text-center bg-[#2D1B0F] text-[#D4AF37] py-4 rounded-2xl font-black text-[9px] uppercase tracking-[0.3em] hover:bg-[#1A0F08] transition-all transform active:scale-95 shadow-lg shadow-[#2D1B0F]/10">
                                Ver Seguimiento Proyecto
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

        </main>

        <footer class="max-w-7xl mx-auto mt-12 py-6 border-t border-gray-200 flex justify-between items-center">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">© 2026 TopoGest · Consultoría
                Técnica de Precisión</p>
            <div class="flex gap-4">
                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Servidores Operativos</p>
            </div>
        </footer>

    </div>

    <style>
        /* Estilo de scroll técnico para las secciones con overflow */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #D4AF3733;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-layouts.app>
