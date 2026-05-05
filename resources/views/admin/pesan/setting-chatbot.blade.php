<div class="space-y-4">

    @forelse ($rules as $rule)

    <div class="bg-white border border-gray-200 rounded-2xl p-4 
        flex justify-between items-center 
        hover:shadow-xl hover:-translate-y-1 
        transition duration-300 group">

        <div>
            <h3 class="font-semibold text-gray-800">
                {{ $rule->keyword }}
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                {{ $rule->reply }}
            </p>
        </div>

        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition duration-200">

            <!-- EDIT -->
            <button onclick='openEditRuleModal(@json($rule))'
                class="bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg shadow-sm transition duration-200">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>

            </button>

            <!-- DELETE -->
            <button onclick="openDeleteRuleModal({{ $rule->id }})"
                class="bg-red-500 hover:bg-red-600 p-2 rounded-lg shadow-sm transition duration-200">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>

        </div>

    </div>

    @empty
    <p class="text-gray-400 italic text-center">
        Belum ada rule pesan otomatis
    </p>
    @endforelse

</div>

<div id="createRuleModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-2xl w-full max-w-md shadow-2xl border border-gray-200">

        <h2 class="text-xl font-semibold mb-5">➕ Tambah Rule</h2>

        <form action="{{ route('admin.pesan.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="keyword" placeholder="Keyword"
                class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">

            <textarea name="reply" placeholder="Balasan"
                class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('createRuleModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    Batal
                </button>

                <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl shadow">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<div id="editRuleModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-2xl w-full max-w-md shadow-2xl border border-gray-200">

        <h2 class="text-xl font-semibold mb-5">✏️ Edit Rule</h2>

        <form id="editRuleForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" id="editKeyword" name="keyword"
                class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-yellow-100 focus:border-yellow-500 outline-none">

            <textarea id="editReply" name="reply"
                class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-yellow-100 focus:border-yellow-500 outline-none"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editRuleModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    Batal
                </button>

                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-xl shadow">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>

<div id="deleteRuleModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-2xl w-full max-w-sm shadow-2xl border border-gray-200 text-center">

        <div class="text-4xl mb-3">⚠️</div>

        <h2 class="text-lg font-semibold mb-2">Hapus Rule?</h2>
        <p class="text-sm text-gray-500 mb-5">Data tidak bisa dikembalikan</p>

        <form id="deleteRuleForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('deleteRuleModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    Batal
                </button>

                <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl shadow">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openModal(id) {
    document.getElementById(id).classList.add('show');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}

function openEditRuleModal(rule) {
    document.getElementById('editKeyword').value = rule.keyword;
    document.getElementById('editReply').value = rule.reply;
    document.getElementById('editRuleForm').action = `/admin/pesan/rule/${rule.id}`;
    openModal('editRuleModal');
}

function openDeleteRuleModal(id) {
    document.getElementById('deleteRuleForm').action = `/admin/pesan/rule/${id}`;
    openModal('deleteRuleModal');
}

// klik luar modal
document.addEventListener('click', function(e){
    document.querySelectorAll('.modal').forEach(modal => {
        if(e.target === modal){
            modal.classList.remove('show')
        }
    })
})

// ESC close
document.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){
        document.querySelectorAll('.modal').forEach(m => m.classList.remove('show'))
    }
})
</script>