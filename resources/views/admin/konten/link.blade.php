<div class="space-y-4">

    {{-- LIST LINK --}}
    @forelse($links as $link)
    <div
        class="bg-white border border-gray-200 rounded-2xl p-4 flex justify-between items-center transition duration-200 group">

        <div class="flex items-center gap-3">
            <i class="{{ $link->icon_class }} text-lg text-gray-700"></i>

            <div>
                <p class="font-semibold text-gray-800">{{ $link->name }}</p>
                <p class="text-gray-500 text-sm">{{ $link->url }}</p>
            </div>
        </div>

        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition duration-200">

            {{-- EDIT --}}
            <button onclick='openEditLinkModal(@json($link))'
                class="bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </button>

            {{-- DELETE --}}
            <button onclick="openDeleteLinkModal({{ $link->id }})"
                class="bg-red-500 hover:bg-red-600 p-2 rounded-lg shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>

    </div>
    @empty
    <p class="text-gray-400 italic">Belum ada link</p>
    @endforelse

</div>

<div id="createLinkModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2">
            ➕ Tambah Link
        </h2>

        <form action="{{ route('admin.konten.link.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Website Kampus"
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl mb-4 outline-none transition"
                required>

            <input type="text" name="url" placeholder="https://..."
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl mb-4 outline-none transition"
                required>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('createLinkModal')"
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

<div id="editLinkModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2">
            ✏️ Edit Link
        </h2>

        <form id="editLinkForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" id="editLinkName" class="w-full border p-3 rounded-xl mb-3" required>

            <input type="text" name="url" id="editLinkUrl" class="w-full border p-3 rounded-xl mb-4" required>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editLinkModal')"
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

<div id="deleteLinkModal" class="modal">
    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-sm shadow-2xl border border-white/30 text-center">

        <div class="text-4xl mb-3">⚠️</div>

        <h2 class="text-lg font-semibold mb-2 text-gray-800">
            Hapus Link?
        </h2>

        <p class="text-gray-500 text-sm mb-5">
            Data yang dihapus tidak bisa dikembalikan
        </p>

        <form id="deleteLinkForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('deleteLinkModal')"
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
    function openEditLinkModal(link) {
    document.getElementById('editLinkName').value = link.name;
    document.getElementById('editLinkUrl').value = link.url;

    document.getElementById('editLinkForm').action =
        `/admin/konten/link/${link.id}`;

    openModal('editLinkModal');
}

function openDeleteLinkModal(id) {
    document.getElementById('deleteLinkForm').action = `/admin/konten/link/${id}`;
    openModal('deleteLinkModal');
}
</script>
