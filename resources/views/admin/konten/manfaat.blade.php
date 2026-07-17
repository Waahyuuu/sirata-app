<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2 pl-2 pr-2 pb-8">

    {{-- LIST MANFAAT --}}
    @forelse($manfaats as $manfaat)

    <div class="bg-white border rounded-2xl p-6 flex flex-col items-center text-center
        shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300
        group relative overflow-hidden h-full"
        style="border-color: #ffd180;">

        {{-- ACTION BUTTON --}}
        <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition">

            {{-- EDIT --}}
            <button onclick='openEditManfaatModal(@json($manfaat))'
                class="p-2 rounded-lg shadow-sm transition duration-200 hover:shadow-md"
                style="background: linear-gradient(135deg, #ff6900, #f54a00);"
                onmouseover="this.style.background='linear-gradient(135deg, #f54a00, #e65100)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ff6900, #f54a00)';">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            {{-- DELETE --}}
            <button onclick="openDeleteManfaatModal({{ $manfaat->id }})"
                class="p-2 rounded-lg shadow-sm transition duration-200 hover:shadow-md"
                style="background: linear-gradient(135deg, #ef4444, #dc2626);"
                onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

        {{-- ICON --}}
        <div class="w-24 h-24 mb-4 rounded-xl overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform duration-300"
            style="background-color: #fff8f0;">

            @if(Str::contains($manfaat->icon,'<svg'))
                <div style="color: #ff6900;">{!! $manfaat->icon !!}</div>
            @else
                <img src="{{ asset('storage/'.$manfaat->icon) }}" class="w-full h-full object-cover">
            @endif

        </div>

        {{-- TITLE --}}
        <p class="font-semibold mb-2 w-full break-words" style="color: #2d2d2d;">
            {{ $manfaat->title }}
        </p>

        {{-- DESCRIPTION --}}
        <p class="text-sm line-clamp-4 w-full break-words text-justify" style="color: #6b7280;">
            {{ $manfaat->description }}
        </p>

    </div>

    @empty

    <p class="italic col-span-3 text-center py-8" style="color: #9ca3af;">
        Belum ada manfaat
    </p>

    @endforelse

</div>

