<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-center w-full">
            <h2 class="font-black text-2xl text-[#2D1B0F] leading-tight uppercase tracking-[0.3em]">
                {{ __('Perfil de Usuario') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-[#F5F5F0]/50 min-h-screen">
        <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
            @if(auth()->user()->role === 'empresa')
                <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                    @livewire('empresa.actualizar-perfil-empresa')
                </div>
            @elseif(auth()->user()->role === 'cliente')
                <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                    @livewire('cliente.actualizar-perfil-cliente')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                    @livewire('profile.update-profile-information-form')
                </div>
            @endif



            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-[#D4AF37]/10 p-2 mb-12">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="mt-12 sm:mt-0 bg-white rounded-[2.5rem] shadow-sm border border-red-100 p-2">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>