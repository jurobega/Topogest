<nav x-data="{ open: false }"
    class="fixed left-0 top-0 h-screen w-64 bg-[#2D1B0F] text-white flex flex-col shadow-2xl z-50">

    <div class="shrink-0 flex items-center justify-center h-24 border-b border-[#3D2B1F]">
        @auth
            <a href="{{ Auth::user()->dashboardRoute() }}" class="flex flex-col items-center group">
                <x-application-mark
                    class="block h-10 w-auto text-[#D4AF37] fill-current transition-transform group-hover:scale-110" />
                <span class="mt-2 text-xs font-black tracking-[0.3em] uppercase text-[#D4AF37]">TopoGest</span>
            </a>
        @else
            <a href="{{ url('/') }}" class="flex flex-col items-center group">
                <x-application-mark
                    class="block h-10 w-auto text-[#D4AF37] fill-current transition-transform group-hover:scale-110" />
                <span class="mt-2 text-xs font-black tracking-[0.3em] uppercase text-[#D4AF37]">TopoGest</span>
            </a>
        @endauth
    </div>

    <div class="flex-grow px-4 py-6 space-y-3 overflow-y-auto custom-scrollbar flex flex-col">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[#8B7355] mb-2 px-4">Menú Principal</p>

        <x-nav-link href="{{ route('inicio') }}" :active="request()->routeIs('inicio')"
            class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('inicio') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">
            <i
                class="fa-solid fa-house mr-3 text-lg {{ request()->routeIs('inicio') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>
            <span class="uppercase tracking-widest text-[11px]">Inicio</span>
        </x-nav-link>

        @auth
            @if (Auth::user()->role == 'cliente')
            <x-nav-link href="{{ Auth::user()->dashboardRoute() }}" :active="request()->routeIs('*.dashboard')"
                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('*.dashboard') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">
                <i
                    class="fa-solid fa-chart-pie mr-3 text-lg {{ request()->routeIs('*.dashboard') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>
                <span class="uppercase tracking-widest text-[11px]">Panel de Control</span>
            </x-nav-link>
            <x-nav-link href="{{ route('cliente.solicitudes.index') }}" :active="request()->routeIs('cliente.solicitudes.*')"
                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('cliente.solicitudes.*') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">

                <i
                    class="fa-solid fa-file-lines mr-3 text-lg {{ request()->routeIs('cliente.solicitudes.*') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>

                <span class="uppercase tracking-widest text-[11px]">Solicitudes</span>
            </x-nav-link>
            <x-nav-link href="{{ route('cliente.proyectos.index') }}" :active="request()->routeIs('cliente.proyectos.*')"
                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('cliente.proyectos.*') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">

               <i class="fa-solid fa-map-location-dot mr-3 text-lg {{ request()->routeIs('cliente.proyectos.*') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>
                <span class="uppercase tracking-widest text-[11px]">Proyectos</span>
            </x-nav-link>
            @endif

            @if (Auth::user()->role == 'empresa')
                <x-nav-link href="{{ Auth::user()->dashboardRoute() }}" :active="request()->routeIs('*.dashboard')"
                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('*.dashboard') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">
                <i
                    class="fa-solid fa-chart-pie mr-3 text-lg {{ request()->routeIs('*.dashboard') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>
                <span class="uppercase tracking-widest text-[11px]">Panel de Control</span>
            </x-nav-link>
            <x-nav-link href="{{ route('empresa.solicitudes.index') }}" :active="request()->routeIs('empresa.solicitudes.*')"
                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('empresa.solicitudes.*') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">

                <i
                    class="fa-solid fa-file-lines mr-3 text-lg {{ request()->routeIs('empresa.solicitudes.*') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>

                <span class="uppercase tracking-widest text-[11px]">Solicitudes</span>
            </x-nav-link>
            @endif

            @if (Auth::user()->role == 'admin')
                <div class="pt-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[#8B7355] mb-2 px-4">Administración</p>
                    <x-nav-link href="{{ route('admin.servicios.index') }}" :active="request()->routeIs('admin.servicios.*')"
                        class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition-all duration-200 group border-none {{ request()->routeIs('admin.servicios.*') ? 'bg-[#3D2B1F] !text-white' : '!text-gray-400 hover:bg-[#3D2B1F]/50 hover:!text-white' }}">
                        <i
                            class="fa-solid fa-gears mr-3 text-lg {{ request()->routeIs('admin.servicios.*') ? 'text-[#D4AF37]' : 'text-[#8B7355] group-hover:text-[#D4AF37]' }}"></i>
                        <span class="uppercase tracking-widest text-[11px]">Servicios</span>
                    </x-nav-link>
                </div>
            @endif
        @endauth
    </div>

    <div class="p-4 border-t border-[#3D2B1F] bg-[#24150A]">
        @auth
            <div class="flex items-center px-2 mb-4 text-left">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="h-10 w-10 rounded-xl border-2 border-[#D4AF37]/30 object-cover"
                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @else
                    <div
                        class="h-10 w-10 rounded-xl bg-[#3D2B1F] flex items-center justify-center text-[#D4AF37] font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-black text-white truncate uppercase tracking-tighter">{{ Auth::user()->name }}
                    </p>
                    <p class="text-[9px] font-bold text-[#8B7355] uppercase tracking-widest">Sistemas OK</p>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.show') }}"
                    class="flex items-center px-3 py-2 text-[10px] font-bold text-[#8B7355] uppercase tracking-widest hover:text-[#D4AF37] transition-colors group">
                    <i class="fa-solid fa-user-gear mr-2 transition-transform group-hover:scale-110"></i>
                    Ajustes Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" @click.prevent="$root.submit();"
                        class="w-full flex items-center px-3 py-2 text-[10px] font-bold text-[#8B7355] uppercase tracking-widest hover:text-red-400 transition-colors group">
                        <i class="fa-solid fa-power-off mr-2 transition-transform group-hover:scale-110"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        @else
            <div class="space-y-2 p-2">
                <a href="{{ route('login') }}"
                    class="block w-full text-center px-4 py-3 text-[10px] font-black text-[#D4AF37] border-2 border-[#D4AF37] rounded-xl hover:bg-[#D4AF37] hover:text-[#2D1B0F] transition duration-300 uppercase tracking-[0.2em]">
                    {{ __('Entrar') }}
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-4 py-3 text-[10px] font-black text-white bg-[#3D2B1F] rounded-xl hover:bg-[#4D3B2F] transition duration-300 uppercase tracking-[0.2em]">
                        {{ __('Registro') }}
                    </a>
                @endif
            </div>
        @endauth
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3D2B1F;
            border-radius: 10px;
        }

        /* Eliminar estilos molestos de Jetstream */
        nav a {
            text-decoration: none !important;
        }
    </style>
</nav>
