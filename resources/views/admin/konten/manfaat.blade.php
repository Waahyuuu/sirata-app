<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2 pl-2 pr-2 pb-8">

    {{-- LIST MANFAAT --}}
    @forelse($manfaats as $manfaat)

    <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col items-center text-center
        shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300
        group relative overflow-hidden h-full">

        {{-- ACTION BUTTON --}}
        <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition">

            {{-- EDIT --}}
            <button onclick='openEditManfaatModal(@json($manfaat))'
                class="bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />

                </svg>

            </button>

            {{-- DELETE --}}
            <button onclick="openDeleteManfaatModal({{ $manfaat->id }})"
                class="bg-red-500 hover:bg-red-600 p-2 rounded-lg shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

        </div>

        {{-- ICON --}}
        <div class="w-26 h-26 mb-2 rounded-lg overflow-hidden">

            @if(Str::contains($manfaat->icon,'<svg')) {!! $manfaat->icon !!}
                @else
                <img src="{{ asset('storage/'.$manfaat->icon) }}" class="w-auto h-auto object-cover">
                @endif

        </div>

        {{-- TITLE --}}
        <p class="font-semibold text-gray-800 mb-2 w-full break-words">
            {{ $manfaat->title }}
        </p>

        {{-- DESCRIPTION --}}
        <p class="text-gray-500 text-sm line-clamp-4 w-full break-words text-justify">
            {{ $manfaat->description }}
        </p>

    </div>

    @empty

    <p class="text-gray-400 italic col-span-3">
        Belum ada manfaat
    </p>

    @endforelse

</div>

