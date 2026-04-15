<div
    class="flex flex-col items-center justify-center text-center bg-white rounded-[40px] p-16 shadow-sm border border-gray-100 group transition-all duration-500 hover:border-[#D4AF37]/20 hover:shadow-lg hover:shadow-[#D4AF37]/5">

    <div class="relative mb-8">
        <div
            class="w-24 h-24 bg-[#F5F5F0] rounded-full flex items-center justify-center transition-transform duration-700 group-hover:scale-110 group-hover:bg-[#2D1B0F]">
            <i
                class="fa-solid fa-envelope-open-text text-4xl text-gray-300 transition-colors duration-500 group-hover:text-[#D4AF37]"></i>
        </div>
        <div
            class="absolute top-0 right-0 w-6 h-6 bg-white rounded-full border-4 border-[#F5F5F0] group-hover:border-[#2D1B0F] transition-colors duration-500">
        </div>
    </div>

    <p
        class="text-[10px] font-medium text-[#8B7355] italic leading-relaxed max-w-xs uppercase tracking-widest opacity-80">
        {{ $slot }}
    </p>

    <div class="h-[1px] w-12 bg-gray-100 mt-10 transition-all duration-700 group-hover:w-24 group-hover:bg-[#D4AF37]/30">
    </div>
</div>
