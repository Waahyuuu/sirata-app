<div x-data="chatBox()" x-init="init()">

    <!-- BUTTON -->
    <div x-show="!open" class="fixed right-0 top-1/2 -translate-y-1/2 z-50">
        <div @click="open = true" class="bg-green-500 text-white cursor-pointer border-white transition-all duration-300

            /* Mobile Style */
            px-3 py-1.5 text-xs rounded-r-2xl border-r-4 border-t-4 border-b-4

            /* Utama Style */
            md:px-4 md:py-2 md:text-base md:rounded-r-3xl md:border-r-8 md:border-t-8 md:border-b-8 md:hover:px-6"
            style="writing-mode: vertical-rl; transform: rotate(180deg);">
            <span class="md:inline hidden">Kirim Pesan</span>
            <span class="md:hidden inline">Kirim Pesan</span>
        </div>
    </div>

    <!-- CHAT BOX -->
    <div x-show="open" x-cloak x-transition:enter="transition-all duration-500 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-all duration-400 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 h-screen z-50 flex flex-col bg-gray-100 shadow-2xl
        /* Full screen di mobile, fixed width di desktop */
        w-full md:w-[360px]">

        <!-- HEADER -->
        <div class="bg-black text-white p-4 flex items-center gap-3">
            <button @click="open=false" class="p-1 hover:bg-gray-800 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <span class="font-semibold text-lg">Admin Message</span>
        </div>

        <!-- BODY -->
        <div x-ref="chatBody" class="chat-body flex-1 p-4 overflow-y-auto bg-[#f0f2f5]">

            <!-- EMPTY STATE -->
            <div x-show="messages.length === 0" class="h-full flex flex-col items-center justify-center text-gray-400">
                <div class="bg-white p-6 rounded-full mb-4 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="font-semibold">Belum ada pesan</p>
                <p class="text-sm">Mulai chat dengan admin 👇</p>
            </div>

            <!-- CHAT CONTENT -->
            <div class="space-y-4" x-show="messages.length > 0">
                <template x-for="(msg, index) in messages" :key="msg.id">
                    <div class="flex message-item" :style="`animation-delay:${index*0.05}s`"
                        :class="msg.from === 'user' ? 'justify-end' : 'justify-start'">

                        <div class="chat-bubble px-4 py-2 rounded-2xl max-w-[85%] md:max-w-[75%] shadow-sm text-sm"
                            :class="msg.from === 'user'
                                ? 'bg-green-500 text-white rounded-br-none'
                                : 'bg-white text-gray-800 rounded-bl-none'">

                            <div class="whitespace-pre-line" x-text="msg.text"></div>
                            <div class="text-[10px] opacity-70 text-right mt-1" x-text="msg.time"></div>
                        </div>
                    </div>
                </template>

                <!-- TYPING INDICATOR -->
                <div x-show="typing" class="flex">
                    <div class="bg-white px-4 py-3 rounded-2xl rounded-bl-none shadow-sm">
                        <div class="flex gap-1.5">
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- INPUT AREA -->
        <div class="p-3 pb-6 md:pb-3 flex gap-2 bg-white border-t items-end">
            <textarea x-ref="input" x-model="message" @keydown.enter.prevent="send()" rows="1"
                placeholder="Tulis pesan..." @input="autoResize"
                class="flex-1 rounded-2xl px-4 py-2.5 bg-gray-100 border-none focus:ring-2 focus:ring-green-400 resize-none max-h-[120px] text-sm">
            </textarea>

            <button @click="send()"
                class="bg-green-500 w-11 h-11 flex items-center justify-center text-white rounded-full hover:bg-green-600 transition-colors shadow-md shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    .chat-body::-webkit-scrollbar {
        width: 6px;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }

    .chat-bubble {
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    @keyframes messageIn {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-item {
        animation: messageIn 0.3s ease;
    }

    @keyframes typingBounce {

        0%,
        80%,
        100% {
            transform: translateY(0);
            opacity: .5;
        }

        40% {
            transform: translateY(-6px);
            opacity: 1;
        }
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        background: #9CA3AF;
        border-radius: 9999px;
        animation: typingBounce 1.2s infinite;
    }

    .typing-dot:nth-child(2) {
        animation-delay: .2s
    }

    .typing-dot:nth-child(3) {
        animation-delay: .4s
    }
</style>

<script>
    function chatBox(){
        return {

            open:false,
            message:'',
            typing:false,
            messages:[],
            client_id:null,
            last_id:0,
            interval:null,

            init(){

                let id = sessionStorage.getItem('client_id')

                if(!id){
                    id = 'user-' + Math.random().toString(36).substr(2,9)
                    sessionStorage.setItem('client_id', id)
                }

                this.client_id = id

                let saved = sessionStorage.getItem('chat_'+id)
                if(saved){
                    this.messages = JSON.parse(saved)
                    this.last_id = this.messages.length
                        ? this.messages[this.messages.length-1].id
                        : 0
                }

                this.loadMessages(true)

                this.interval = setInterval(() => {
                    this.loadMessages()
                }, 10000)
            },

            async loadMessages(force=false){

                let res = await fetch(`/chatbot/messages?client_id=${this.client_id}&last_id=${this.last_id}`)
                let data = await res.json()

                if(data.length > 0){

                    data.forEach(msg => {
                        if(!this.messages.find(m => m.id === msg.id)){
                            this.messages.push(msg)
                        }
                    })

                    this.last_id = data[data.length - 1].id
                    sessionStorage.setItem('chat_'+this.client_id, JSON.stringify(this.messages))

                    this.scrollBottom()
                }

                if(force) this.scrollBottom()
            },

            autoResize(){
                let el = this.$refs.input
                el.style.height = 'auto'
                el.style.height = el.scrollHeight + 'px'
            },

            async send(){

                if(!this.message.trim()) return

                let text = this.message
                this.message = ''
                this.typing = true

                await fetch('/chatbot', {
                    method:'POST',
                    headers:{
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message:text,
                        client_id:this.client_id
                    })
                })

                this.typing = false
                this.$refs.input.style.height = 'auto'
                this.loadMessages(true)
            },

            scrollBottom(){
                this.$nextTick(()=>{
                    let el = this.$refs.chatBody
                    if(el) el.scrollTop = el.scrollHeight
                })
            }

        }
    }
</script>