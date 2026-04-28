<x-action-section>
   <x-slot name="title">
    <div class="flex justify-center w-full pt-4">
        <span class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
            {{ __('Autenticación de Dos Factores') }}
        </span>
    </div>
</x-slot>

<x-slot name="description">
    <div class="flex justify-center w-full mt-2 pb-4">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] text-center max-w-md">
            {{ __('Añade seguridad adicional a tu cuenta mediante la autenticación de dos factores.') }}
        </span>
    </div>
</x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-black text-[#2D1B0F] tracking-tight">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Termina de habilitar la autenticación de dos factores.') }}
                @else
                    {{ __('Has habilitado la autenticación de dos factores.') }}
                @endif
            @else
                {{ __('No has habilitado la autenticación de dos factores.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm font-medium text-[#8B7355]">
            <p>
                {{ __('Cuando la autenticación de dos factores está habilitada, se te solicitará un token seguro y aleatorio durante la autenticación. Puedes recuperar este token desde la aplicación Google Authenticator de tu teléfono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm font-bold text-[#2D1B0F] p-4 bg-[#F5F5F0] rounded-2xl border-2 border-[#D4AF37]/20">
                    <p class="mb-4">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticación de dos factores, escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración y proporciona el código OTP generado.') }}
                        @else
                            {{ __('La autenticación de dos factores ya está habilitada. Escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración.') }}
                        @endif
                    </p>

                    <div class="inline-block p-2 bg-white rounded-2xl border-2 border-[#D4AF37]/30 shadow-sm">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <div class="mt-4 max-w-xl text-sm font-bold text-[#2D1B0F]">
                        <p>
                            {{ __('Clave de configuración') }}: {{ decrypt($this->user->two_factor_secret) }}
                        </p>
                    </div>

                    @if ($showingConfirmation)
                        <div class="mt-4">
                            <x-label for="code" value="{{ __('Código') }}" class="text-[9px] font-black uppercase text-[#8B7355] tracking-widest italic" />
                            <x-input id="code" type="text" name="code" class="block mt-1 w-1/2 bg-white border-2 border-[#D4AF37]/10 focus:border-[#07CBBB] rounded-2xl" inputmode="numeric" autofocus autocomplete="one-time-code"
                                wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication" />
                            <x-input-error for="code" class="mt-2" />
                        </div>
                    @endif
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm font-bold text-[#2D1B0F] p-4 bg-[#F5F5F0] rounded-2xl border-2 border-[#D4AF37]/20">
                    <p class="mb-4">
                        {{ __('Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Pueden ser utilizados para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación.') }}
                    </p>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-xs bg-white rounded-xl border border-[#D4AF37]/20 text-[#2D1B0F]">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="mt-8">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled" class="bg-[#2D1B0F] text-[#D4AF37] px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 shadow-lg shadow-[#2D1B0F]/10 transition-all">
                        {{ __('Habilitar') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3 rounded-xl border-2 border-[#D4AF37]/30 text-[#2D1B0F] font-black text-[9px] uppercase tracking-widest">
                            {{ __('Regenerar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif (! $showingConfirmation)
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3 rounded-xl border-2 border-[#D4AF37]/30 text-[#2D1B0F] font-black text-[9px] uppercase tracking-widest">
                            {{ __('Mostrar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3 bg-[#2D1B0F] text-[#D4AF37] rounded-xl text-[10px] font-black uppercase tracking-[0.2em]" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled" class="rounded-xl font-black text-[9px] uppercase tracking-widest">
                            {{ __('Deshabilitar') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled" class="rounded-xl border-2 border-[#D4AF37]/30 text-[#2D1B0F] font-black text-[9px] uppercase tracking-widest">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>