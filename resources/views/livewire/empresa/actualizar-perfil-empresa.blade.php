<x-form-section submit="guardar">
    <x-slot name="title">
        <div class="flex justify-center w-full pt-4">
            <span
                class="text-[11px] font-black uppercase tracking-[0.3em] text-[#2D1B0F] text-center bg-[#F5F5F0] px-6 py-2 rounded-full border border-[#D4AF37]/10">
                {{ __('Información de la Empresa') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="flex justify-center w-full mt-2 pb-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#8B7355] max-w-md">
                {{ __('Actualiza los datos públicos de tu empresa en el directorio.') }}
            </span>
        </div>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 flex flex-col items-center mb-8">
            <label class="text-[10px] font-black uppercase text-[#8B7355] tracking-widest block mb-4 italic">
                {{ __('Logo de la empresa') }}
            </label>

            <div class="flex flex-col items-center gap-6">
                <div class="relative">
                    @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}"
                            class="rounded-[2.5rem] size-32 object-cover border-4 border-[#D4AF37] shadow-md">
                    @elseif($logoActual)
                        <img src="{{ Storage::url($logoActual) }}"
                            class="rounded-[2.5rem] size-32 object-cover border-4 border-[#F5F5F0] shadow-md">
                    @else
                        <div
                            class="rounded-[2.5rem] size-32 bg-[#F5F5F0] border-4 border-dashed border-[#D4AF37]/20 flex items-center justify-center">
                            <i class="fa-solid fa-building text-[#D4AF37]/40 text-3xl"></i>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col items-center gap-3">
                    <input type="file" id="logo" class="hidden" wire:model="logo" x-ref="logoInput" />
                    <button type="button"
                        class="bg-[#F5F5F0] text-[#2D1B0F] px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest border border-[#D4AF37]/20 shadow-sm hover:bg-[#D4AF37] hover:text-white transition-all"
                        x-on:click.prevent="$refs.logoInput.click()">
                        <i class="fa-solid fa-upload me-2"></i>{{ __('Subir Logo') }}
                    </button>
                </div>
            </div>
            <x-input-error for="logo" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="nombre_fiscal"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-signature me-1"></i> {{ __('Nombre Fiscal') }}
            </x-label>
            <x-input id="nombre_fiscal" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="nombre_fiscal" />
            <x-input-error for="nombre_fiscal" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="nif_cif"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-id-card me-1"></i> {{ __('NIF / CIF') }}
            </x-label>
            <x-input id="nif_cif" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="nif_cif" />
            <x-input-error for="nif_cif" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label for="descripcion"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-align-left me-1"></i> {{ __('Descripción pública') }}
            </x-label>
            <textarea id="descripcion" rows="4"
                class="mt-1 block w-full rounded-[2rem] bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="descripcion"></textarea>
            <x-input-error for="descripcion" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="provincia"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-map-location-dot me-1"></i> {{ __('Provincia') }}
            </x-label>
            <x-input id="provincia" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="provincia" />
            <x-input-error for="provincia" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="telefono"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-phone me-1"></i> {{ __('Teléfono') }}
            </x-label>
            <x-input id="telefono" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="telefono" />
            <x-input-error for="telefono" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="web"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-globe me-1"></i> {{ __('Sitio Web') }}
            </x-label>
            <x-input id="web" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="web" />
            <x-input-error for="web" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="horario_atencion"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-clock me-1"></i> {{ __('Horario de Atención') }}
            </x-label>
            <x-input id="horario_atencion" type="text"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="horario_atencion" />
            <x-input-error for="horario_atencion" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label for="zona_actuacion"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-map-pin me-1"></i> {{ __('Zona de Actuación') }}
            </x-label>
            <textarea id="zona_actuacion" rows="2"
                class="mt-1 block w-full rounded-[2rem] bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="zona_actuacion"></textarea>
            <x-input-error for="zona_actuacion" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="anios_experiencia"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-calendar-check me-1"></i> {{ __('Años de Experiencia') }}
            </x-label>
            <x-input id="anios_experiencia" type="number" min="0"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="anios_experiencia" />
            <x-input-error for="anios_experiencia" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="numero_proyectos"
                class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-2 ms-1 italic">
                <i class="fa-solid fa-list-check me-1"></i> {{ __('Proyectos Completados') }}
            </x-label>
            <x-input id="numero_proyectos" type="number" min="0"
                class="mt-1 block w-full rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 focus:border-[#D4AF37] focus:ring-0 p-4 font-bold text-[#2D1B0F]"
                wire:model="numero_proyectos" />
            <x-input-error for="numero_proyectos" class="mt-2" />
        </div>

        <div class="col-span-6 flex items-center justify-center gap-3 pt-4">
            <x-label for="visible_directorio"
                class="font-black text-[10px] uppercase tracking-widest text-[#2D1B0F] italic"
                value="{{ __('Visible en el directorio público') }}" />
            <input id="visible_directorio" type="checkbox"
                class="size-6 rounded-lg bg-[#F5F5F0] border-2 border-[#D4AF37]/30 text-[#2D1B0F] focus:ring-0 focus:ring-offset-0"
                wire:model="visible_directorio" />
            <x-input-error for="visible_directorio" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-4 ms-1 italic">
                <i class="fa-solid fa-hand-holding-heart me-1"></i> {{ __('Servicios que ofrece') }}
            </x-label>

            <div class="col-span-6">
                <x-label class="font-black text-[10px] uppercase tracking-[0.15em] text-[#8B7355] mb-4 ms-1 italic">
                    <i class="fa-solid fa-hand-holding-heart me-1"></i> {{ __('Servicios que ofrece') }}
                </x-label>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                    @foreach ($servicios as $servicio)
                        <label class="relative group cursor-pointer">
                            <input type="checkbox" wire:model="serviciosSeleccionados" value="{{ $servicio->id }}"
                                class="peer hidden" />

                            <div
                                class="w-full p-4 rounded-2xl bg-[#F5F5F0] border-2 border-[#D4AF37]/10 
                            peer-checked:border-[#D4AF37] peer-checked:bg-white 
                            transition-all duration-300 flex items-center gap-3 shadow-sm
                            group-hover:border-[#D4AF37]/40">

                                <div
                                    class="size-5 shrink-0 rounded-lg border-2 border-[#D4AF37]/20 
                                peer-checked:bg-[#2D1B0F] peer-checked:border-[#2D1B0F] 
                                flex items-center justify-center transition-all duration-300">

                                    <i
                                        class="fa-solid fa-check text-[10px] text-[#D4AF37] opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300"></i>
                                </div>

                                <span
                                    class="text-[10px] font-black text-[#2D1B0F] uppercase tracking-widest leading-tight">
                                    {{ $servicio->nombre }}
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>
                <x-input-error for="serviciosSeleccionados" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col items-center w-full gap-4 pb-4">
            <x-action-message class="text-[10px] font-black uppercase text-[#D4AF37]" on="guardado">
                <i class="fa-solid fa-circle-check me-1"></i> {{ __('Guardado correctamente.') }}
            </x-action-message>

            <x-button
                class="rounded-xl shadow-lg shadow-[#2D1B0F]/10 bg-[#2D1B0F] text-[#D4AF37] hover:scale-105 transition-all duration-300 px-12 py-3 text-[10px] font-black tracking-[0.2em]">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>
