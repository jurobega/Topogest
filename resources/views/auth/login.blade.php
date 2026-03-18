<x-layouts.guest>
    <div class="min-h-screen bg-[#F0F0EB] flex items-center justify-center p-4 md:p-8">
        
        <div class="w-full max-w-5xl bg-white rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] overflow-hidden flex min-h-[650px] border border-white/20">
            
            <div class="hidden lg:flex w-1/2 bg-[#2D1B0F] relative flex-col items-center justify-center p-12 text-center overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAsNTBDMTAsMzAgNDAsMzAgNTAsNTBTOTAsNzAgMTAwLDUwTTEwMCwyMEM5MCwwIDYwLDAgNTAsMjBTMTAsNDAgMCwyME0wLDgwQzEwLDYwIDQwLDYwIDUwLDgwUzkwLDEwMCAxMDAsODAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI0Q0QUYzNyIgc3Ryb2tlLXdpZHRoPSIwLjUiLz48L3N2Zz4=');">
                </div>

                <div class="relative z-10">
                    <h1 class="text-5xl font-black text-white tracking-tighter italic mb-2">Topo<span class="text-[#D4AF37] not-italic">Gest</span></h1>
                    <div class="h-1 w-12 bg-[#D4AF37] mx-auto mb-6"></div>
                    <p class="text-gray-400 text-sm font-medium leading-relaxed max-w-xs">
                        Bienvenido de nuevo al sistema de gestión topográfica de alta precisión.
                    </p>
                </div>

                <div class="absolute bottom-10 flex gap-2 opacity-30">
                    <div class="w-2 h-2 rounded-full bg-[#D4AF37]"></div>
                    <div class="w-2 h-2 rounded-full bg-white/20"></div>
                    <div class="w-2 h-2 rounded-full bg-white/20"></div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 p-8 md:p-16 flex flex-col justify-center relative">
                
                <div class="mb-10 text-center lg:text-left">
                    <h3 class="text-3xl font-black text-[#2D1B0F] uppercase tracking-tighter">Acceso</h3>
                    <p class="text-[#8B7355] text-[10px] font-bold uppercase tracking-[0.2em] mt-1">Identifícate para continuar</p>
                </div>

                <x-validation-errors class="mb-6 px-4 py-3 bg-red-50 text-red-600 rounded-2xl text-xs font-bold uppercase tracking-wider" />

                @session('status')
                    <div class="mb-6 font-bold text-[10px] uppercase tracking-widest text-green-600 bg-green-50 p-4 rounded-2xl border border-green-100">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest mb-2 block ml-1">Correo Electrónico</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                               class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm placeholder-gray-400 text-sm"
                               placeholder="tu@correo.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 px-1">
                            <label class="text-[10px] font-black text-[#8B7355] uppercase tracking-widest">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a class="text-[9px] font-bold text-[#D4AF37] hover:underline uppercase tracking-tighter" href="{{ route('password.request') }}">
                                    ¿Olvidaste la clave?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="w-full bg-[#F5F5F0] border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-sm placeholder-gray-400 text-sm"
                               placeholder="••••••••">
                    </div>

                    <div class="flex items-center ml-1">
                        <label for="remember_me" class="flex items-center cursor-pointer group">
                            <input id="remember_me" name="remember" type="checkbox" 
                                   class="rounded-md border-none bg-[#F5F5F0] text-[#D4AF37] focus:ring-[#D4AF37] w-5 h-5 shadow-sm transition-all">
                            <span class="ms-3 text-[11px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-[#2D1B0F] transition-colors">Recordar sesión</span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#2D1B0F] text-[#D4AF37] py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl hover:bg-[#1A0F08] transition-all transform hover:scale-[1.02]">
                            Entrar al Sistema
                        </button>
                    </div>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-xs text-gray-400 font-medium">
                        ¿No tienes cuenta todavía? 
                        <a href="{{ route('register') }}" class="text-[#D4AF37] font-black uppercase tracking-tighter ml-1 hover:underline">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <style>
        input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        }
    </style>
</x-layouts.guest>