<div x-data="adminChat()" x-init="init()">

    <!-- EMPTY STATE -->
    <div x-show="chats.length === 0" class="flex flex-col items-center justify-center text-gray-400 py-20">
        <p class="text-lg font-semibold">Belum ada pesan masuk</p>
        <p class="text-sm">Pesan dari user akan muncul di sini</p>
    </div>

    <!-- LIST CHAT -->
    <div x-show="chats.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <template x-for="chat in chats" :key="chat.client_id">
            <div @click="openChat(chat.client_id)"
                class="cursor-pointer relative bg-white border rounded-2xl p-6 hover:shadow-xl transition"
                :class="chat.is_new ? 'ring-2 ring-green-400' : ''">

                <!-- unread -->
                <span x-show="chat.unread > 0"
                    class="absolute top-3 right-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full"
                    x-text="chat.unread"></span>

                <p class="font-semibold mb-2" x-text="chat.client_id"></p>

                <p class="text-gray-500 text-sm break-all" x-text="chat.last ? chat.last : '-'"></p>

                <!-- indikator pesan baru -->
                <span x-show="chat.is_new" class="text-xs text-green-600 font-semibold mt-2 inline-block">
                    Pesan baru
                </span>

            </div>
        </template>

    </div>

    <!-- CHAT BOX -->
    <div x-show="open" x-cloak x-transition:enter="transition-all duration-500 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-all duration-400 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-screen w-[360px] bg-gray-100 shadow-2xl z-50 flex flex-col">

        <!-- HEADER -->
        <div class="bg-black text-white p-4 flex items-center gap-3">
            <button @click="close()" class="hover:text-gray-300">←</button>
            <span class="font-semibold text-lg" x-text="client_id"></span>
        </div>

        <!-- BODY -->
        <div x-ref="chatBody" class="chat-body flex-1 p-4 overflow-y-auto">

            <!-- EMPTY CHAT -->
            <div x-show="messages.length === 0"
                class="h-full flex flex-col items-center justify-center text-center text-gray-400">
                <p class="font-semibold">Belum ada pesan</p>
            </div>

            <!-- CHAT -->
            <div class="space-y-4" x-show="messages.length > 0">

                <template x-for="(msg, index) in messages" :key="msg.id">
                    <div class="flex message-item" :style="`animation-delay: ${index * 0.05}s`"
                        :class="msg.from === 'admin' ? 'justify-end' : 'justify-start'">

                        <div class="px-4 py-2 rounded-2xl max-w-[75%] shadow-sm text-sm break-all" :class="msg.from === 'admin'
                                ? 'bg-green-500 text-white rounded-br-md'
                                : 'bg-white text-gray-800 rounded-bl-md'">

                            <span x-text="msg.text"></span>

                            <div class="text-[11px] opacity-70 text-right mt-1" x-text="msg.time"></div>

                        </div>
                    </div>
                </template>

            </div>

        </div>

        <!-- INPUT -->
        <div class="p-3 flex gap-2 bg-white border-t">

            <textarea x-ref="input" x-model="message" @keydown.enter.prevent="send()" rows="1"
                placeholder="Tulis balasan..." @input="autoResize"
                class="flex-1 rounded-xl px-4 py-2 bg-gray-100 border focus:ring-2 focus:ring-green-400 resize-none overflow-y-auto max-h-32">
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

    @keyframes messageIn {
        0% {
            opacity: 0;
            transform: translateY(12px) scale(0.96);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .message-item {
        animation: messageIn 0.4s ease;
    }

    .chat-body {
        word-break: break-word;
    }

    textarea {
        line-height: 1.4;
    }
</style>

<script>
    function adminChat(){
return {

    open:false,
    client_id:null,
    messages:[],
    message:'',
    interval:null,
    listInterval:null,
    last_id:0,
    chats:[],
    lastChatIds:{},

    init(){
        this.loadChats()

        this.listInterval = setInterval(() => {
            this.loadChats()
        }, 2000)
    },

    async loadChats(){
        let res = await fetch('/chatbot/list')
        let data = await res.json()

        data.forEach(chat => {

            let lastId = this.lastChatIds[chat.client_id]

            if(lastId && chat.last_id > lastId){
                chat.is_new = true
            }else{
                chat.is_new = false
            }

            this.lastChatIds[chat.client_id] = chat.last_id
        })

        this.chats = data
    },

    async openChat(id){

        if(this.interval) clearInterval(this.interval)

        this.client_id = id
        this.open = true

        let chat = this.chats.find(c => c.client_id === id)
        if(chat) chat.is_new = false

        this.messages = []
        this.last_id = 0

        await this.loadMessages(true)

        this.interval = setInterval(() => {
            this.loadMessages()
        }, 1500)
    },

    close(){
        this.open = false
        if(this.interval) clearInterval(this.interval)
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

        this.$refs.input.style.height = 'auto'

        let tempId = Date.now()

        this.messages.push({
            id: tempId,
            text: text,
            from: 'admin',
            time: '...'
        })

        this.scrollBottom()

        let res = await fetch('/chatbot/reply', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                client_id: this.client_id,
                message: text
            })
        })

        let data = await res.json()

        let index = this.messages.findIndex(m => m.id === tempId)
        if(index !== -1){
            this.messages[index] = data
        }

        this.last_id = data.id
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