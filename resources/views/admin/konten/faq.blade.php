<div class="space-y-4 pt-2 pl-2 pr-2 pb-8">

    {{-- LIST FAQ --}}
    @forelse($faqs as $faq)
    <div class="bg-white border rounded-2xl p-4 flex justify-between items-center hover:shadow-xl hover:-translate-y-1 transition duration-300 group"
        style="border-color: #ffd180;">

        <div>
            <h3 class="font-semibold" style="color: #2d2d2d;">{{ $faq->question }}</h3>
            <p class="text-sm mt-1" style="color: #6b7280;">{{ $faq->answer }}</p>
        </div>

        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition duration-200">

            <!-- Edit Icon Button -->
            <button title="Edit FAQ" onclick='openEditModal(@json($faq))'
                class="p-2 rounded-lg shadow-sm transition duration-200 hover:shadow-md"
                style="background: linear-gradient(135deg, #ff6900, #f54a00);"
                onmouseover="this.style.background='linear-gradient(135deg, #f54a00, #e65100)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ff6900, #f54a00)';">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            <!-- Delete Icon Button -->
            <button title="Hapus FAQ" onclick="openDeleteModal({{ $faq->id }})"
                class="p-2 rounded-lg shadow-sm transition duration-200 hover:shadow-md"
                style="background: linear-gradient(135deg, #ef4444, #dc2626);"
                onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

    </div>
    @empty
    <p class="italic text-center py-8" style="color: #9ca3af;">Belum ada FAQ</p>
    @endforelse

</div>

{{-- MODAL CREATE --}}
<div id="createModal" class="modal">
    <div class="modal-content p-6 rounded-2xl w-full max-w-md shadow-2xl"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2" style="color: #2d2d2d;">
            <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah FAQ
        </h2>

        <form action="{{ route('admin.konten.faq.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- TAMPILKAN ERROR DARI SERVER --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <input type="text" name="question" placeholder="Pertanyaan" value="{{ old('question') }}"
                    class="w-full border p-3 rounded-xl outline-none transition @error('question') border-red-500 @enderror"
                    style="border-color: @error('question') #ef4444 @else #ffd180 @enderror;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='@error('question') #ef4444 @else #ffd180 @enderror'; this.style.boxShadow='none';"
                    required>
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <textarea name="answer" placeholder="Jawaban"
                    class="w-full border p-3 rounded-xl outline-none transition @error('answer') border-red-500 @enderror"
                    style="border-color: @error('answer') #ef4444 @else #ffd180 @enderror;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='@error('answer') #ef4444 @else #ffd180 @enderror'; this.style.boxShadow='none';"
                    required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" title="Batal" onclick="closeModal('createModal')"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button title="Simpan FAQ" class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
                    style="background: linear-gradient(135deg, #ff6900, #f54a00);"
                    onmouseover="this.style.background='linear-gradient(135deg, #f54a00, #e65100)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #ff6900, #f54a00)';">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="modal">
    <div class="modal-content p-6 rounded-2xl w-full max-w-md shadow-2xl"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2" style="color: #2d2d2d;">
            <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit FAQ
        </h2>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- TAMPILKAN ERROR DARI SERVER --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <input type="text" id="editQuestion" name="question" placeholder="Pertanyaan"
                    class="w-full border p-3 rounded-xl outline-none transition @error('question') border-red-500 @enderror"
                    style="border-color: @error('question') #ef4444 @else #ffd180 @enderror;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='@error('question') #ef4444 @else #ffd180 @enderror'; this.style.boxShadow='none';"
                    required>
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <textarea id="editAnswer" name="answer" placeholder="Jawaban"
                    class="w-full border p-3 rounded-xl outline-none transition @error('answer') border-red-500 @enderror"
                    style="border-color: @error('answer') #ef4444 @else #ffd180 @enderror;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='@error('answer') #ef4444 @else #ffd180 @enderror'; this.style.boxShadow='none';"
                    required></textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" title="Batal" onclick="closeModal('editModal')"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button title="Update FAQ" class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
                    style="background: linear-gradient(135deg, #ff6900, #f54a00);"
                    onmouseover="this.style.background='linear-gradient(135deg, #f54a00, #e65100)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #ff6900, #f54a00)';">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>

{{-- MODAL DELETE --}}
<div id="deleteModal" class="modal">
    <div class="modal-content p-6 rounded-2xl w-full max-w-sm shadow-2xl text-center"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
            style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h2 class="text-lg font-semibold mb-2" style="color: #2d2d2d;">
            Hapus FAQ?
        </h2>

        <p class="text-sm mb-5" style="color: #6b7280;">
            Data tidak bisa dikembalikan
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" title="Batal" onclick="closeModal('deleteModal')"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button title="Hapus FAQ" class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
                    style="background: linear-gradient(135deg, #ef4444, #dc2626);"
                    onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
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