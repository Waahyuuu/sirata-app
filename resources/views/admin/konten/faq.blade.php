<div class="space-y-4">

    {{-- LIST FAQ --}}
    @forelse($faqs as $faq)
    <div
        class="bg-white border border-gray-200 rounded-2xl p-4 flex justify-between items-center shadow-sm hover:shadow-md transition duration-200 group">

        <div>
            <h3 class="font-semibold text-gray-800">{{ $faq->question }}</h3>
            <p class="text-gray-500 text-sm mt-1">{{ $faq->answer }}</p>
        </div>

        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition duration-200">

            <!-- Edit Icon Button -->
            <button onclick='openEditModal(@json($faq))'
                class="bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </button>

            <!-- Delete Icon Button -->

            <button onclick="openDeleteModal({{ $faq->id }})"
                class="bg-red-500 hover:bg-red-600 p-2 rounded-lg shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>


        </div>

    </div>
    @empty
    <p class="text-gray-400 italic">Belum ada FAQ</p>
    @endforelse

</div>

{{-- MODAL CREATE --}}
<div id="createModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5">➕ Tambah FAQ</h2>

        <form action="{{ route('admin.konten.faq.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="question" placeholder="Pertanyaan"
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl outline-none transition" />

            <textarea name="answer" placeholder="Jawaban"
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl outline-none transition"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('createModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </button>

                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5">✏️ Edit FAQ</h2>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" id="editQuestion" name="question"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl outline-none transition" />

            <textarea id="editAnswer" name="answer"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl outline-none transition"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </button>

                <button
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>

<div id="deleteModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-sm shadow-2xl border border-white/30 text-center">

        <div class="text-4xl mb-3">⚠️</div>

        <h2 class="text-lg font-semibold text-gray-800 mb-2">
            Hapus FAQ?
        </h2>

        <p class="text-gray-500 text-sm mb-5">
            Data tidak bisa dikembalikan
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('deleteModal')"
                    class="px-4 py-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </button>

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition">
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

function openEditModal(faq) {
    document.getElementById('editQuestion').value = faq.question;
    document.getElementById('editAnswer').value = faq.answer;
    document.getElementById('editForm').action = `/admin/konten/faq/${faq.id}`;
    openModal('editModal');
}

function openDeleteModal(id) {
    document.getElementById('deleteForm').action = `/admin/konten/faq/${id}`;
    openModal('deleteModal');
}

// klik luar = close
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            modal.classList.remove('show');
        }
    });
});

// ESC = close
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
        document.querySelectorAll('.modal').forEach(m => m.classList.remove('show'));
    }
});
</script>