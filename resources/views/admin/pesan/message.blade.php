<div x-data="adminChat()" x-init="init()" class="w-full">

    <!-- EMPTY STATE -->
    <div x-show="chats.length === 0" class="flex flex-col items-center justify-center text-gray-400 py-20">
        <div class="bg-white p-6 rounded-2xl mb-4 shadow-sm border border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#ff6900]" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
        </div>
        <p class="text-lg font-semibold text-gray-600">Belum ada pesan masuk</p>
        <p class="text-sm text-gray-400 mt-1">Pesan dari user akan muncul di sini</p>
    </div>

    <!-- LIST CHAT -->
    <div x-show="chats.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2 pl-2 pr-2 pb-8">
        <template x-for="chat in chats" :key="chat.client_id">
            <div @click="openChat(chat.client_id)"
                class="bg-white border rounded-2xl p-6 flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 group relative overflow-hidden h-full cursor-pointer"
                style="border-color: #ffd180;" :class="chat.is_new ? 'ring-2 ring-[#ff6900] ring-offset-2' : ''">

                <!-- Header -->
                <div class="flex items-start justify-between min-w-0">
                    <div class="min-w-0 flex-1">
                        <p class="font-semibold text-sm truncate text-gray-800 w-full" x-text="chat.label || chat.client_id"></p>
                        <p x-show="chat.nim" class="text-xs text-gray-400 truncate w-full" x-text="'NIM: ' + chat.nim"></p>
                        <p x-show="chat.nama_ibu" class="text-xs text-gray-500 truncate w-full" x-text="'Ibu: ' + chat.nama_ibu"></p>
                    </div>
                    <span x-show="chat.is_new"
                        class="text-[10px] bg-[#ff6900]/10 text-[#ff6900] font-semibold px-2 py-0.5 rounded-full ml-2 shrink-0 whitespace-nowrap">
                        ● Baru
                    </span>
                </div>

                <!-- PREVIEW PESAN -->
                <div class="text-sm w-full break-words text-justify line-clamp-2 mt-2"
                    style="color: #6b7280; line-height: 1.5; max-height: 3em;">
                    <span x-text="chat.preview"></span>
                </div>

                <!-- Badge status -->
                <div class="mt-3 flex flex-wrap items-center gap-1.5">
                    <span x-show="chat.status === 'parent'"
                        class="text-[10px] bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full truncate">
                        ✓ Orang Tua
                    </span>
                    <!-- 
                    // PERBAIKAN: Guest sudah tidak muncul karena difilter di server
                    // Tapi tetap dipertahankan untuk jaga-jaga
                    -->
                    <span x-show="chat.status === 'guest'"
                        class="text-[10px] bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full shrink-0">
                        👤 Guest
                    </span>
                    <span x-show="chat.nim"
                        class="text-[10px] bg-blue-50 text-blue-600 px-2.5 py-0.5 rounded-full truncate">
                        NIM: <span x-text="chat.nim"></span>
                    </span>
                </div>

                <!-- Footer -->
                <div class="mt-3 flex items-center justify-between text-gray-400">
                    <div class="flex items-center gap-1.5">
                        <span class="text-[10px]">Klik untuk balas</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <span x-show="chat.unread > 0" class="text-[10px] text-red-500 font-medium">
                        ● <span x-text="chat.unread"></span> belum dibaca
                    </span>
                </div>
            </div>
        </template>
    </div>

    <!-- CHAT BOX -->
    <div x-show="open" x-cloak x-transition:enter="transition-all duration-500 ease-out"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-all duration-400 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-screen z-50 flex flex-col bg-white shadow-2xl w-full md:w-[380px]">

        <!-- HEADER CHAT BOX -->
        <div class="bg-[#ff6900] text-white p-4 flex items-center gap-3 shadow-sm">
            <button @click="close()" class="p-1.5 hover:bg-white/20 rounded-lg transition-colors">
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
                <div>
                    <span class="font-semibold text-base" x-text="chatLabel || client_id"></span>
                    <p x-show="chatNim" class="text-xs opacity-80" x-text="'NIM: ' + chatNim"></p>
                </div>
            </div>
            <div class="ml-auto flex items-center gap-2">
                <span class="text-xs bg-white/20 px-2 py-0.5 rounded-full" x-text="messages.length + ' pesan'"></span>
            </div>
        </div>

        <!-- BODY CHAT BOX -->
        <div x-ref="chatBody" class="chat-body flex-1 p-4 overflow-y-auto bg-[#f8f9fb]">

            <div x-show="messages.length === 0"
                class="h-full flex flex-col items-center justify-center text-center text-gray-400">
                <div class="bg-white p-6 rounded-2xl mb-4 shadow-sm border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#ff6900]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="font-semibold text-gray-600">Belum ada pesan</p>
                <p class="text-sm mt-1">Mulai balas chat dengan admin</p>
            </div>

            <div class="space-y-3" x-show="messages.length > 0">
                <template x-for="(msg, index) in messages" :key="msg.id">
                    <div class="flex message-item" :style="`animation-delay:${index*0.05}s`"
                        :class="msg.from === 'admin' ? 'justify-end' : 'justify-start'">

                        <div class="chat-bubble px-4 py-2.5 rounded-2xl max-w-[85%] md:max-w-[75%] shadow-sm text-sm leading-relaxed"
                            :class="msg.from === 'admin'
                                ? 'bg-[#ff6900] text-white rounded-br-none'
                                : 'bg-white text-gray-800 rounded-bl-none border border-gray-100'">

                            <div class="whitespace-pre-line" x-text="msg.text"></div>
                            <div class="text-[11px] opacity-70 text-right mt-1.5" x-text="msg.time"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- INPUT CHAT BOX -->
        <div class="p-3 pb-6 md:pb-3 flex gap-2 bg-white border-t border-gray-100 items-end">
            <textarea x-ref="input" x-model="message" @keydown.enter.prevent="send()" rows="1"
                placeholder="Tulis balasan..." @input="autoResize"
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

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-word;
    }

    /* Badge notification pulse animation */
    @keyframes badgePulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }
    .badge-pulse {
        animation: badgePulse 0.5s ease;
    }
