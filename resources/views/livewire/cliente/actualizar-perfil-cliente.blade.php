<x-form-section submit="guardar">
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span
                class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Información Personal') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] max-w-md">
                {{ __('Actualiza tus datos de contacto.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 sm:col-start-2 space-y-6">
            <div>
                <x-label for="nombre_completo"
                    class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                    <i class="fa-solid fa-user-tie me-1"></i> {{ __('Nombre Completo') }}
                </x-label>
                <x-input id="nombre_completo" type="text"
                    class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                    wire:model="nombre_completo" />
                <x-input-error for="nombre_completo" class="mt-2" />
            </div>

            <div>
                <x-label for="nif_nie"
                    class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                    <i class="fa-solid fa-id-card-clip me-1"></i> {{ __('NIF / NIE') }}
                </x-label>
                <x-input id="nif_nie" type="text"
                    class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                    wire:model="nif_nie" />
                <x-input-error for="nif_nie" class="mt-2" />
            </div>

            <div>
                <x-label for="telefono"
                    class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                    <i class="fa-solid fa-phone-flip me-1"></i> {{ __('Teléfono') }}
                </x-label>
                <x-input id="telefono" type="text"
                    class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                    wire:model="telefono" />
                <x-input-error for="telefono" class="mt-2" />
            </div>

            <div>
                <x-label for="direccion"
                    class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                    <i class="fa-solid fa-location-dot me-1"></i> {{ __('Dirección') }}
                </x-label>
                <x-input id="direccion" type="text"
                    class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                    wire:model="direccion" />
                <x-input-error for="direccion" class="mt-2" />
            </div>

            <div>
                <x-label for="provincia"
                    class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                    <i class="fa-solid fa-map me-1"></i> {{ __('Provincia') }}
                </x-label>
                <x-input id="provincia" type="text"
                    class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                    wire:model="provincia" />
                <x-input-error for="provincia" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col items-center w-full gap-4 pb-4">
            <x-action-message class="text-[10px] font-black uppercase text-[#D4AF37]" on="guardado">
                <i class="fa-solid fa-check-double me-1"></i> {{ __('Guardado correctamente.') }}
            </x-action-message>

            <x-button
                class="rounded-xl shadow-lg shadow-[#2D1B0F]/10 bg-[#2D1B0F] text-[#D4AF37] hover:scale-105 transition-all duration-300 px-12 py-3 text-[10px] font-black tracking-[0.2em]">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>
