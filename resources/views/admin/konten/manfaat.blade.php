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
        <div class="w-20 h-20 flex items-center justify-center text-blue-500 mb-4">

            @if(Str::contains($manfaat->icon,'<svg')) {!! $manfaat->icon !!}
                @else
                <img src="{{ asset('storage/'.$manfaat->icon) }}" class="w-16 h-16 object-contain">
                @endif

        </div>

        {{-- TITLE --}}
        <p class="font-semibold text-gray-800 mb-2 break-words">
            {{ $manfaat->title }}
        </p>

        {{-- DESCRIPTION --}}
        <p class="text-gray-500 text-sm line-clamp-4 break-words">
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
            class="space-y-4">

            @csrf

            <input type="text" name="title" placeholder="Judul Manfaat"
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl outline-none transition"
                required />

            <textarea name="description" placeholder="Deskripsi"
                class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl outline-none transition"
                required></textarea>

            <label class="text-sm font-semibold text-gray-700">
                Icon
            </label>

            <div class="flex gap-2">

                <button type="button" onclick="setIconType('file')" id="btn-file" class="icon-btn active">
                    File
                </button>

                <button type="button" onclick="setIconType('svg')" id="btn-svg" class="icon-btn">
                    SVG
                </button>

            </div>

            <div id="iconPreview"
                class="w-16 h-16 flex items-center justify-center border rounded-xl bg-gray-50 text-blue-500">

                <span class="text-xs text-gray-400">
                    Preview
                </span>

            </div>

            <div id="icon-file">

                <input type="file" name="icon_file" accept="image/*" onchange="previewIconFile(this)"
                    class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-2 rounded-xl outline-none transition" />

            </div>

            <div id="icon-svg" class="hidden">

                <textarea name="icon_svg" rows="4" placeholder="<svg ...></svg>" oninput="previewSvg(this.value)"
                    class="w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl outline-none transition font-mono text-sm"></textarea>

            </div>

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeModal('createManfaatModal')"
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

        <form id="editManfaatForm" method="POST" enctype="multipart/form-data" class="space-y-4">

            @csrf
            @method('PUT')

            <input type="text" name="title" id="editManfaatTitle"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl outline-none transition" />

            <textarea name="description" id="editManfaatDesc"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl outline-none transition"></textarea>



            <input type="file" name="icon_file" accept="image/*"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-2 rounded-xl outline-none transition" />


            <textarea name="icon_svg" rows="3" placeholder="<svg ...></svg>"
                class="w-full border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 p-3 rounded-xl outline-none transition font-mono text-sm"></textarea>

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
    function openModal(id){
    document.getElementById(id).classList.add('show');
}

function closeModal(id){
    document.getElementById(id).classList.remove('show');
}

function openEditManfaatModal(data){

    document.getElementById('editManfaatTitle').value = data.title;
    document.getElementById('editManfaatDesc').value = data.description;

    document.getElementById('editManfaatForm').action =
    `/admin/konten/manfaat/${data.id}`;

    openModal('editManfaatModal');
}

function openDeleteManfaatModal(id){

    document.getElementById('deleteManfaatForm').action =
    `/admin/konten/manfaat/${id}`;

    openModal('deleteManfaatModal');
}

function setIconType(type){

    document.getElementById('icon-file').classList.add('hidden');
    document.getElementById('icon-svg').classList.add('hidden');

    document.getElementById('btn-file').classList.remove('active');
    document.getElementById('btn-svg').classList.remove('active');

    if(type === 'file'){
        document.getElementById('icon-file').classList.remove('hidden');
        document.getElementById('btn-file').classList.add('active');
    }

    if(type === 'svg'){
        document.getElementById('icon-svg').classList.remove('hidden');
        document.getElementById('btn-svg').classList.add('active');
    }

}

function previewIconFile(input){

    const preview = document.getElementById('iconPreview');

    if(input.files && input.files[0]){

        const reader = new FileReader();

        reader.onload = function(e){

            preview.innerHTML =
            `<img src="${e.target.result}" class="w-10 h-10 object-contain">`;

        }

        reader.readAsDataURL(input.files[0]);
    }
}

function previewSvg(svg){

    const preview = document.getElementById('iconPreview');

    if(svg.trim().startsWith('<svg')){
        preview.innerHTML = svg;
    }else{
        preview.innerHTML =
        '<span class="text-xs text-gray-400">Invalid SVG</span>';
    }
}
</script>

<style>
    .icon-btn {
        padding: 6px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        font-size: 14px;
    }

    .icon-btn.active {
        background: #3b82f6;
        color: white;
    }

    #iconPreview svg {
        width: 32px;
        height: 32px;
    }
</style>