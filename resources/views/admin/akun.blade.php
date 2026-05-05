@extends('layouts.admin')

@section('title', 'Manajemen Akun')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col h-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-5">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Akun Admin</h2>
            <p class="text-sm text-gray-500">Kelola akun administrator sistem</p>
        </div>

        <button onclick="openModal('createAdminModal')"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl shadow-sm transition">
            + Tambah Admin
        </button>
    </div>

    {{-- CONTENT --}}
    <div class="overflow-y-auto pr-2 custom-scroll">
        <div class="overflow-x-auto border rounded-2xl">

            <table class="w-full text-sm text-left">
                <thead class="sticky top-0 bg-gray-100 z-10">
                    <tr class="text-gray-700 text-center">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Dibuat</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($admins as $index => $admin)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="text-center px-4 py-3">{{ $index + 1 }}</td>

                        <td class="px-4 py-3 font-semibold text-gray-800">
                            {{ $admin->name }}
                        </td>

                        <td class="text-center px-4 py-3 text-gray-600">
                            {{ $admin->email }}
                        </td>

                        <td class="text-center px-4 py-3">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                {{ ucfirst($admin->role) }}
                            </span>
                        </td>

                        <td class="text-center px-4 py-3 text-gray-500">
                            {{ $admin->created_at->format('d M Y') }}
                        </td>

                        <td class="text-center px-4 py-3">
                            <div class="flex gap-2 justify-center">

                                {{-- EDIT --}}
                                <button onclick="openEditModal(
                                    '{{ $admin->id }}',
                                    '{{ $admin->name }}',
                                    '{{ $admin->email }}'
                                )"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-xs shadow-sm">
                                    Edit
                                </button>

                                {{-- DELETE --}}
                                @if(!$admin->is_protected)
                                <button type="button" onclick="openDeleteModal('{{ $admin->id }}','{{ $admin->name }}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs shadow-sm">
                                    Hapus
                                </button>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400">
                            Belum ada akun admin
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

<div id="createAdminModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-3xl w-full max-w-md shadow-xl">

        <h3 class="text-xl font-bold mb-5">Tambah Admin</h3>

        <form action="{{ route('admin.akun.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-200 outline-none" required>

            <input type="email" name="email" placeholder="Email"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-200 outline-none" required>

            <input type="password" name="password" placeholder="Password"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-200 outline-none" required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal('createAdminModal')"
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<div id="editAdminModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-3xl w-full max-w-md shadow-xl">

        <h3 class="text-xl font-bold mb-5">Edit Admin</h3>

        <form id="editForm" action="" method="POST" class="space-y-4">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="edit_name"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-200 outline-none" required>

            <input type="email" name="email" id="edit_email"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-200 outline-none" required>

            <input type="password" name="password" placeholder="Kosongkan jika tidak diganti"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-200 outline-none">

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal('editAdminModal')"
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>

{{-- =========================
MODAL DELETE
========================= --}}
<div id="deleteAdminModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-3xl w-full max-w-sm shadow-xl text-center">

        <div class="text-4xl mb-3">⚠️</div>

        <h3 class="text-lg font-bold text-gray-800 mb-2">
            Hapus Admin?
        </h3>

        <p class="text-sm text-gray-500 mb-5">
            Akun
            <span id="deleteAdminName" class="font-semibold text-gray-700"></span>
            akan dihapus permanen.
        </p>

        <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('deleteAdminModal')"
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

{{-- =========================
STYLE
========================= --}}
<style>
    .modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .45);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: .25s;
        z-index: 999;
    }

    .modal.show {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-content {
        transform: translateY(20px) scale(.96);
        transition: .25s;
    }

    .modal.show .modal-content {
        transform: translateY(0) scale(1);
    }

    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
</style>

{{-- =========================
SCRIPT
========================= --}}
<script>
    function openModal(id){
    document.getElementById(id).classList.add('show');
}

function closeModal(id){
    document.getElementById(id).classList.remove('show');
}

function openEditModal(id,name,email){
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;

    document.getElementById('editForm').action =
        "{{ url('admin/akun/update') }}/" + id;

    openModal('editAdminModal');
}

function openDeleteModal(id,name){
    document.getElementById('deleteAdminName').innerText = name;

    document.getElementById('deleteForm').action =
        "{{ url('admin/akun/destroy') }}/" + id;

    openModal('deleteAdminModal');
}

document.querySelectorAll('.modal').forEach(modal=>{
    modal.addEventListener('click',function(e){
        if(e.target === this){
            this.classList.remove('show');
        }
    });
});

document.addEventListener('keydown',function(e){
    if(e.key === 'Escape'){
        document.querySelectorAll('.modal').forEach(m=>{
            m.classList.remove('show');
        });
    }
});
</script>

@endsection