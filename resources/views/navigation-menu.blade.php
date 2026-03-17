<div>
    <nav x-data="{ open: false }" class="fixed left-0 top-0 h-screen w-64 bg-[#2D1B0F] text-white flex flex-col shadow-2xl z-50">
        <div class="shrink-0 flex items-center justify-center h-24 border-b border-[#3D2B1F]">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center">
                <x-application-mark class="block h-10 w-auto text-[#D4AF37] fill-current" />
                <span class="mt-2 text-xs font-bold tracking-[0.2em] uppercase text-[#D4AF37]">TopoGest</span>
            </a>
        </div>

        <div class="flex-grow px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
            <p class="text-[10px] uppercase tracking-widest text-[#8B7355] mb-4 px-2">Menú Principal</p>
            
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" 
                class="flex items-center px-4 py-3 text-sm rounded-xl transition-all duration-200 hover:bg-[#3D2B1F] group border-none !text-gray-300 hover:!text-white">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-[#D4AF37]' : 'text-[#8B7355]' }} group-hover:text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('servicios.index') }}" :active="request()->routeIs('servicios.index')" 
                class="flex items-center px-4 py-3 text-sm rounded-xl transition-all duration-200 hover:bg-[#3D2B1F] group border-none !text-gray-300 hover:!text-white">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-[#D4AF37]' : 'text-[#8B7355]' }} group-hover:text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Servicios
            </x-nav-link>   

            {{-- Aquí irán tus futuros links de Clientes y Proyectos --}}
        </div>

        <div class="p-4 border-t border-[#3D2B1F] bg-[#24150A]">
            @auth
                {{-- VISTA PARA USUARIO LOGUEADO --}}
                <div class="flex items-center px-2 mb-4 text-left">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-9 w-9 rounded-full border-2 border-[#D4AF37] object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                    <div class="ml-3 overflow-hidden">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-[#8B7355] truncate">Acceso Autorizado</p>
                    </div>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-2 text-[11px] text-[#8B7355] hover:text-[#D4AF37] transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Mi Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" @click.prevent="$root.submit();" class="w-full flex items-center px-3 py-2 text-[11px] text-[#8B7355] hover:text-red-400 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            @else
                {{-- VISTA PARA INVITADOS (Login / Register) --}}
                <div class="space-y-2 p-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-xs font-bold text-[#D4AF37] border border-[#D4AF37] rounded-lg hover:bg-[#D4AF37] hover:text-[#2D1B0F] transition duration-200">
                        {{ __('ENTRAR') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 text-xs font-bold text-white bg-[#3D2B1F] rounded-lg hover:bg-[#4D3B2F] transition duration-200">
                            {{ __('REGISTRARSE') }}
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </nav>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #3D2B1F; border-radius: 10px; }
        
        /* Corregir estilos de x-nav-link para que no hereden el subrayado de Jetstream */
        nav a { text-decoration: none !important; }
    </style>
</div>