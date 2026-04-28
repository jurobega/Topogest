<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Email') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] max-w-md">
                {{ __('Actualiza tu dirección de correo electrónico.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="form">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 flex flex-col items-center mb-8">
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <label class="text-[10px] font-black uppercase text-[#8B7355] tracking-widest block mb-4 italic" for="photo">
                    {{ __('Foto de Perfil') }}
                </label>

                <div class="flex flex-col items-center gap-6">
                    <div class="relative" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" 
                             class="rounded-[2.5rem] size-32 object-cover border-4 border-[#F5F5F0] shadow-md">
                    </div>

                    <div class="relative" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-[2.5rem] size-32 bg-cover bg-no-repeat bg-center border-4 border-[#D4AF37]"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex flex-col items-center gap-3">
                        <button type="button" 
                                class="bg-[#F5F5F0] text-[#2D1B0F] px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest border border-[#D4AF37]/20 shadow-sm hover:bg-[#D4AF37] hover:text-white transition-all"
                                x-on:click.prevent="$refs.photo.click()">
                            {{ __('Seleccionar Nueva Foto') }}
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" 
                                    class="text-[9px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 transition-colors" 
                                    wire:click="deleteProfilePhoto">
                                {{ __('Eliminar Foto') }}
                            </button>
                        @endif
                    </div>
                </div>
                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4 sm:col-start-2 space-y-6">
           

            <div>
                <x-label for="email" value="{{ __('Correo Electrónico') }}" class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic" />
                <x-input id="email" type="email" 
                         class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]" 
                         wire:model="state.email" required autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-[#F5F5F0] rounded-2xl border border-[#D4AF37]/10 text-center">
                        <p class="text-[10px] font-bold uppercase tracking-tight text-[#8B7355]">
                            {{ __('Tu dirección de correo no está verificada.') }}
                            <button type="button" 
                                    class="block mx-auto mt-1 underline text-[#D4AF37] font-black hover:text-[#2D1B0F] transition-colors" 
                                    wire:click.prevent="sendEmailVerification">
                                {{ __('Haz clic aquí para re-enviar el correo de verificación.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p class="mt-2 font-black text-[9px] uppercase tracking-widest text-[#D4AF37]">
                                {{ __('Un nuevo enlace de verificación ha sido enviado.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col items-center w-full gap-4 pb-4">
            <x-action-message class="text-[10px] font-black uppercase text-[#D4AF37]" on="saved">
                {{ __('Guardado correctamente.') }}
            </x-action-message>

            <x-button class="rounded-xl shadow-lg shadow-[#2D1B0F]/10 bg-[#2D1B0F] text-[#D4AF37] hover:scale-105 transition-all duration-300 px-10 py-3 text-[10px] font-black tracking-[0.2em]">
                {{ __('Guardar Cambios') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>