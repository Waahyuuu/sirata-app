<div class="w-full border-t border-b bg-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-start">

        {{-- Link Sosmed --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-3">Link Sosmed</h3>

            <div class="flex gap-2 flex-wrap">

                @forelse($links as $link)
                <a href="{{ $link->url }}" target="_blank" class="group flex items-center px-3 py-1 bg-white border rounded-md text-sm 
                    transition-all duration-300 ease-out
                    hover:scale-105 hover:shadow-lg
                    {{ $link->hover_color }}">

                    <i
                        class="{{ $link->icon_class }} text-lg transition-all duration-300 group-hover:rotate-6 group-hover:scale-110"></i>

                    <span class="ml-0 group-hover:ml-2 max-w-0 group-hover:max-w-[120px] opacity-0 group-hover:opacity-100 
                        transition-all duration-300 overflow-hidden whitespace-nowrap">
                        {{ $link->name }}
                    </span>

                </a>
                @empty
                <p class="text-gray-400 text-sm italic">Belum ada link yang disetting</p>
                @endforelse

            </div>
        </div>

        {{-- Link Menu --}}
        <div class="text-right">
            <h3 class="font-semibold text-gray-800 mb-4 tracking-wide">
                Menu Informasi
            </h3>

            <ul class="space-y-2 text-sm">

                <li>
                    <a href="#sirata" class="group inline-flex items-center gap-2 text-gray-500
                        transition-all duration-300 ease-out
                        hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-gray-900">
                            FORM SIRATA
                        </span>

                        <span class="dot"></span>
                    </a>
                </li>

                <li>
                    <a href="#manfaat" class="group inline-flex items-center gap-2 text-gray-500
                        transition-all duration-300 ease-out
                        hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-gray-900">
                            MANFAAT
                        </span>

                        <span class="dot"></span>
                    </a>
                </li>

                <li>
                    <a href="#faq" class="group inline-flex items-center gap-2 text-gray-500
                        transition-all duration-300 ease-out
                        hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-gray-900">
                            FAQ
                        </span>

                        <span class="dot"></span>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</div>