{{-- MODAL CREATE --}}
<div id="createManfaatModal" class="modal">

    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5">
            ➕ Tambah Manfaat
        </h2>

        <form action="{{ route('admin.konten.manfaat.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4" onsubmit="return validateManfaatForm()">

            @csrf

            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Judul
                </label>

                <input type="text" name="title" placeholder="Judul Manfaat"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl transition"
                    required />
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Deskripsi
                </label>

                <textarea name="description" placeholder="Deskripsi"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl transition"
                    required></textarea>
            </div>


            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Icon
                </label>

                <label for="iconInput"
                    class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer overflow-hidden group hover:border-blue-400 transition duration-300 bg-gradient-to-br from-gray-50 to-white">

                    <div id="uploadPlaceholder"
                        class="flex flex-col items-center justify-center text-center transition-all duration-300">

                        <div
                            class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-500 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path stroke-dasharray="32" d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9">
                                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                            values="32;0" />
                                    </path>
                                    <path stroke-dasharray="2 4" stroke-dashoffset="6"
                                        d="M12 21c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9" opacity="0">
                                        <set fill="freeze" attributeName="opacity" begin="0.45s" to="1" />
                                        <animateTransform fill="freeze" attributeName="transform" begin="0.45s"
                                            dur="0.6s" type="rotate" values="-180 12 12;0 12 12" />
                                        <animate attributeName="stroke-dashoffset" begin="0.85s" dur="0.6s"
                                            repeatCount="indefinite" to="0" />
                                    </path>
                                    <path stroke-dasharray="10" stroke-dashoffset="10" d="M12 16v-7.5">
                                        <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.85s"
                                            dur="0.2s" to="0" />
                                    </path>
                                    <path stroke-dasharray="8" stroke-dashoffset="8"
                                        d="M12 8.5l3.5 3.5M12 8.5l-3.5 3.5">
                                        <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.05s"
                                            dur="0.2s" to="0" />
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <p class="font-medium text-gray-700">
                            Pilih Icon
                        </p>

                        <span class="text-sm text-gray-400">
                            JPG, PNG, WEBP, SVG
                        </span>
                    </div>

                    <!-- Preview -->
                    <div id="previewWrapper"
                        class="absolute inset-0 hidden items-center justify-center bg-white transition-all duration-500 opacity-0 scale-90">

                        <img id="iconPreview" class="max-h-full object-contain transition-all duration-500 ease-out" />

                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span
                                class="bg-white text-gray-700 px-4 py-2 rounded-xl shadow-lg text-sm font-medium flex items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M8 2H4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2m12 12h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2M16.707 2.293a1 1 0 0 1 .083 1.32l-.083.094L15.414 5H19a3 3 0 0 1 2.995 2.824L22 8v3a1 1 0 0 1-1.993.117L20 11V8a1 1 0 0 0-.883-.993L19 7h-3.585l1.292 1.293a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a.98.98 0 0 1-.28-.872l.036-.146l.04-.104q.087-.191.245-.334l2.959-2.958a1 1 0 0 1 1.414 0M3 12a1 1 0 0 1 .993.883L4 13v3a1 1 0 0 0 .883.993L5 17h3.585l-1.292-1.293a1 1 0 0 1-.083-1.32l.083-.094a1 1 0 0 1 1.32-.083l.094.083l3 3a.98.98 0 0 1 .28.872l-.036.146l-.04.104a1 1 0 0 1-.245.334l-2.959 2.958a1 1 0 0 1-1.497-1.32l.083-.094L8.584 19H5a3 3 0 0 1-2.995-2.824L2 16v-3a1 1 0 0 1 1-1" />
                                </svg>

                                Replace

                            </span>
                        </div>
                    </div>

                    <input id="iconInput" type="file" name="icon_file" accept="image/*"
                        onchange="previewIcon(this); clearIconError()" class="hidden" />
                </label>
                <p id="iconError" class="hidden text-sm text-red-500 mt-2">
                    Icon wajib diisi
                </p>
            </div>

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeCreateManfaatModal()"
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
<div id="editManfaatModal" class="modal">

    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-md shadow-2xl border border-white/30">

        <h2 class="text-xl font-semibold mb-5">
            ✏️ Edit Manfaat
        </h2>

        <form id="editManfaatForm" method="POST" enctype="multipart/form-data" class="space-y-4"
            onsubmit="return validateEditManfaatForm()">

            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Judul
                </label>

                <input type="text" name="title" id="editManfaatTitle"
                    class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl transition"
                    required />
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Deskripsi
                </label>

                <textarea name="description" id="editManfaatDesc" rows="3" oninput="autoResize(this)"
                    class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl transition resize-none overflow-hidden"
                    required>
                </textarea>
            </div>

            {{-- ICON --}}
            <div>
                <label class="text-sm font-semibold text-gray-700 block mb-2">
                    Icon
                </label>

                <label for="editIconInput" id="editUploadBox"
                    class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer overflow-hidden group hover:border-yellow-400 transition duration-300 bg-gradient-to-br from-gray-50 to-white">

                    {{-- Preview --}}
                    <div id="editPreviewWrapper" class="absolute inset-0 flex items-center justify-center bg-white">

                        <img id="editIconPreview"
                            class="max-h-full object-contain transition-all duration-500 ease-out" />

                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                            <span
                                class="bg-white text-gray-700 px-4 py-2 rounded-xl shadow-lg text-sm font-medium flex items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M8 2H4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2m12 12h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2M16.707 2.293a1 1 0 0 1 .083 1.32l-.083.094L15.414 5H19a3 3 0 0 1 2.995 2.824L22 8v3a1 1 0 0 1-1.993.117L20 11V8a1 1 0 0 0-.883-.993L19 7h-3.585l1.292 1.293a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a.98.98 0 0 1-.28-.872l.036-.146l.04-.104q.087-.191.245-.334l2.959-2.958a1 1 0 0 1 1.414 0M3 12a1 1 0 0 1 .993.883L4 13v3a1 1 0 0 0 .883.993L5 17h3.585l-1.292-1.293a1 1 0 0 1-.083-1.32l.083-.094a1 1 0 0 1 1.32-.083l.094.083l3 3a.98.98 0 0 1 .28.872l-.036.146l-.04.104a1 1 0 0 1-.245.334l-2.959 2.958a1 1 0 0 1-1.497-1.32l.083-.094L8.584 19H5a3 3 0 0 1-2.995-2.824L2 16v-3a1 1 0 0 1 1-1" />
                                </svg>

                                Replace

                            </span>

                        </div>
                    </div>

                    <input id="editIconInput" type="file" name="icon_file" accept="image/*"
                        onchange="previewEditIcon(this)" class="hidden" />
                </label>

                <p id="editIconError" class="hidden text-sm text-red-500 mt-2">
                </p>
            </div>

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeModal('editManfaatModal')"
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

