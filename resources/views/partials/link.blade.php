<section class="w-full border-t border-b border-[var(--border-color)] bg-[var(--bg-light)]">

    <div
        class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row gap-10 md:gap-6 justify-between items-start">

        <!-- Sosmed -->
        <div class="w-full md:w-auto">

            <h3 class="font-semibold text-[var(--text-dark)] mb-4 tracking-wide">
                Link Sosmed
            </h3>

            <div class="flex gap-3 flex-wrap">

                @forelse($links as $link)

                <a href="{{ $link->url }}" target="_blank"
                    class="group flex items-center px-4 py-2 bg-[var(--primary-color)] border border-[var(--border-color)] rounded-xl text-sm
                    transition-all duration-300 ease-out
                    hover:-translate-y-1 hover:shadow-[var(--shadow-primary)]
                    {{ $link->hover_color }}">

                    <i
                        class="{{ $link->icon_class }} text-[var(--text-light)] text-lg transition-all duration-300 group-hover:rotate-6 group-hover:scale-110"></i>

                    <span
                        class="ml-0 group-hover:ml-2 max-w-0 group-hover:max-w-[120px] opacity-0 group-hover:opacity-100 transition-all duration-300 overflow-hidden whitespace-nowrap">
                        {{ $link->name }}
                    </span>

                </a>

                @empty

                <p class="text-gray-400 text-sm italic">
                    Belum ada link yang disetting
                </p>

                @endforelse

            </div>

        </div>

        <!-- Menu -->
        <div class="w-full md:w-auto md:text-right">

            <h3 class="font-semibold text-[var(--text-dark)] mb-4 tracking-wide">
                Menu Informasi
            </h3>

            <ul class="space-y-3 text-sm">

                <li>
                    <a href="#sirata"
                        class="group inline-flex items-center gap-2 text-gray-500 transition-all duration-300 hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-[var(--primary-color)]">
                            FORM SIRATA
                        </span>

                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--primary-color)] opacity-0 group-hover:opacity-100 transition"></span>

                    </a>
                </li>

                <li>
                    <a href="#manfaat"
                        class="group inline-flex items-center gap-2 text-gray-500 transition-all duration-300 hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-[var(--primary-color)]">
                            MANFAAT
                        </span>

                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--primary-color)] opacity-0 group-hover:opacity-100 transition"></span>

                    </a>
                </li>

                <li>
                    <a href="#faq"
                        class="group inline-flex items-center gap-2 text-gray-500 transition-all duration-300 hover:translate-x-1">

                        <span class="transition-all duration-300 group-hover:text-[var(--primary-color)]">
                            FAQ
                        </span>

                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--primary-color)] opacity-0 group-hover:opacity-100 transition"></span>

                    </a>
                </li>

            </ul>

        </div>

    </div>

</section>