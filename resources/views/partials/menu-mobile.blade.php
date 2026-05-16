<div id="mobileMenuContainer" class="mt-3 h-[60px] relative">
    <section id="mobileMenu" class="absolute left-0 right-0 z-10 transition-all duration-500 ease-in-out px-0">
        <div id="menuCard"
            class="bg-gray-200 border border-transparent rounded-[24px] px-4 py-3 shadow-md transition-all duration-500 ease-in-out">

            <div class="flex gap-2">
                <a href="/#sirata"
                    class="flex-1 text-center px-2 py-1.5 border border-gray-700/30 rounded-full text-[10px] font-bold tracking-wider hover:bg-gray-800 hover:text-white transition-all">
                    SIRATA
                </a>

                <a href="/#manfaat"
                    class="flex-1 text-center px-2 py-1.5 border border-gray-700/30 rounded-full text-[10px] font-bold tracking-wider hover:bg-gray-800 hover:text-white transition-all">
                    MANFAAT
                </a>

                <a href="/#faq"
                    class="flex-1 text-center px-2 py-1.5 border border-gray-700/30 rounded-full text-[10px] font-bold tracking-wider hover:bg-gray-800 hover:text-white transition-all">
                    FAQ
                </a>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menu = document.getElementById('mobileMenu');
        const menuCard = document.getElementById('menuCard');
        const container = document.getElementById('mobileMenuContainer');

        window.addEventListener('scroll', function () {
            const containerRect = container.getBoundingClientRect();

            if (containerRect.top <= 10) {
                if (menu.classList.contains('absolute')) {
                    menu.classList.replace('absolute', 'fixed');
                    menu.classList.add('top-3');
                    menuCard.classList.replace('bg-gray-200', 'bg-white/70');
                    menuCard.classList.add('backdrop-blur-lg', 'border-white/40', 'shadow-2xl', 'scale-95');
                }
            } else {
                if (menu.classList.contains('fixed')) {
                    menu.classList.replace('fixed', 'absolute');
                    menu.classList.remove('top-3');
                    menuCard.classList.replace('bg-white/70', 'bg-gray-200');
                    menuCard.classList.remove('backdrop-blur-lg', 'border-white/40', 'shadow-2xl', 'scale-95');
                }
            }
        });
    });
</script>