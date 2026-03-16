<div x-data="{ open:false }">

    <!-- BUTTON -->
    <div x-show="!open" class="fixed right-0 top-1/2 -translate-y-1/2 z-50">

        <div @click="open = true" class="bg-green-500 text-white 
        px-4 py-2
        hover:px-6
        rounded-r-3xl rotate-180 cursor-pointer
        border-r-8 border-t-8 border-b-8 border-white
        transition-all duration-300" style="writing-mode: vertical-rl;">
            Kirim Pesan
        </div>

    </div>

    <!-- CHAT BOX -->
    <div x-show="open" x-cloak x-transition:enter="transition-all duration-300 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-all duration-300 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 h-screen w-[360px] 
        bg-gray-200 shadow-2xl z-50 flex flex-col">

        <!-- HEADER -->
        <div class="bg-black text-white p-4 flex items-center gap-3">

            <button @click="open=false" class="text-white hover:text-gray-300 transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>

            <span class="font-semibold text-lg">
                ChatBot/Admin Message
            </span>

        </div>


        <!-- CHAT BODY -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4">

            <div class="bg-white p-3 rounded-2xl w-fit max-w-[70%]">
                Halo Saya Mau bertanya...
                <div class="text-xs text-gray-500 text-right mt-1">12.00</div>
            </div>

            <div class="bg-white p-3 rounded-2xl w-fit max-w-[70%] ml-auto">
                Halo Saya Mau bertanya...
                <div class="text-xs text-gray-500 text-right mt-1">12.00</div>
            </div>

        </div>


        <!-- INPUT -->
        <div class="p-4 flex items-end gap-2">

            <textarea rows="1" placeholder="Masukan Pesan Anda..."
                oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'" class="flex-1 rounded-2xl px-4 py-2 outline-none
                    bg-white border border-gray-300
                    focus:ring-2 focus:ring-gray-400
                    resize-none overflow-y-auto max-h-32"></textarea>

            <button class="bg-white rounded-full w-10 h-10 flex items-center justify-center
                cursor-pointer text-gray-700 hover:bg-green-500 hover:text-white
                active:scale-90 transition">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12
                        59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />

                </svg>

            </button>

        </div>

    </div>

</div>