<div x-data="chatBox()" x-init="init()">

    <!-- BUTTON -->
    <div x-show="!open" class="fixed right-0 top-1/2 -translate-y-1/2 z-30">
        <div @click="openChat()" class="bg-[#ff6900] text-white cursor-pointer border-white transition-all duration-300
            px-3 py-1.5 text-xs rounded-r-2xl border-r-4 border-t-4 border-b-4
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
        x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 h-screen z-50 flex flex-col bg-white shadow-2xl
        w-full md:w-[360px]">

        <!-- HEADER -->
        <div class="bg-[#ff6900] text-white p-4 flex items-center gap-3 shadow-sm">
            <button @click="closeChat()" class="p-1.5 hover:bg-white/20 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="font-semibold text-base">Admin</span>
            </div>
        </div>

        <!-- BODY -->
        <div x-ref="chatBody" class="chat-body flex-1 p-4 overflow-y-auto bg-[#f8f9fb]">

            <!-- CHAT CONTENT -->
            <div class="space-y-3">
                <template x-for="(msg, index) in messages" :key="msg.id">
                    <div class="flex message-item" :style="`animation-delay:${index*0.05}s`"
                        :class="msg.from === 'user' ? 'justify-end' : 'justify-start'">

                        <div class="chat-bubble px-4 py-2.5 rounded-2xl max-w-[85%] md:max-w-[75%] shadow-sm text-sm leading-relaxed"
                            :class="msg.from === 'user'
                                ? 'bg-[#ff6900] text-white rounded-br-none'
                                : 'bg-white text-gray-800 rounded-bl-none border border-gray-100'">

                            <div class="whitespace-pre-line" x-text="msg.text"></div>
                            <div class="text-[11px] opacity-70 text-right mt-1.5" x-text="msg.time"></div>
                        </div>
                    </div>
                </template>

                <!-- TYPING INDICATOR -->
                <div x-show="typing" class="flex">
                    <div class="bg-white px-4 py-3 rounded-2xl rounded-bl-none shadow-sm border border-gray-100">
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
        <div class="p-3 pb-6 md:pb-3 flex gap-2 bg-white border-t border-gray-100 items-end">
            <textarea x-ref="input" x-model="message" @keydown.enter.prevent="send()" rows="1"
                placeholder="Tulis pesan..." @input="autoResize"
                class="flex-1 rounded-2xl px-4 py-2.5 bg-gray-100 border border-transparent focus:bg-white focus:border-[#ff6900] focus:ring-2 focus:ring-[#ff6900]/20 resize-none max-h-[120px] text-sm transition-all outline-none placeholder-gray-400">
            </textarea>

            <button @click="send()"
                class="bg-[#ff6900] w-11 h-11 flex items-center justify-center text-white rounded-full hover:bg-[#e55e00] active:scale-95 transition-all shadow-md shadow-orange-200 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -rotate-45" viewBox="0 0 20 20"
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
        width: 5px;
    }

    .chat-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 10px;
    }

    .chat-body::-webkit-scrollbar-thumb:hover {
        background: #d1d5db;
    }

    .chat-bubble {
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    @keyframes messageIn {
        0% {
            opacity: 0;
            transform: translateY(10px) scale(0.96);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .message-item {
        animation: messageIn 0.3s ease forwards;
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
        width: 7px;
        height: 7px;
        background: #ff6900;
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
    function chatBox() {
        return {

            open: false,
            message: '',
            typing: false,
            messages: [],
            client_id: null,
            last_id: 0,
            interval: null,
            processing: false,
            welcome_sent: false,
            pendingBotReply: null,

            init() {
                // =============================================
                // PERBAIKAN: Cek client_id dari COOKIE dulu
                // =============================================
                let id = this.getCookie('client_id');
                
                // Jika tidak ada di cookie, cek sessionStorage
                if (!id) {
                    id = sessionStorage.getItem('client_id');
                }
                
                // Jika masih tidak ada, buat baru
                if (!id) {
                    id = 'user-' + Math.random().toString(36).substr(2, 9);
                    sessionStorage.setItem('client_id', id);
                } else {
                    // Sync ke sessionStorage
                    sessionStorage.setItem('client_id', id);
                }

                this.client_id = id;

                // Cek apakah welcome sudah pernah dikirim
                this.welcome_sent = sessionStorage.getItem('welcome_sent_' + id) === 'true';

                // Load pesan dari session storage
                let saved = sessionStorage.getItem('chat_' + id);
                if (saved) {
                    this.messages = JSON.parse(saved);
                    this.last_id = this.messages.length
                        ? this.messages[this.messages.length - 1].id
                        : 0;
                }

                // Load pesan dari server
                this.loadMessages(true);

                // Polling setiap 10 detik untuk cek pesan baru
                this.interval = setInterval(() => {
                    this.loadMessages();
                }, 10000);
            },

            // =============================================
            // HELPER: Ambil Cookie
            // =============================================
            getCookie(name) {
                let value = "; " + document.cookie;
                let parts = value.split("; " + name + "=");
                if (parts.length == 2) return parts.pop().split(";").shift();
                return null;
            },

            // =============================================
            // OPEN CHAT - TAMPILKAN WELCOME DENGAN TYPING
            // =============================================
            openChat() {
                this.open = true;
                
                if (this.messages.length === 0) {
                    this.showWelcomeWithTyping();
                }
            },

            // =============================================
            // CLOSE CHAT
            // =============================================
            closeChat() {
                this.open = false;
            },

            // =============================================
            // SHOW WELCOME DENGAN EFEK TYPING
            // =============================================
            showWelcomeWithTyping() {
                if (this.welcome_sent) return;
                
                this.typing = true;
                
                const delay = 4000 + Math.random() * 1000;
                
                setTimeout(() => {
                    this.typing = false;
                    
                    const welcomeText = 
                        "👋 Selamat datang di SIRATA CHATBOT!\n\n" +
                        "Saya adalah asisten virtual SIRATA (Sistem Rapor STIMATA)\n" +
                        "yang siap membantu Anda.\n\n" +
                        "📋 Layanan yang tersedia:\n\n" +
                        "1. 🎓 INFORMASI NIM - Cari data mahasiswa\n" +
                        "   (Cukup dengan nama lengkap)\n\n" +
                        "2. 👨‍💼 BERBICARA DENGAN ADMIN\n" +
                        "   (Jam operasional 07.00-15.00 WIB)\n\n" +
                        "3. ✨ MANFAAT - Info tentang SIRATA\n\n" +
                        "💡 Tips: Ketik salah satu menu di atas untuk memulai.\n" +
                        "Contoh: ketik 'informasi nim' untuk mencari NIM.\n\n" +
                        "Ada yang bisa saya bantu? 😊";
                    
                    const now = new Date();
                    const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
                    
                    this.messages.push({
                        id: 'welcome-' + Date.now(),
                        text: welcomeText,
                        from: 'admin',
                        time: time
                    });
                    
                    this.welcome_sent = true;
                    sessionStorage.setItem('welcome_sent_' + this.client_id, 'true');
                    sessionStorage.setItem('chat_' + this.client_id, JSON.stringify(this.messages));
                    
                    setTimeout(() => {
                        this.scrollBottom();
                    }, 100);
                    
                }, delay);
            },

            // =============================================
            // LOAD MESSAGES DARI SERVER
            // =============================================
            async loadMessages(force = false) {
                if (this.processing) return;
                
                try {
                    let url = `/chatbot/messages?client_id=${this.client_id}&last_id=${this.last_id}`;
                    
                    let res = await fetch(url);
                    
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    
                    let data = await res.json();

                    let messages = Array.isArray(data) ? data : (data.messages || []);
                    
                    if (messages.length > 0) {
                        messages.forEach(msg => {
                            if (!this.messages.find(m => m.id === msg.id)) {
                                this.messages.push(msg);
                            }
                        });

                        this.last_id = messages[messages.length - 1].id;
                        sessionStorage.setItem('chat_' + this.client_id, JSON.stringify(this.messages));
                        this.scrollBottom();
                    }

                    if (force) this.scrollBottom();
                    
                } catch (error) {
                    console.error('Error loading messages:', error);
                }
            },

            autoResize() {
                let el = this.$refs.input;
                el.style.height = 'auto';
                el.style.height = el.scrollHeight + 'px';
            },

            // =============================================
            // SEND MESSAGE DENGAN EFEK TYPING
            // =============================================
            async send() {
                if (!this.message.trim() || this.processing) return;

                let text = this.message;
                this.message = '';
                this.processing = true;

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                    let res = await fetch('/chatbot', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            message: text,
                            client_id: this.client_id
                        })
                    });

                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }

                    let data = await res.json();

                    const now = new Date();
                    const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
                    
                    this.messages.push({
                        id: data.id || 'user-' + Date.now(),
                        text: data.text || text,
                        from: 'user',
                        time: data.time || time
                    });

                    if (data.bot_reply) {
                        this.pendingBotReply = data.bot_reply;
                        
                        this.typing = true;
                        
                        const delay = 1000 + Math.random() * 1000;
                        
                        setTimeout(() => {
                            this.typing = false;
                            
                            if (this.pendingBotReply) {
                                this.messages.push({
                                    id: this.pendingBotReply.id,
                                    text: this.pendingBotReply.text,
                                    from: 'admin',
                                    time: this.pendingBotReply.time
                                });
                                
                                this.last_id = this.pendingBotReply.id;
                                this.pendingBotReply = null;
                                
                                sessionStorage.setItem('chat_' + this.client_id, JSON.stringify(this.messages));
                                this.scrollBottom();
                            }
                            
                            this.processing = false;
                            this.$refs.input.style.height = 'auto';
                            
                        }, delay);
                        
                    } else {
                        this.last_id = data.id;
                        this.processing = false;
                        this.$refs.input.style.height = 'auto';
                    }

                    sessionStorage.setItem('chat_' + this.client_id, JSON.stringify(this.messages));
                    this.scrollBottom();

                } catch (error) {
                    console.error('Error sending message:', error);
                    this.message = text;
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                    this.processing = false;
                    this.$refs.input.style.height = 'auto';
                }

                setTimeout(() => {
                    this.loadMessages(true);
                }, 500);
            },

            scrollBottom() {
                this.$nextTick(() => {
                    let el = this.$refs.chatBody;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            }

        }
    }
</script>