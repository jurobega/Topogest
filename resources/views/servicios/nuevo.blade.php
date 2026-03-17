<x-layouts.app>
    <x-mios.base>
        <div class="max-w-3xl mx-auto py-8">
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('servicios.index') }}" class="flex items-center text-[10px] font-extrabold text-[#8B7355] hover:text-[#2D1B0F] uppercase tracking-[0.2em] transition-all group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al Panel
                </a>
                <span class="text-[10px] font-bold text-[#D4AF37]/50 uppercase tracking-[0.3em]">Módulo Administrativo</span>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl shadow-black/5 border border-gray-100 overflow-hidden">
                <div class="h-2 bg-[#D4AF37]"></div>
                
                <div class="p-10">
                    <div class="mb-10">
                        <h2 class="text-3xl font-black text-[#2D1B0F] tracking-tighter">Registrar Servicio</h2>
                        <p class="text-sm text-[#8B7355] mt-2 font-medium">Introduce los datos técnicos para actualizar el catálogo oficial de GeoTerra.</p>
                    </div>

                    <form action="{{ route('servicios.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="group">
                            <label for="nombre" class="block text-[11px] uppercase tracking-[0.2em] font-black text-[#2D1B0F] mb-3 ml-1">
                                Nombre del Servicio Técnico
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre" 
                                   value="{{ @old('nombre') }}"
                                   class="w-full bg-[#F5F5F0]/50 border-2 border-transparent focus:border-[#D4AF37] focus:bg-white focus:ring-0 rounded-2xl py-4 px-6 text-[#2D1B0F] font-semibold transition-all placeholder:text-gray-300 shadow-sm"
                                   placeholder="Ej: Levantamiento Fotogramétrico con Dron">
                                <x-input-error for="nombre" />
                        </div>
                        

                        <div class="group">
                            <label for="descripcion" class="block text-[11px] uppercase tracking-[0.2em] font-black text-[#2D1B0F] mb-3 ml-1">
                                Descripción Detallada
                            </label>
                            <textarea name="descripcion" 
                                      id="descripcion" 
                                      rows="6"
                                      class="w-full bg-[#F5F5F0]/50 border-2 border-transparent focus:border-[#D4AF37] focus:bg-white focus:ring-0 rounded-2xl py-4 px-6 text-[#2D1B0F] font-medium leading-relaxed transition-all placeholder:text-gray-300 shadow-sm"
                                      placeholder="Describe el alcance del servicio, metodología y entregables finales..."
                                      >{{ @old('descripcion') }}</textarea>
                                    <x-input-error for="descripcion" />
                        </div>
                        

                        <div class="pt-4 border-t border-gray-50"></div>

                        <div class="flex items-center justify-end gap-8">
                            <a href="{{ route('servicios.index') }}" type="button" class="text-[11px] font-black text-[#8B7355] hover:text-red-600 uppercase tracking-[0.2em] transition-colors">
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="bg-[#2D1B0F] hover:bg-[#1A0F08] text-[#D4AF37] px-12 py-5 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-2xl shadow-[#2D1B0F]/20 transition-all transform hover:scale-[1.03] active:scale-[0.97]">
                                Confirmar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-8 text-[9px] text-[#8B7355] uppercase tracking-[0.4em] font-bold opacity-40">
                Sistema de Gestión Territorial v2.0
            </p>
        </div>
    </x-mios.base>
</x-layouts.app>