<div>
    <button 
        wire:click="$set('openCrear', true)" 
        class="group flex items-center gap-3 bg-[#2D1B0F] hover:bg-[#8B7355] text-white px-6 py-3 rounded-2xl transition-all duration-300 shadow-lg shadow-[#2D1B0F]/10 hover:shadow-[#8B7355]/20 active:scale-95"
    >
        <i class="fa-solid fa-folder-plus text-[#D4AF37] group-hover:rotate-12 transition-transform"></i>
        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Nuevo Proyecto</span>
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center gap-4 py-2">
                <div class="w-10 h-10 rounded-xl bg-[#D4AF37]/10 flex items-center justify-center">
                    <i class="fa-solid fa-briefcase text-[#D4AF37]"></i>
                </div>
                <div>
                    <h3 class="text-lg font-black uppercase tracking-tighter italic text-[#2D1B0F]">Apertura de Expediente</h3>
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Gestión de proyectos externos</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8">
                <div class="space-y-5">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                        <span class="text-[10px] font-black uppercase tracking-widest text-[#8B7355]">01. Detalles Técnicos</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Nombre del Proyecto</label>
                            <input type="text" wire:model="cform.nombre" 
                                class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all"
                                placeholder="Ej: Levantamiento Topográfico Parcela 14">
                            @error('cform.nombre') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Descripción del Encargo</label>
                            <textarea wire:model="cform.descripcion" rows="3"
                                class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all resize-none"
                                placeholder="Detalles específicos del trabajo de campo..."></textarea>
                            @error('cform.descripcion') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Fecha estimada de entrega</label>
                            <input type="date" wire:model="cform.fecha_fin_prevista" min="{{ now()->format('Y-m-d') }}"
                                class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all text-[#2D1B0F]">
                            @error('cform.fecha_fin_prevista') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="flex flex-col gap-1 pb-2 border-b border-gray-100">
                        <span class="text-[10px] font-black uppercase tracking-widest text-[#8B7355]">02. Información del Cliente</span>
                        
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Nombre del Cliente</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-300">
                                    <i class="fa-solid fa-user-tag text-xs"></i>
                                </span>
                                <input type="text" wire:model="cform.cliente_externo_nombre" 
                                    class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 pl-11 pr-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all"
                                    placeholder="Nombre completo o Razón Social">
                            </div>
                            @error('cform.cliente_externo_nombre') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Teléfono</label>
                            <input type="text" wire:model="cform.cliente_externo_telefono" 
                                class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all"
                                placeholder="+34 000 000 000">
                            @error('cform.cliente_externo_telefono') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2 italic">Email</label>
                            <input type="email" wire:model="cform.cliente_externo_email" 
                                class="w-full bg-[#F5F5F0] border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-[#D4AF37] transition-all"
                                placeholder="cliente@ejemplo.com">
                            @error('cform.cliente_externo_email') <span class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center gap-3">
                <button wire:click="cancelar" 
                    class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#2D1B0F] hover:bg-gray-50 transition-all">
                    Descartar
                </button>
                <button wire:click="crear" wire:loading.attr="disabled"
                    class="bg-[#D4AF37] text-[#2D1B0F] px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#2D1B0F] hover:text-white transition-all shadow-lg shadow-[#D4AF37]/10 disabled:opacity-50 flex items-center gap-2">
                    <span wire:loading.remove wire:target="crear">Registrar Proyecto</span>
                    <span wire:loading wire:target="crear" class="flex items-center gap-2">
                        <i class="fa-solid fa-spinner animate-spin"></i> Procesando
                    </span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>