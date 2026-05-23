@extends('layouts.admin')

@section('title', 'Manajemen Akun')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col h-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-5">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Daftar Akun Admin
            </h2>
            <p class="text-sm text-gray-500">
                Kelola akun administrator sistem
            </p>
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

                        <td class="text-center px-4 py-3">
                            {{ $index + 1 }}
                        </td>

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

        <h3 class="text-xl font-bold mb-5">
            Tambah Admin
        </h3>

        <form action="{{ route('admin.akun.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-200 outline-none" required>

            <div class="flex rounded-xl border overflow-hidden focus-within:ring-2 focus-within:ring-blue-200">

                <input type="text" name="email" placeholder="username" class="flex-1 px-4 py-3 outline-none" required
                    pattern="[a-zA-Z0-9._]+" title="Masukkan username email tanpa @">

                <div class="bg-gray-100 px-4 flex items-center text-gray-600 text-sm border-l">
                    @stimata.ac.id
                </div>
            </div>

            <div class="space-y-3">

                <label class="font-medium text-sm text-gray-700">
                    Password
                </label>

                <div class="flex gap-4 text-sm">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="password_type" value="auto" checked onchange="togglePasswordMode()">
                        Otomatis
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="password_type" value="manual" onchange="togglePasswordMode()">
                        Manual
                    </label>

                </div>

                <div class="relative">

                    <input type="text" name="password" id="passwordInput" readonly minlength="8" required class="w-full border rounded-xl px-4 py-3 pr-28
                        bg-gray-50 focus:ring-2 focus:ring-blue-200 outline-none">

                    <button type="button" id="generateBtn" onclick="generatePassword()" class="absolute right-2 top-1/2 -translate-y-1/2
                        px-3 py-1.5 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">
                        Generate
                    </button>

                    <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility()"
                        class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">

                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0
                                3 3 0 016 0zm2.458 5.458C15.732
                                18.732 13.94 19.5 12 19.5c-4.5
                                0-8.268-3.11-9.542-7.5
                                1.274-4.39 5.042-7.5
                                9.542-7.5 4.5 0 8.268
                                3.11 9.542 7.5-.548
                                1.887-1.548 3.57-2.842 4.958z" />
                        </svg>

                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05
                                10.05 0 0112 19c-4.478
                                0-8.268-2.943-9.543-7
                                a9.956 9.956 0 012.293-3.95m3.1-2.347A9.956
                                9.956 0 0112 5c4.478 0
                                8.268 2.943 9.543 7a9.96
                                9.96 0 01-4.293 5.274M15
                                12a3 3 0 11-6 0 3
                                3 0 016 0zm-9 9l18-18" />
                        </svg>

                    </button>
                </div>

                <p class="text-xs text-gray-500">
                    Password minimal 8 karakter
                </p>

            </div>

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

        <h3 class="text-xl font-bold mb-5">
            Edit Admin
        </h3>

        <form id="editForm" action="" method="POST" class="space-y-4">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="edit_name"
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-200 outline-none" required>

            <div class="flex rounded-xl border overflow-hidden focus-within:ring-2 focus-within:ring-yellow-200">

                <input type="text" name="email" id="edit_email" class="flex-1 px-4 py-3 outline-none" required
                    pattern="[a-zA-Z0-9._]+">

                <div class="bg-gray-100 px-4 flex items-center text-gray-600 text-sm border-l">
                    @stimata.ac.id
                </div>
            </div>

            <div class="space-y-3">

                <label class="font-medium text-sm text-gray-700">
                    Password
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" id="changePasswordCheck" onchange="toggleEditPassword()">

                    Ganti Password
                </label>

                <div id="editPasswordArea" class="hidden space-y-3">

                    <div class="flex gap-4 text-sm">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="edit_password_type" value="auto" checked
                                onchange="toggleEditPasswordMode()">

                            Otomatis
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="edit_password_type" value="manual"
                                onchange="toggleEditPasswordMode()">

                            Manual
                        </label>
                    </div>

                    <div class="relative">

                        <input type="text" name="password" id="editPasswordInput" minlength="8" readonly class="w-full border rounded-xl px-4 py-3 pr-28
                            bg-gray-50 focus:ring-2 focus:ring-yellow-200 outline-none">

                        <button type="button" id="editGenerateBtn" onclick="generateEditPassword()" class="absolute right-2 top-1/2 -translate-y-1/2
                            px-3 py-1.5 bg-yellow-500 text-white text-xs rounded-lg">

                            Generate
                        </button>

                        <button type="button" id="editTogglePasswordBtn" onclick="toggleEditPasswordVisibility()"
                            class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">

                            <svg id="editEyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0
                                    3 3 0 016 0zm2.458 5.458C15.732
                                    18.732 13.94 19.5 12 19.5c-4.5
                                    0-8.268-3.11-9.542-7.5
                                    1.274-4.39 5.042-7.5
                                    9.542-7.5 4.5 0 8.268
                                    3.11 9.542 7.5-.548
                                    1.887-1.548 3.57-2.842 4.958z" />
                            </svg>

                            <svg id="editEyeClosed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05
                                    10.05 0 0112 19c-4.478
                                    0-8.268-2.943-9.543-7
                                    a9.956 9.956 0 012.293-3.95m3.1-2.347A9.956
                                    9.956 0 0112 5c4.478 0
                                    8.268 2.943 9.543 7a9.96
                                    9.96 0 01-4.293 5.274M15
                                    12a3 3 0 11-6 0 3
                                    3 0 016 0zm-9 9l18-18" />
                            </svg>

                        </button>

                    </div>

                    <p class="text-xs text-gray-500">
                        Password minimal 8 karakter
                    </p>

                </div>

            </div>

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

