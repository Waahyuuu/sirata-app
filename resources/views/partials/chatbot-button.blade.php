<div x-data="chatBox()" x-init="init()">

    <!-- BUTTON -->
    <div x-show="!open" class="fixed right-0 top-1/2 -translate-y-1/2 z-50">
        <div @click="open = true" class="bg-green-500 text-white px-4 py-2 hover:px-6 rounded-r-3xl rotate-180 cursor-pointer
            border-r-8 border-t-8 border-b-8 border-white transition-all duration-300"
            style="writing-mode: vertical-rl;">
            Kirim Pesan
        </div>
    </div>

    <!-- CHAT BOX -->
    <div x-show="open" x-cloak x-transition:enter="transition-all duration-500 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-all duration-400 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-screen w-[360px] bg-gray-100 shadow-2xl z-50 flex flex-col">

        <!-- HEADER -->
        <div class="bg-black text-white p-4 flex items-center gap-3">
            <button @click="open=false">←</button>
            <span class="font-semibold text-lg">Admin Message</span>
        </div>

        <!-- BODY -->
        <div x-ref="chatBody" class="chat-body flex-1 p-4 overflow-y-auto">

            <!-- EMPTY -->
            <div x-show="messages.length === 0" class="h-full flex flex-col items-center justify-center text-gray-400">
                <p class="font-semibold">Belum ada pesan</p>
                <p class="text-sm">Mulai chat dengan admin 👇</p>
            </div>

            <!-- CHAT -->
            <div class="space-y-4" x-show="messages.length > 0">

                <template x-for="(msg, index) in messages" :key="msg.id">
                    <div class="flex message-item" :style="`animation-delay:${index*0.05}s`"
                        :class="msg.from === 'user' ? 'justify-end' : 'justify-start'">

                        <div class="chat-bubble px-4 py-2 rounded-2xl max-w-[75%] shadow-sm text-sm" :class="msg.from === 'user'
                                ? 'bg-green-500 text-white rounded-br-md'
                                : 'bg-white text-gray-800 rounded-bl-md'">

                            <span x-text="msg.text"></span>

                            <div class="text-[11px] opacity-70 text-right mt-1" x-text="msg.time"></div>
                        </div>

                    </div>
                </template>

                <!-- TYPING -->
                <div x-show="typing" class="flex">
                    <div class="bg-white px-4 py-2 rounded-2xl rounded-bl-md shadow-sm">
                        <div class="flex gap-2">
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- INPUT -->
        <div class="p-3 flex gap-2 bg-white border-t">

            <textarea x-ref="input" x-model="message" @keydown.enter.prevent="send()" rows="1"
                placeholder="Tulis pesan..." @input="autoResize"
                class="flex-1 rounded-xl px-4 py-2 bg-gray-100 border focus:ring-2 focus:ring-green-400 resize-none max-h-[120px] overflow-y-auto">
            </textarea>

            <button @click="send()"
                class="bg-green-500 w-10 h-10 flex items-center justify-center text-white rounded-full">
                ➤
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

            // ✅ simpan ke sessionStorage
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