<x-action-section>
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Sesiones del Navegador') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] text-center max-w-md">
                {{ __('Administra y cierra sesión en tus sesiones activas en otros navegadores y dispositivos.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl mx-auto text-sm font-medium text-[#8B7355] text-center mb-8">
            {{ __('Si es necesario, puedes cerrar sesión en todas tus otras sesiones de navegador en todos tus dispositivos. A continuación se enumeran algunas de tus sesiones recientes; sin embargo, esta lista puede no ser exhaustiva.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6 max-w-md mx-auto">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center p-4 bg-[#F5F5F0] rounded-2xl border border-[#D4AF37]/10 shadow-sm">
                        <div class="text-[#D4AF37]">
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="ms-4">
                            <div class="text-[10px] font-black uppercase tracking-widest text-[#2D1B0F]">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Desconocido') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Desconocido') }}
                            </div>

                            <div>
                                <div class="text-[10px] font-bold text-[#8B7355] opacity-75">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-[#D4AF37] font-black italic">{{ __('Este dispositivo') }}</span>
                                    @else
                                        {{ __('Última actividad') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex flex-col items-center mt-10">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled" class="bg-[#2D1B0F] text-[#D4AF37] px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 shadow-lg shadow-[#2D1B0F]/10 transition-all">
                {{ __('Cerrar otras sesiones') }}
            </x-button>

            <x-action-message class="mt-3 text-[10px] font-black text-[#D4AF37] uppercase" on="loggedOut">
                {{ __('Hecho.') }}
            </x-action-message>
        </div>

        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                <div class="flex justify-center w-full">
                    <span class="font-black text-[#2D1B0F] tracking-[0.2em] uppercase text-sm">
                        {{ __('Confirmar Cierre de Sesión') }}
                    </span>
                </div>
            </x-slot>

            <x-slot name="content">
                <p class="font-medium text-[#8B7355] text-center">
                    {{ __('Por favor, introduce tu contraseña para confirmar que deseas cerrar sesión en tus otras sesiones de navegador en todos tus dispositivos.') }}
                </p>

                <div class="mt-6 flex flex-col items-center" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" 
                             class="mt-1 block w-3/4 rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 text-center font-bold"
                             autocomplete="current-password"
                             placeholder="{{ __('Contraseña') }}"
                             x-ref="password"
                             wire:model="password"
                             wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-center w-full gap-3">
                    <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled" class="rounded-xl border-2 border-[#D4AF37]/20 text-[#2D1B0F] font-black text-[9px] uppercase tracking-widest">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-button class="rounded-xl bg-[#2D1B0F] text-[#D4AF37] font-black text-[9px] uppercase tracking-widest px-6"
                                wire:click="logoutOtherBrowserSessions"
                                wire:loading.attr="disabled">
                        {{ __('Cerrar Sesiones') }}
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>