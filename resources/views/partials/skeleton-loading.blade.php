<div id="skeleton" class="px-6 pt-6 max-w-8xl mx-auto animate-pulse">

    {{-- HERO UTAMA --}}
    <section class="hidden md:block">
        <div class="bg-gray-200 rounded-[30px] 
        px-6 md:px-8 xl:px-16 
        py-8 md:py-10 xl:py-14 
        md:min-h-[380px] lg:min-h-[465px] xl:min-h-[500px] 
        flex justify-between items-start gap-6 md:gap-8 xl:gap-10 overflow-hidden">

            <div class="max-w-md lg:max-w-lg xl:max-w-xl md:pt-0 lg:pt-5 xl:pt-3">
                <div class="h-5 md:h-6 xl:h-7 w-48 bg-gray-300 rounded mb-3 md:mb-4"></div>
                <div class="space-y-3 mt-3 md:mt-4">
                    <div class="h-10 md:h-12 lg:h-14 xl:h-20 w-[280px] md:w-[350px] xl:w-[500px] bg-gray-300 rounded">
                    </div>
                    <div class="h-10 md:h-12 lg:h-14 xl:h-20 w-[180px] md:w-[250px] xl:w-[350px] bg-gray-300 rounded">
                    </div>
                </div>

                <div class="mt-4 md:mt-6 space-y-2">
                    <div class="h-4 md:h-5 xl:h-6 w-full max-w-lg bg-gray-300 rounded"></div>
                    <div class="h-4 md:h-5 xl:h-6 w-5/6 max-w-lg bg-gray-300 rounded"></div>
                </div>

            </div>

            <div class="flex-shrink-0 pt-1 md:pt-2">
                <div class="w-[160px] md:w-[220px] lg:w-[320px] xl:w-[420px] aspect-[4/3] bg-gray-300 rounded-2xl">
                </div>
            </div>

        </div>
    </section>

    {{-- HERO MOBILE --}}
    <section class="md:hidden">
        <div class="bg-gray-200 rounded-[30px] 
        px-8 py-10 
        min-h-[450px] 
        flex flex-col justify-between items-start overflow-hidden">

            <div class="w-full text-left">
                <div class="h-3 w-32 bg-gray-300 rounded mb-4 animate-pulse"></div>

                <div class="space-y-2 mt-3">
                    <div class="h-8 w-56 bg-gray-300 rounded"></div>
                    <div class="h-8 w-40 bg-gray-300 rounded"></div>
                </div>

                <div class="mt-4 space-y-2 max-w-[260px]">
                    <div class="h-3.5 w-full bg-gray-300 rounded"></div>
                    <div class="h-3.5 w-full bg-gray-300 rounded"></div>
                    <div class="h-3.5 w-3/4 bg-gray-300 rounded"></div>
                </div>
            </div>

            <div class="w-full flex justify-center mt-10">
                <div class="w-48 h-36 bg-gray-300 rounded-2xl shadow-sm"></div>
            </div>

        </div>
    </section>

    {{-- MENU UTAMA --}}
    <section class="hidden md:block -mt-25 relative z-10 animate-pulse">
        <div class="menu-wrapper relative bg-white rounded-tr-[45px] py-3.5 pr-4 pl-0 pb-0 w-fit">

            <div class="bg-gray-200 rounded-[30px] px-12 py-6">

                <div class="flex gap-10">

                    <div class="w-28 h-10 bg-gray-300 rounded-full"></div>
                    <div class="w-32 h-10 bg-gray-300 rounded-full"></div>
                    <div class="w-24 h-10 bg-gray-300 rounded-full"></div>

                </div>

            </div>
        </div>
    </section>

    {{-- MENU MOBILE --}}
    <section class="md:hidden mt-3 h-[60px] relative">
        <section class="absolute left-0 right-0 z-10 px-0">
            <div
                class="bg-gray-200 border border-transparent rounded-[24px] px-4 py-3 shadow-md flex justify-center gap-4">

                <div class="px-4 py-1.5 w-20 h-6 bg-gray-300 rounded-full animate-pulse"></div>
                <div class="px-4 py-1.5 w-24 h-6 bg-gray-300 rounded-full animate-pulse"></div>
                <div class="px-4 py-1.5 w-16 h-6 bg-gray-300 rounded-full animate-pulse"></div>

            </div>
        </section>
    </section>

    {{-- FORM --}}
    <section class="min-h-screen flex items-center justify-center bg-white px-4">

        <div class="w-full max-w-xl">

            <div class="h-14 w-64 bg-gray-300 rounded mx-auto mb-4"></div>

            <div class="space-y-2 mb-8">
                <div class="h-4 w-3/4 bg-gray-300 rounded mx-auto"></div>
                <div class="h-4 w-2/3 bg-gray-300 rounded mx-auto"></div>
            </div>

            <div class="space-y-5">

                <div>
                    <div class="h-4 w-40 bg-gray-300 rounded mb-2"></div>
                    <div class="h-10 w-full bg-gray-200 rounded-md"></div>
                </div>

                <div>
                    <div class="h-4 w-48 bg-gray-300 rounded mb-2"></div>
                    <div class="h-10 w-full bg-gray-200 rounded-md"></div>
                </div>

                <div>
                    <div class="h-4 w-36 bg-gray-300 rounded mb-2"></div>
                    <div class="h-10 w-full bg-gray-200 rounded-md"></div>
                </div>

                <div class="h-10 w-full bg-gray-300 rounded-md"></div>

            </div>

        </div>

    </section>

    {{-- MANFAAT --}}
    <section class="py-24 bg-white px-4 animate-pulse">

        <div class="max-w-6xl mx-auto text-center">

            <div class="h-6 w-64 bg-gray-300 rounded mx-auto mb-16"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                @php
                $total = count($manfaats) > 0 ? count($manfaats) : 6;
                @endphp

                @for($i = 0; $i < $total; $i++) <div
                    class="bg-gray-100 rounded-2xl p-8 min-h-[260px] flex flex-col items-center text-center">

                    <div class="w-24 h-24 bg-gray-300 rounded mb-6"></div>
                    <div class="h-4 w-32 bg-gray-300 rounded mb-3"></div>
                    <div class="space-y-2">
                        <div class="h-3 w-40 bg-gray-300 rounded"></div>
                        <div class="h-3 w-36 bg-gray-300 rounded"></div>
                        <div class="h-3 w-28 bg-gray-300 rounded"></div>
                    </div>

            </div>
            @endfor

        </div>

    </section>

    {{-- FAQ --}}
    <section class="py-24 bg-white px-6 animate-pulse">

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">

            <div class="text-center flex flex-col items-center">

                <div class="h-6 w-72 bg-gray-300 rounded mb-8 mx-auto"></div>

                <div class="w-full max-w-md h-72 bg-gray-200 rounded-lg mx-auto"></div>

            </div>

            <div id="skeleton-faq" class="space-y-4 animate-pulse">
                @php $faqCount = $faqs->count() ?: 4; @endphp
                @for ($i = 0; $i < $faqCount; $i++) <div class="border rounded-xl bg-white px-4 py-4">
                    <div class="h-4 w-3/4 bg-gray-300 rounded mb-2"></div>
                    <div class="h-3 w-5/6 bg-gray-200 rounded"></div>
            </div>
            @endfor
        </div>

    </section>

