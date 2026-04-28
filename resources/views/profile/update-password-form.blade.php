<x-form-section submit="updatePassword">
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Actualizar Contraseña') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] max-w-md">
                {{ __('Asegúrate de que tu cuenta utilice una contraseña larga y aleatoria para mantener la seguridad.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 sm:col-start-2 space-y-6">
            <div>
                <x-label for="current_password" value="{{ __('Contraseña Actual') }}" class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic" />
                <x-input id="current_password" type="password" 
                         class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]" 
                         wire:model="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div>
                <x-label for="password" value="{{ __('Nueva Contraseña') }}" class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic" />
                <x-input id="password" type="password" 
                         class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]" 
                         wire:model="state.password" autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic" />
                <x-input id="password_confirmation" type="password" 
                         class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]" 
                         wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col items-center w-full gap-4 pb-4">
            <x-action-message class="text-[10px] font-black uppercase text-[#D4AF37]" on="saved">
                {{ __('Contraseña actualizada.') }}
            </x-action-message>

            <x-button class="rounded-xl shadow-lg shadow-[#2D1B0F]/10 bg-[#2D1B0F] text-[#D4AF37] hover:scale-105 transition-all duration-300 px-10 py-3 text-[10px] font-black tracking-[0.2em]">
                {{ __('Guardar Contraseña') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section> 