{{-- DELETE MODAL --}}
<div id="deleteAdminModal" class="modal">
    <div class="modal-content bg-white p-6 rounded-3xl w-full max-w-sm shadow-xl text-center">

        <div class="text-4xl mb-3">
            ⚠️
        </div>

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
</style>

<script>
    function openModal(id){
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id){
        document.getElementById(id).classList.remove('show');
    }

    function openEditModal(id,name,email){

        let username = email.replace('@stimata.ac.id', '');

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = username;

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

    function generatePassword(length = 10){

        const chars =
            'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789@#$';

        let password = '';

        for(let i = 0; i < length; i++){
            password += chars.charAt(
                Math.floor(Math.random() * chars.length)
            );
        }

        document.getElementById('passwordInput').value = password;
    }

    function togglePasswordMode(){

        const mode =
            document.querySelector(
                'input[name="password_type"]:checked'
            ).value;

        const input =
            document.getElementById('passwordInput');

        const generateBtn =
            document.getElementById('generateBtn');

        const toggleBtn =
            document.getElementById('togglePasswordBtn');

        if(mode === 'manual'){

            input.readOnly = false;
            input.value = '';
            input.type = 'password';
            input.placeholder = 'Masukkan password';
            input.classList.remove('bg-gray-50');

            generateBtn.style.display = 'none';
            toggleBtn.classList.remove('hidden');

        } else {

            input.readOnly = true;
            input.type = 'text';
            input.placeholder = '';
            input.classList.add('bg-gray-50');

            generateBtn.style.display = 'block';
            toggleBtn.classList.add('hidden');

            generatePassword();
        }
    }

    function togglePasswordVisibility(){

        const input =
            document.getElementById('passwordInput');

        const eyeOpen =
            document.getElementById('eyeOpen');

        const eyeClosed =
            document.getElementById('eyeClosed');

        if(input.type === 'password'){

            input.type = 'text';

            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');

        } else {

            input.type = 'password';

            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }

    function toggleEditPassword(){

        const checked =
            document.getElementById(
                'changePasswordCheck'
            ).checked;

        const area =
            document.getElementById(
                'editPasswordArea'
            );

        const input =
            document.getElementById(
                'editPasswordInput'
            );

        if(checked){

            area.classList.remove('hidden');

            input.required = true;

            generateEditPassword();

        }else{

            area.classList.add('hidden');

            input.required = false;
            input.value = '';
        }
    }

    function generateEditPassword(length = 10){

        const chars =
            'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789@#$';

        let password = '';

        for(let i = 0; i < length; i++){
            password += chars.charAt(
                Math.floor(Math.random() * chars.length)
            );
        }

        document.getElementById(
            'editPasswordInput'
        ).value = password;
    }

    function toggleEditPasswordMode(){

        const mode =
            document.querySelector(
                'input[name="edit_password_type"]:checked'
            ).value;

        const input =
            document.getElementById(
                'editPasswordInput'
            );

        const generateBtn =
            document.getElementById(
                'editGenerateBtn'
            );

        const eyeBtn =
            document.getElementById(
                'editTogglePasswordBtn'
            );

        if(mode === 'manual'){

            input.readOnly = false;
            input.type = 'password';
            input.value = '';
            input.placeholder = 'Masukkan password baru';
            input.classList.remove('bg-gray-50');

            generateBtn.style.display =
                'none';

            eyeBtn.classList.remove(
                'hidden'
            );

        } else {

            input.readOnly = true;
            input.type = 'text';

            generateBtn.style.display =
                'block';

            eyeBtn.classList.add(
                'hidden'
            );

            generateEditPassword();
        }
    }

    function toggleEditPasswordVisibility(){

        const input =
            document.getElementById(
                'editPasswordInput'
            );

        const eyeOpen =
            document.getElementById(
                'editEyeOpen'
            );

        const eyeClosed =
            document.getElementById(
                'editEyeClosed'
            );

        if(input.type === 'password'){

            input.type = 'text';

            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');

        }else{

            input.type = 'password';

            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
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

    document.addEventListener('DOMContentLoaded', function(){
        generatePassword();
    });
</script>

@endsection