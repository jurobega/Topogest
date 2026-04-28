<div>
    @if($solicitud)
    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            <div class="bg-[#2D1B0F] -mx-6 -mt-6 p-8 mb-4">
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-[2px] w-8 bg-[#D4AF37]"></span>
                    <p class="text-[10px] font-black text-[#D4AF37] uppercase tracking-[0.4em]">Procesamiento de Solicitud</p>
                </div>
                <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic leading-none">
                    Convertir en Proyecto
                </h2>
            </div>
            
            <div class="bg-[#F5F5F0] -mx-6 px-8 py-4 border-b border-gray-200 flex flex-wrap gap-8 text-left">
                <div>
                    <p class="text-[8px] font-black text-[#8B7355] uppercase tracking-widest mb-1 italic">Cliente</p>
                    <p class="text-xs font-bold text-[#2D1B0F] uppercase tracking-tight italic">{{ $solicitud->cliente->nombre_completo }}</p>
                </div>
                <div>
                    <p class="text-[8px] font-black text-[#8B7355] uppercase tracking-widest mb-1 italic">Servicio de Referencia</p>
                    <p class="text-xs font-bold text-[#2D1B0F] uppercase tracking-tight italic">{{ $solicitud->servicio->nombre }}</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="convertir" id="form-convertir" class="space-y-6 py-4 text-left">
                <div class="space-y-2">
                    <label for="nombre" class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest ml-1">Nombre del proyecto</label>
                    <input type="text" id="nombre" wire:model="cform.nombre" 
                        class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent transition-all @error('form.nombre') border-red-300 @enderror"
                        placeholder="Ej: Levantamiento Topográfico Parcela 14...">
                    @error('cform.nombre') <span class="text-[10px] font-black text-red-500 uppercase tracking-tighter italic ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="descripcion" class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest ml-1">Descripción</label>
                    <textarea id="descripcion" wire:model="cform.descripcion" rows="4"
                        class="w-full bg-white border-2 border-gray-100 rounded-[25px] py-4 px-5 text-sm font-medium leading-relaxed focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent transition-all @error('form.descripcion') border-red-300 @enderror"
                        placeholder="Detalla el alcance técnico del proyecto..."></textarea>
                    @error('cform.descripcion') <span class="text-[10px] font-black text-red-500 uppercase tracking-tighter italic ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="fecha_fin_prevista" class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest ml-1">Fecha estimada de entrega</label>
                    <input type="date" id="fecha_fin_prevista" wire:model="cform.fecha_fin_prevista"
                        class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent transition-all @error('form.fecha_estimada') border-red-300 @enderror">
                    @error('cform.fecha_fin_prevista') <span class="text-[10px] font-black text-red-500 uppercase tracking-tighter italic ml-1">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 w-full">
                <button type="button" wire:click="cerrar" 
                    class="text-[9px] font-black uppercase tracking-widest text-gray-400 hover:text-[#2D1B0F] transition-colors order-2 sm:order-1">
                    Cancelar operación
                </button>
                
                <button wire:click="crear" wire:loading.attr="disabled"
                    class="w-full sm:w-auto bg-[#D4AF37] text-[#2D1B0F] px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-[#D4AF37]/20 hover:bg-[#2D1B0F] hover:text-[#D4AF37] hover:scale-[1.02] active:scale-[0.98] transition-all disabled:opacity-50 disabled:cursor-not-allowed order-1 sm:order-2">
                    <span wire:loading.remove wire:target="convertir">Crear proyecto</span>
                    <span wire:loading wire:target="convertir" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Procesando...
                    </span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
@endif
</div>