{{-- MODAL DELETE --}}
<div id="deleteManfaatModal" class="modal">

    <div
        class="modal-content bg-white/90 backdrop-blur-xl p-6 rounded-3xl w-full max-w-sm shadow-2xl border border-white/30 text-center">

        <div class="text-4xl mb-3">
            ⚠️
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mb-2">
            Hapus Manfaat?
        </h2>

        <p class="text-gray-500 text-sm mb-5">
            Data tidak bisa dikembalikan
        </p>

        <form id="deleteManfaatForm" method="POST">

            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">

                <button type="button" onclick="closeModal('deleteManfaatModal')"
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
    const MAX_ICON_SIZE =
        {{ ($maxIconSizeKB ?? 2048) * 1024 }};

    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height =
        textarea.scrollHeight + 'px';
    }

    function openModal(id){
        document.getElementById(id).classList.add('show');
    }

    function closeCreateManfaatModal() {

        const modal = document.getElementById(
            'createManfaatModal'
        );

        const form = modal.querySelector('form');

        // reset form input text & textarea
        form.reset();

        // reset file input
        const iconInput =
            document.getElementById('iconInput');

        iconInput.value = '';

        // reset preview image
        const preview =
            document.getElementById('iconPreview');

        const wrapper =
            document.getElementById(
                'previewWrapper'
            );

        const placeholder =
            document.getElementById(
                'uploadPlaceholder'
            );

        preview.src = '';

        wrapper.classList.add('hidden');
        wrapper.classList.remove(
            'flex',
            'opacity-100',
            'scale-100'
        );

        placeholder.classList.remove(
            'hidden',
            'opacity-0',
            'scale-95'
        );

        // reset error
        document.getElementById(
            'iconError'
        ).classList.add('hidden');

        // tutup modal
        modal.classList.remove('show');
    }

    function openEditManfaatModal(data) {

        document.getElementById(
            'editManfaatTitle'
        ).value = data.title;

        document.getElementById(
            'editManfaatDesc'
        ).value = data.description;

        document.getElementById(
            'editManfaatForm'
        ).action =
        `/admin/konten/manfaat/${data.id}`;

        const desc =
            document.getElementById(
            'editManfaatDesc'
        );

        desc.value =
            data.description;
        autoResize(desc);

        const preview =
            document.getElementById(
                'editIconPreview'
            );

        preview.src =
            data.icon.includes('<svg')
            ? 'data:image/svg+xml;base64,' +
                btoa(data.icon)
            : `/storage/${data.icon}`;

        // reset error
        document.getElementById(
            'editIconError'
        ).classList.add('hidden');

        document.getElementById(
            'editUploadBox'
        ).classList.remove(
            'border-red-500'
        );

        openModal(
            'editManfaatModal'
        );
    }

    function openDeleteManfaatModal(id){

        document.getElementById('deleteManfaatForm').action =
        `/admin/konten/manfaat/${id}`;

        openModal('deleteManfaatModal');
    }

    function previewIcon(input) {
        const file = input.files[0];
        if (!file) return;

        const preview = document.getElementById('iconPreview');
        const wrapper = document.getElementById('previewWrapper');
        const placeholder = document.getElementById('uploadPlaceholder');
        const iconError = document.getElementById('iconError');
        const uploadBox = document.querySelector(
            'label[for="iconInput"]'
        );

        // reset error
        iconError.classList.add('hidden');
        uploadBox.classList.remove('border-red-500');

        const reader = new FileReader();

        reader.onload = function(e) {

            if (wrapper.classList.contains('hidden')) {

                preview.src = e.target.result;

                placeholder.classList.add(
                    'opacity-0',
                    'scale-95',
                    'transition-all',
                    'duration-300'
                );

                setTimeout(() => {

                    placeholder.classList.add(
                        'hidden'
                    );

                    wrapper.classList.remove(
                        'hidden'
                    );

                    wrapper.classList.add(
                        'flex'
                    );

                    requestAnimationFrame(() => {
                        wrapper.classList.remove(
                            'opacity-0',
                            'scale-90'
                        );

                        wrapper.classList.add(
                            'opacity-100',
                            'scale-100'
                        );
                    });

                }, 250);

            } else {

                preview.classList.add(
                    'scale-75',
                    'opacity-0',
                    'rotate-6'
                );

                setTimeout(() => {

                    preview.src = e.target.result;

                    preview.classList.remove(
                        'scale-75',
                        'rotate-6'
                    );

                    preview.classList.add(
                        'scale-125',
                        'opacity-0',
                        '-rotate-6'
                    );

                    void preview.offsetWidth;

                    preview.classList.remove(
                        'scale-125',
                        '-rotate-6',
                        'opacity-0'
                    );

                    preview.classList.add(
                        'scale-100',
                        'opacity-100'
                    );

                }, 220);
            }

        };

        reader.readAsDataURL(file);
    }
    
    function previewEditIcon(input) {

        const file =
            input.files[0];

        if (!file) return;

        const preview =
            document.getElementById(
                'editIconPreview'
            );

        const reader =
            new FileReader();

        reader.onload =
        function(e) {

            preview.classList.add(
                'scale-75',
                'opacity-0'
            );

            setTimeout(() => {

                preview.src =
                    e.target.result;

                preview.classList.remove(
                    'scale-75',
                    'opacity-0'
                );

            }, 180);
        };

        reader.readAsDataURL(
            file
        );
    }

    function validateManfaatForm() {

        const iconInput =
            document.getElementById(
                'iconInput'
            );

        const iconError =
            document.getElementById(
                'iconError'
            );

        const uploadBox =
            document.querySelector(
                'label[for="iconInput"]'
            );

        iconError.classList.add(
            'hidden'
        );

        uploadBox.classList.remove(
            'border-red-500',
            'animate-pulse'
        );

        // WAJIB PILIH ICON
        if (!iconInput.files.length) {

            iconError.textContent =
                'Icon wajib diisi';

            iconError.classList.remove(
                'hidden'
            );

            uploadBox.classList.add(
                'border-red-500',
                'animate-pulse'
            );

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], {
                duration: 450,
                easing: 'ease-in-out'
            });

            setTimeout(() => {
                uploadBox.classList.remove(
                    'animate-pulse'
                );
            }, 500);

            return false;
        }

        // VALIDASI SIZE
        const file =
            iconInput.files[0];

        if (
            file &&
            file.size >
            MAX_ICON_SIZE
        ) {

            const maxMB =
                (
                    MAX_ICON_SIZE /
                    1024 /
                    1024
                ).toFixed(0);

            iconError.textContent =
                `Ukuran icon maksimal ${maxMB} MB`;

            iconError.classList.remove(
                'hidden'
            );

            uploadBox.classList.add(
                'border-red-500',
                'animate-pulse'
            );

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], {
                duration: 450,
                easing: 'ease-in-out'
            });

            setTimeout(() => {
                uploadBox.classList.remove(
                    'animate-pulse'
                );
            }, 500);

            return false;
        }

        return true;
    }

    function validateEditManfaatForm() {

        const iconInput =
            document.getElementById(
                'editIconInput'
            );

        const iconError =
            document.getElementById(
                'editIconError'
            );

        const uploadBox =
            document.getElementById(
                'editUploadBox'
            );

        iconError.classList.add(
            'hidden'
        );

        uploadBox.classList.remove(
            'border-red-500',
            'animate-pulse'
        );

        // ====================
        // TIDAK WAJIB UPLOAD
        // ====================
        if (
            !iconInput.files.length
        ) {
            return true;
        }

        // ====================
        // VALIDASI SIZE
        // ====================
        const file =
            iconInput.files[0];

        if (
            file &&
            file.size >
            MAX_ICON_SIZE
        ) {

            const maxMB =
                (
                    MAX_ICON_SIZE /
                    1024 /
                    1024
                ).toFixed(0);

            iconError.textContent =
                `Ukuran icon maksimal ${maxMB} MB`;

            iconError.classList.remove(
                'hidden'
            );

            uploadBox.classList.add(
                'border-red-500',
                'animate-pulse'
            );

            uploadBox.animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-8px)' },
                { transform: 'translateX(8px)' },
                { transform: 'translateX(-6px)' },
                { transform: 'translateX(6px)' },
                { transform: 'translateX(0)' }
            ], {
                duration: 450,
                easing: 'ease-in-out'
            });

            setTimeout(() => {
                uploadBox.classList.remove(
                    'animate-pulse'
                );
            }, 500);

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