</style>

<script>
    function adminChat() {
        return {
            open: false,
            client_id: null,
            messages: [],
            message: '',
            interval: null,
            listInterval: null,
            last_id: 0,
            chats: [],
            lastChatIds: {},
            showDeleteModal: false,
            chatLabel: '',
            chatNim: '',
            isLoading: false,

            init() {
                this.loadChats()
                this.listInterval = setInterval(() => {
                    this.loadChats()
                    this.updateSidebarBadge()
                }, 5000)
                this.updateChatCount()
                this.updateSidebarBadge()
            },

            updateChatCount() {
                const chatCount = document.querySelector('#chatCount');
                if (chatCount && this.chats) {
                    chatCount.textContent = this.chats.length + ' percakapan';
                }
            },

            updateSidebarBadge() {
                const badge = document.getElementById('unreadBadge');
                if (!badge) return;

                let totalUnread = 0;
                this.chats.forEach(chat => {
                    totalUnread += chat.unread || 0;
                });

                if (totalUnread > 0) {
                    badge.textContent = totalUnread > 99 ? '99+' : totalUnread;
                    badge.classList.remove('hidden');
                    badge.classList.add('badge-pulse');
                    setTimeout(() => {
                        badge.classList.remove('badge-pulse');
                    }, 500);
                } else {
                    badge.classList.add('hidden');
                }
            },

            async loadChats() {
                if (this.isLoading) return;
                this.isLoading = true;

                try {
                    let res = await fetch('/chatbot/list')
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    
                    let data = await res.json()

                    // =============================================
                    // PERBAIKAN: Filter double-check untuk guest
                    // =============================================
                    data = data.filter(chat => chat.status !== 'guest');

                    data = data.map(chat => {
                        let cleanText = chat.last || '-';
                        cleanText = cleanText.replace(/\n/g, ' ');
                        cleanText = cleanText.replace(/\r/g, ' ');
                        cleanText = cleanText.replace(/\s+/g, ' ');
                        cleanText = cleanText.trim();
                        cleanText = cleanText.substring(0, 80) + (cleanText.length > 80 ? '...' : '');

                        let label = chat.client_id;
                        if (chat.status === 'parent' && chat.nama_mahasiswa && chat.nim) {
                            label = `ortu-${chat.nama_mahasiswa}-${chat.nim}`;
                        } else if (chat.nama_mahasiswa && chat.nim) {
                            label = `${chat.nama_mahasiswa} (${chat.nim})`;
                        }

                        return {
                            ...chat,
                            preview: cleanText,
                            label: label
                        }
                    })

                    data.forEach(chat => {
                        let lastId = this.lastChatIds[chat.client_id]
                        if (lastId && chat.last_id > lastId) {
                            chat.is_new = true
                        } else {
                            chat.is_new = false
                        }
                        this.lastChatIds[chat.client_id] = chat.last_id
                    })
                    
                    this.chats = data
                    this.updateChatCount()
                    this.updateSidebarBadge()
                    
                } catch (error) {
                    console.error('Error loading chats:', error)
                } finally {
                    this.isLoading = false;
                }
            },

            async openChat(id) {
                if (this.interval) clearInterval(this.interval)
                this.client_id = id
                this.open = true
                this.chatLabel = ''
                this.chatNim = ''

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    
                    await fetch('/chatbot/mark-as-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            client_id: this.client_id
                        })
                    })
                    
                    document.dispatchEvent(new CustomEvent('chatRead', {
                        detail: { client_id: this.client_id }
                    }));
                    
                } catch (error) {
                    console.error('Error marking as read:', error)
                }

                let chat = this.chats.find(c => c.client_id === id)
                if (chat) {
                    chat.is_new = false
                    chat.unread = 0
                    this.chatLabel = chat.label || chat.client_id
                    this.chatNim = chat.nim || ''
                }

                this.messages = []
                this.last_id = 0
                await this.loadMessages(true)
                this.interval = setInterval(() => {
                    this.loadMessages()
                }, 2000)
                this.loadChats()
            },

            close() {
                this.open = false
                if (this.interval) clearInterval(this.interval)
                this.updateSidebarBadge()
            },

            async loadMessages(force = false) {
                try {
                    let res = await fetch(`/chatbot/messages?client_id=${this.client_id}&last_id=${this.last_id}`)
                    let data = await res.json()
                    
                    let messages = Array.isArray(data) ? data : (data.messages || []);
                    
                    if (messages.length > 0) {
                        messages.forEach(msg => {
                            if (!this.messages.find(m => m.id === msg.id)) {
                                this.messages.push(msg)
                            }
                        })
                        this.last_id = messages[messages.length - 1].id
                        this.scrollBottom()
                    }
                    
                    if (data.session) {
                        let session = data.session;
                        if (session.status === 'parent' && session.nama_mahasiswa && session.nim) {
                            this.chatLabel = `ortu-${session.nama_mahasiswa}-${session.nim}`;
                        } else if (session.nama_mahasiswa && session.nim) {
                            this.chatLabel = `${session.nama_mahasiswa} (${session.nim})`;
                        } else {
                            this.chatLabel = this.client_id;
                        }
                        this.chatNim = session.nim || '';
                    } else {
                        this.chatLabel = this.client_id;
                        this.chatNim = '';
                    }
                    
                    if (force) this.scrollBottom()
                } catch (error) {
                    console.error('Error loading messages:', error)
                }
            },

            autoResize() {
                let el = this.$refs.input
                el.style.height = 'auto'
                el.style.height = el.scrollHeight + 'px'
            },

            async send() {
                if (!this.message.trim()) return

                let text = this.message
                this.message = ''
                this.$refs.input.style.height = 'auto'

                let tempId = Date.now()
                const now = new Date();
                const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');

                this.messages.push({
                    id: tempId,
                    text: text,
                    from: 'admin',
                    time: time
                })
                this.scrollBottom()

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    
                    if (!csrfToken) {
                        console.warn('CSRF token not found in meta tag, trying cookie...');
                    }

                    let res = await fetch('/chatbot/reply', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            client_id: this.client_id,
                            message: text
                        })
                    })

                    let data = await res.json()

                    if (!res.ok) {
                        throw new Error(data.message || `HTTP error! status: ${res.status}`);
                    }

                    if (data.error) {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }

                    let index = this.messages.findIndex(m => m.id === tempId)
                    if (index !== -1) {
                        this.messages[index] = data
                    }

                    this.last_id = data.id
                    this.scrollBottom()
                    this.loadChats()

                } catch (error) {
                    console.error('Error sending reply:', error)
                    let index = this.messages.findIndex(m => m.id === tempId)
                    if (index !== -1) {
                        this.messages.splice(index, 1)
                    }
                    alert('Gagal mengirim balasan: ' + error.message)
                }
            },

            deleteAllMessages() {
                this.showDeleteModal = true
            },

            async confirmDeleteAll() {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    
                    let res = await fetch('/admin/pesan/delete-all-message', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'include'
                    })
                    if (res.ok) {
                        this.showDeleteModal = false
                        this.chats = []
                        this.messages = []
                        alert('Semua pesan berhasil dihapus!')
                        location.reload()
                    }
                } catch (error) {
                    console.error('Error deleting messages:', error)
                    alert('Gagal menghapus pesan.')
                }
            },

            scrollBottom() {
                this.$nextTick(() => {
                    let el = this.$refs.chatBody
                    if (el) el.scrollTop = el.scrollHeight
                })
            }
        }
    }

    // Event listener untuk update badge dari luar
    document.addEventListener('chatRead', function(e) {
        const badge = document.getElementById('unreadBadge');
        if (!badge) return;

        fetch('/chatbot/list')
            .then(res => res.json())
            .then(data => {
                // =============================================
                // PERBAIKAN: Filter guest di badge juga
                // =============================================
                let totalUnread = 0;
                data.forEach(chat => {
                    if (chat.status !== 'guest') {
                        totalUnread += chat.unread || 0;
                    }
                });

                if (totalUnread > 0) {
                    badge.textContent = totalUnread > 99 ? '99+' : totalUnread;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error updating badge:', error);
            });
    });
</script>