</div>

<div id="skeleton-footer" class="max-w-8xl mx-auto animate-pulse">

    {{-- LINK --}}
    <section class="w-full border-t border-b bg-gray-100 py-6">

        <div class="max-w-7xl mx-auto px-6 flex justify-between items-start">

            <div>
                <div class="h-4 w-28 bg-gray-300 rounded mb-3 animate-pulse"></div>

                <div class="flex gap-2">
                    @for ($i = 0; $i < max($links->count(), 3); $i++)
                        <div class="w-16 h-7 bg-gray-300 rounded animate-pulse"></div>
                        @endfor
                </div>
            </div>

            <div class="text-right space-y-2">

                <div class="h-4 w-16 bg-gray-300 rounded ml-auto mb-3"></div>

                <div class="h-3 w-24 bg-gray-300 rounded ml-auto"></div>
                <div class="h-3 w-32 bg-gray-300 rounded ml-auto"></div>
                <div class="h-3 w-36 bg-gray-300 rounded ml-auto"></div>

            </div>

        </div>

    </section>

    {{-- FOOTER --}}
    <footer class="w-full bg-gray-100">

        <div class="max-w-7xl mx-auto py-4 flex justify-center">

            <div class="h-3 w-64 bg-gray-300 rounded"></div>

        </div>

    </footer>
</div>