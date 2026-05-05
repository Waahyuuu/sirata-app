@extends('layouts.admin')

@section('title', 'Manajemen Pesan')

@section('content')

@php
$activeTab = request('tab', 'message');
@endphp

<div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col h-full">

    {{-- TAB --}}
    <div class="flex gap-2 mb-6 bg-gray-100 p-1 rounded-xl w-fit">
        <button class="tab-btn {{ $activeTab == 'message' ? 'active-tab' : '' }}" data-tab="message">
            Pesan
        </button>

        <button class="tab-btn {{ $activeTab == 'setting' ? 'active-tab' : '' }}" data-tab="setting">
            ChatBot
        </button>
    </div>

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h2 id="tabTitle" class="font-semibold text-lg">Daftar Pesan</h2>

        <div class="flex gap-2">
            <button id="deleteAllBtn"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <button id="tabButton" class="bg-blue-500 text-white px-4 py-2 rounded hidden">
                + Tambah
            </button>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="overflow-y-auto2">

        <div id="message" class="tab-content {{ $activeTab != 'message' ? 'hidden' : '' }}">
            @include('admin.pesan.message')
        </div>

        <div id="setting" class="tab-content {{ $activeTab != 'setting' ? 'hidden' : '' }}">
            @include('admin.pesan.setting-chatbot')
        </div>

    </div>
</div>

{{-- ================= MODAL ================= --}}
<div id="deleteConfirmModal"
    class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none flex items-center justify-center z-50 transition-all duration-300">

    <div id="modalBox"
        class="bg-white rounded-2xl p-6 w-full max-w-md transform scale-95 translate-y-4 opacity-0 transition-all duration-300">

        <h3 class="text-lg font-bold mb-2 text-red-600">
            Konfirmasi Hapus Semua
        </h3>

        <p class="text-sm text-gray-500 mb-4">
            Anda akan menghapus semua data. Ketik kode berikut untuk melanjutkan:
        </p>

        <div id="randomCode" class="bg-gray-100 text-center font-mono text-lg py-2 rounded mb-3"></div>

        <input type="text" id="confirmInput"
            class="w-full border rounded-lg px-3 py-2 mb-2 focus:outline-none focus:ring focus:ring-red-200"
            placeholder="Masukkan kode">

        <div id="errorMessage" class="text-red-500 text-sm mb-3 hidden"></div>

        <div class="flex justify-end gap-2">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                Batal
            </button>

            <button onclick="submitDelete()" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                Hapus Semua
            </button>
        </div>

    </div>
</div>

<script>
    const deleteRoutes = {
        message: "{{ route('admin.pesan.deleteAllMessage') }}",
        setting: "{{ route('admin.pesan.deleteAll') }}"
    };
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        function activateTab(tabName) {

            tabs.forEach(t => t.classList.remove('active-tab'));
            contents.forEach(c => c.classList.add('hidden'));

            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active-tab');
            document.getElementById(tabName).classList.remove('hidden');

            const title = document.getElementById('tabTitle');
            const button = document.getElementById('tabButton');
            const deleteBtn = document.getElementById('deleteAllBtn');

            if (tabName === 'message') {
                title.innerText = 'Daftar Pesan';

                button.classList.add('hidden');

                deleteBtn.classList.remove('hidden');
                deleteBtn.onclick = () => openDeleteModal('message');
            }

            if (tabName === 'setting') {
                title.innerText = 'Daftar Chatbot';

                button.classList.remove('hidden');
                deleteBtn.classList.remove('hidden');

                button.innerText = '+ Tambah Rule';
                button.onclick = () => openModal('createRuleModal');

                deleteBtn.onclick = () => openDeleteModal('setting');
            }
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {

                const tabName = tab.dataset.tab;

                const url = new URL(window.location);
                url.searchParams.set('tab', tabName);
                window.history.replaceState({}, '', url);

                activateTab(tabName);
            });
        });

        let currentTab = new URLSearchParams(window.location.search).get('tab') || 'message';
        activateTab(currentTab);
    });

    let generatedCode = null;
    let currentDeleteType = null;

    function openDeleteModal(type) {

        currentDeleteType = type;

        generatedCode = Math.random().toString(36).substring(2, 7).toUpperCase();

        document.getElementById('randomCode').innerText = generatedCode;
        document.getElementById('confirmInput').value = '';
        document.getElementById('errorMessage').classList.add('hidden');

        const modal = document.getElementById('deleteConfirmModal');
        const box = document.getElementById('modalBox');

        modal.classList.remove('modal-show');
        box.classList.remove('modal-box-show');

        void modal.offsetWidth;

        modal.classList.add('modal-show');

        setTimeout(() => {
            box.classList.add('modal-box-show');
        }, 50);
    }

    function closeDeleteModal() {

        const modal = document.getElementById('deleteConfirmModal');
        const box = document.getElementById('modalBox');

        box.classList.remove('modal-box-show');

        setTimeout(() => {
            modal.classList.remove('modal-show');
        }, 200);
    }

    document.getElementById('deleteConfirmModal')
        .addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

    function submitDelete() {

        const input = document.getElementById('confirmInput');
        const error = document.getElementById('errorMessage');

        const value = input.value.trim();

        error.classList.add('hidden');

        if (!value) {
            error.innerText = 'Kode wajib diisi!';
            error.classList.remove('hidden');
            input.classList.add('shake');
            setTimeout(() => input.classList.remove('shake'), 300);
            return;
        }

        if (value !== generatedCode) {
            error.innerText = 'Kode tidak sesuai!';
            error.classList.remove('hidden');
            input.classList.add('shake');
            setTimeout(() => input.classList.remove('shake'), 300);
            return;
        }

        closeDeleteModal();

        setTimeout(() => {

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteRoutes[currentDeleteType];

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";

            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';

            form.appendChild(csrf);
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();

        }, 200);
    }
</script>

@endsection