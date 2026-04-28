<x-action-section>
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Eliminar Cuenta') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] max-w-md">
                {{ __('Borrar permanentemente tu cuenta y todos sus datos.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl mx-auto text-sm font-medium tracking-tight text-[#8B7355] text-center">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán de forma permanente. Antes de proceder, por favor descarga cualquier información que desees conservar.') }}
        </div>

        <div class="mt-8 flex justify-center">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled" class="rounded-xl shadow-lg shadow-red-900/10 hover:scale-105 transition-all duration-300 font-black text-[10px] uppercase tracking-[0.2em] px-8 py-3">
                {{ __('Eliminar Cuenta') }}
            </x-danger-button>
        </div>

        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                <div class="flex justify-center w-full">
                    <span class="font-black text-[#2D1B0F] tracking-[0.2em] uppercase text-sm">
                        {{ __('Confirmar Eliminación') }}
                    </span>
                </div>
            </x-slot>

            <x-slot name="content">
                <p class="font-medium text-[#8B7355] text-center">
                    {{ __('¿Estás seguro de que quieres eliminar tu cuenta? Por favor, introduce tu contraseña para confirmar que deseas eliminar permanentemente todos tus datos.') }}
                </p>

                <div class="mt-6 flex flex-col items-center" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" 
                                class="mt-1 block w-3/4 rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 text-center font-bold"
                                autocomplete="current-password"
                                placeholder="{{ __('Contraseña') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-center w-full gap-3">
                    <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" class="rounded-xl border-2 border-[#D4AF37]/20 text-[#2D1B0F] font-black text-[9px] uppercase tracking-widest">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="rounded-xl shadow-lg font-black text-[9px] uppercase tracking-widest px-6" 
                                     wire:click="deleteUser" 
                                     wire:loading.attr="disabled">
                        {{ __('Eliminar Cuenta') }}
                    </x-danger-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>