{{-- MODAL CREATE --}}
<div id="createManfaatModal" class="modal">

    <div class="modal-content p-6 rounded-2xl w-full max-w-md shadow-2xl"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2" style="color: #2d2d2d;">
            <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Manfaat
        </h2>

        <form action="{{ route('admin.konten.manfaat.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4" onsubmit="return validateManfaatForm()">

            @csrf

            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Judul
                </label>

                <input type="text" name="title" placeholder="Judul Manfaat"
                    class="w-full border p-3 rounded-xl transition outline-none"
                    style="border-color: #ffd180;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='#ffd180'; this.style.boxShadow='none';"
                    required />
            </div>

            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Deskripsi
                </label>

                <textarea name="description" placeholder="Deskripsi"
                    class="w-full border p-3 rounded-xl transition outline-none"
                    style="border-color: #ffd180;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='#ffd180'; this.style.boxShadow='none';"
                    required></textarea>
            </div>


            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Icon
                </label>

                <label for="iconInput"
                    class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed rounded-2xl cursor-pointer overflow-hidden group transition duration-300"
                    style="border-color: #ffd180; background: linear-gradient(135deg, #fff8f0, #ffffff);"
                    onmouseover="this.style.borderColor='#ff6900';"
                    onmouseout="this.style.borderColor='#ffd180';">

                    <div id="uploadPlaceholder"
                        class="flex flex-col items-center justify-center text-center transition-all duration-300">

                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform"
                            style="background-color: #fff5e9; color: #ff6900;">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>

                        <p class="font-medium" style="color: #2d2d2d;">
                            Pilih Icon
                        </p>

                        <span class="text-sm" style="color: #9ca3af;">
                            JPG, PNG, WEBP, SVG
                        </span>
                    </div>

                    <!-- Preview -->
                    <div id="previewWrapper"
                        class="absolute inset-0 hidden items-center justify-center bg-white transition-all duration-500 opacity-0 scale-90">

                        <img id="iconPreview" class="max-h-full object-contain transition-all duration-500 ease-out" />

                        <div class="absolute inset-0 flex items-center justify-center transition"
                            style="background: rgba(0,0,0,0.3); opacity: 0;"
                            onmouseover="this.style.opacity='1';"
                            onmouseout="this.style.opacity='0';">
                            <span class="bg-white px-4 py-2 rounded-xl shadow-lg text-sm font-medium flex items-center gap-2"
                                style="color: #2d2d2d;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Replace
                            </span>
                        </div>
                    </div>

                    <input id="iconInput" type="file" name="icon_file" accept="image/*"
                        onchange="previewIcon(this); clearIconError()" class="hidden" />
                </label>
                <p id="iconError" class="hidden text-sm mt-2" style="color: #ef4444;">
                    Icon wajib diisi
                </p>
            </div>

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeCreateManfaatModal()"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
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
<div id="editManfaatModal" class="modal">

    <div class="modal-content p-6 rounded-2xl w-full max-w-md shadow-2xl"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2" style="color: #2d2d2d;">
            <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit Manfaat
        </h2>

        <form id="editManfaatForm" method="POST" enctype="multipart/form-data" class="space-y-4"
            onsubmit="return validateEditManfaatForm()">

            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Judul
                </label>

                <input type="text" name="title" id="editManfaatTitle"
                    class="w-full border p-3 rounded-xl transition outline-none"
                    style="border-color: #ffd180;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='#ffd180'; this.style.boxShadow='none';"
                    required />
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Deskripsi
                </label>

                <textarea name="description" id="editManfaatDesc" rows="3" oninput="autoResize(this)"
                    class="w-full border p-3 rounded-xl transition outline-none resize-none overflow-hidden"
                    style="border-color: #ffd180;"
                    onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
                    onblur="this.style.borderColor='#ffd180'; this.style.boxShadow='none';"
                    required>
                </textarea>
            </div>

            {{-- ICON --}}
            <div>
                <label class="text-sm font-semibold block mb-2" style="color: #2d2d2d;">
                    Icon
                </label>

                <label for="editIconInput" id="editUploadBox"
                    class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed rounded-2xl cursor-pointer overflow-hidden group transition duration-300"
                    style="border-color: #ffd180; background: linear-gradient(135deg, #fff8f0, #ffffff);"
                    onmouseover="this.style.borderColor='#ff6900';"
                    onmouseout="this.style.borderColor='#ffd180';">

                    {{-- Preview --}}
                    <div id="editPreviewWrapper" class="absolute inset-0 flex items-center justify-center bg-white">

                        <img id="editIconPreview"
                            class="max-h-full object-contain transition-all duration-500 ease-out" />

                        <div class="absolute inset-0 flex items-center justify-center transition"
                            style="background: rgba(0,0,0,0.3); opacity: 0;"
                            onmouseover="this.style.opacity='1';"
                            onmouseout="this.style.opacity='0';">

                            <span class="bg-white px-4 py-2 rounded-xl shadow-lg text-sm font-medium flex items-center gap-2"
                                style="color: #2d2d2d;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Replace
                            </span>

                        </div>
                    </div>

                    <input id="editIconInput" type="file" name="icon_file" accept="image/*"
                        onchange="previewEditIcon(this)" class="hidden" />
                </label>

                <p id="editIconError" class="hidden text-sm mt-2" style="color: #ef4444;">
                </p>
            </div>

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeModal('editManfaatModal')"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
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
<div id="deleteManfaatModal" class="modal">

    <div class="modal-content p-6 rounded-2xl w-full max-w-sm shadow-2xl text-center"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #ffd180;">

        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
            style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h2 class="text-lg font-semibold mb-2" style="color: #2d2d2d;">
            Hapus Manfaat?
        </h2>

        <p class="text-sm mb-5" style="color: #6b7280;">
            Data tidak bisa dikembalikan
        </p>

        <form id="deleteManfaatForm" method="POST">

            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">

                <button type="button" onclick="closeModal('deleteManfaatModal')"
                    class="px-4 py-2 rounded-lg transition hover:shadow-sm"
                    style="color: #6b7280; background-color: #f3f4f6;"
                    onmouseover="this.style.backgroundColor='#e5e7eb';"
                    onmouseout="this.style.backgroundColor='#f3f4f6';">
                    Batal
                </button>

                <button class="text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition"
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
    const MAX_ICON_SIZE = {{ ($maxIconSizeKB ?? 2048) * 1024 }};

    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    function openModal(id){
        document.getElementById(id).classList.add('show');
    }

    function closeCreateManfaatModal() {
        const modal = document.getElementById('createManfaatModal');
        const form = modal.querySelector('form');

        form.reset();

        const iconInput = document.getElementById('iconInput');
        iconInput.value = '';

        const preview = document.getElementById('iconPreview');
        const wrapper = document.getElementById('previewWrapper');
        const placeholder = document.getElementById('uploadPlaceholder');

        preview.src = '';

        wrapper.classList.add('hidden');
        wrapper.classList.remove('flex', 'opacity-100', 'scale-100');

        placeholder.classList.remove('hidden', 'opacity-0', 'scale-95');

        document.getElementById('iconError').classList.add('hidden');

        modal.classList.remove('show');
    }

    function openEditManfaatModal(data) {
        document.getElementById('editManfaatTitle').value = data.title;
        document.getElementById('editManfaatDesc').value = data.description;
        document.getElementById('editManfaatForm').action = `/admin/konten/manfaat/${data.id}`;

        const desc = document.getElementById('editManfaatDesc');
        desc.value = data.description;
        autoResize(desc);

        const preview = document.getElementById('editIconPreview');
        preview.src = data.icon.includes('<svg')
            ? 'data:image/svg+xml;base64,' + btoa(data.icon)
            : `/storage/${data.icon}`;

        document.getElementById('editIconError').classList.add('hidden');
        document.getElementById('editUploadBox').classList.remove('border-red-500');

        openModal('editManfaatModal');
    }

    function openDeleteManfaatModal(id){
        document.getElementById('deleteManfaatForm').action = `/admin/konten/manfaat/${id}`;
        openModal('deleteManfaatModal');
    }

    function previewIcon(input) {
        const file = input.files[0];
        if (!file) return;

        const preview = document.getElementById('iconPreview');
        const wrapper = document.getElementById('previewWrapper');
        const placeholder = document.getElementById('uploadPlaceholder');
        const iconError = document.getElementById('iconError');
        const uploadBox = document.querySelector('label[for="iconInput"]');

        iconError.classList.add('hidden');
        uploadBox.classList.remove('border-red-500');

        const reader = new FileReader();

        reader.onload = function(e) {
            if (wrapper.classList.contains('hidden')) {
                preview.src = e.target.result;

                placeholder.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-300');

                setTimeout(() => {
                    placeholder.classList.add('hidden');
                    wrapper.classList.remove('hidden');
                    wrapper.classList.add('flex');

                    requestAnimationFrame(() => {
                        wrapper.classList.remove('opacity-0', 'scale-90');
                        wrapper.classList.add('opacity-100', 'scale-100');
                    });
                }, 250);
            } else {
                preview.classList.add('scale-75', 'opacity-0', 'rotate-6');

                setTimeout(() => {
                    preview.src = e.target.result;
                    preview.classList.remove('scale-75', 'rotate-6');
                    preview.classList.add('scale-125', 'opacity-0', '-rotate-6');
                    void preview.offsetWidth;
                    preview.classList.remove('scale-125', '-rotate-6', 'opacity-0');
                    preview.classList.add('scale-100', 'opacity-100');
                }, 220);
            }
        };

        reader.readAsDataURL(file);
    }

    function previewEditIcon(input) {
        const file = input.files[0];
        if (!file) return;

        const preview = document.getElementById('editIconPreview');
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.classList.add('scale-75', 'opacity-0');
            setTimeout(() => {
                preview.src = e.target.result;
                preview.classList.remove('scale-75', 'opacity-0');
            }, 180);
        };

        reader.readAsDataURL(file);
    }

    function validateManfaatForm() {
        const iconInput = document.getElementById('iconInput');
        const iconError = document.getElementById('iconError');
        const uploadBox = document.querySelector('label[for="iconInput"]');

        iconError.classList.add('hidden');
        uploadBox.classList.remove('border-red-500', 'animate-pulse');

        if (!iconInput.files.length) {
            iconError.textContent = 'Icon wajib diisi';
            iconError.classList.remove('hidden');
            uploadBox.classList.add('border-red-500', 'animate-pulse');

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], { duration: 450, easing: 'ease-in-out' });

            setTimeout(() => { uploadBox.classList.remove('animate-pulse'); }, 500);
            return false;
        }

        const file = iconInput.files[0];
        if (file && file.size > MAX_ICON_SIZE) {
            const maxMB = (MAX_ICON_SIZE / 1024 / 1024).toFixed(0);
            iconError.textContent = `Ukuran icon maksimal ${maxMB} MB`;
            iconError.classList.remove('hidden');
            uploadBox.classList.add('border-red-500', 'animate-pulse');

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], { duration: 450, easing: 'ease-in-out' });

            setTimeout(() => { uploadBox.classList.remove('animate-pulse'); }, 500);
            return false;
        }

        return true;
    }

    function validateEditManfaatForm() {
        const iconInput = document.getElementById('editIconInput');
        const iconError = document.getElementById('editIconError');
        const uploadBox = document.getElementById('editUploadBox');

        iconError.classList.add('hidden');
        uploadBox.classList.remove('border-red-500', 'animate-pulse');

        if (!iconInput.files.length) {
            return true;
        }

        const file = iconInput.files[0];
        if (file && file.size > MAX_ICON_SIZE) {
            const maxMB = (MAX_ICON_SIZE / 1024 / 1024).toFixed(0);
            iconError.textContent = `Ukuran icon maksimal ${maxMB} MB`;
            iconError.classList.remove('hidden');
            uploadBox.classList.add('border-red-500', 'animate-pulse');

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], { duration: 450, easing: 'ease-in-out' });

            setTimeout(() => { uploadBox.classList.remove('animate-pulse'); }, 500);
            return false;
        }

        return true;
    }

    function clearIconError() {
        const iconError = document.getElementById('iconError');
        const uploadBox = document.querySelector('label[for="iconInput"]');

        iconError.classList.add('hidden');
        uploadBox.classList.remove('border-red-500');
    }
</script>