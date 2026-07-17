@extends('layouts.admin')

@section('title', 'Manajemen Konten')

@section('content')

@php
$activeTab = request('tab', 'manfaat');
@endphp

<div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col h-full" style="border-color: #ffd180;">

    {{-- TAB BUTTON --}}
    <div class="flex gap-2 mb-6 p-1 rounded-xl w-fit" style="background-color: #fff8f0;">
        <button class="tab-btn {{ $activeTab == 'manfaat' ? 'active-tab' : '' }}" data-tab="manfaat">Manfaat</button>

        <button class="tab-btn {{ $activeTab == 'faq' ? 'active-tab' : '' }}" data-tab="faq">FAQ</button>

        <button class="tab-btn {{ $activeTab == 'link' ? 'active-tab' : '' }}" data-tab="link">Link</button>
    </div>

    {{-- HEADER --}}
    <div id="tabHeader" class="flex justify-between items-center mb-4">
        <h2 id="tabTitle" class="font-semibold text-lg" style="color: #2d2d2d;">
            @if($activeTab == 'faq')
            Daftar FAQ
            @elseif($activeTab == 'link')
            Daftar Link
            @else
            Daftar Manfaat
            @endif
        </h2>

        <div class="flex gap-2">
            <button id="deleteAllBtn"
                class="text-white px-3 py-2 rounded transition hover:shadow-md hidden"
                style="background: linear-gradient(135deg, #ef4444, #dc2626);"
                onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>

            <button id="tabButton" class="text-white px-4 py-2 rounded transition hover:shadow-md hidden"
                style="background: linear-gradient(135deg, #ff6900, #f54a00);"
                onmouseover="this.style.background='linear-gradient(135deg, #f54a00, #e65100)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ff6900, #f54a00)';">
                + Tambah
            </button>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="overflow-y-auto custom-scroll">
        <div class="tab-content {{ $activeTab != 'manfaat' ? 'hidden' : '' }}" id="manfaat">
            @include('admin.konten.manfaat')
        </div>

        <div class="tab-content {{ $activeTab != 'faq' ? 'hidden' : '' }}" id="faq">
            @include('admin.konten.faq')
        </div>

        <div class="tab-content {{ $activeTab != 'link' ? 'hidden' : '' }}" id="link">
            @include('admin.konten.link')
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="deleteConfirmModal"
    class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center z-50">

    <div id="modalBox"
        class="bg-white rounded-2xl p-6 w-full max-w-md transform scale-95 translate-y-4 opacity-0 transition-all duration-300"
        style="border: 1px solid #ffd180;">

        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold" style="color: #dc2626;">Konfirmasi Hapus Semua</h3>
        </div>

        <p class="text-sm mb-4" style="color: #6b7280;">
            Anda akan menghapus semua data. Ketik kode berikut untuk melanjutkan:
        </p>

        <div id="randomCode" class="text-center font-mono text-lg py-2 rounded mb-3" style="background-color: #fff8f0; border: 1px solid #ffd180; color: #2d2d2d;"></div>

        <input type="text" id="confirmInput"
            class="w-full border rounded-lg px-3 py-2 mb-2 focus:outline-none transition"
            style="border-color: #ffd180;"
            onfocus="this.style.borderColor='#ff6900'; this.style.boxShadow='0 0 0 3px rgba(255, 105, 0, 0.1)';"
            onblur="this.style.borderColor='#ffd180'; this.style.boxShadow='none';"
            placeholder="Masukkan kode">

        <div id="errorMessage" class="text-sm mb-3 hidden" style="color: #ef4444;"></div>

        <div class="flex justify-end gap-2">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded transition hover:shadow-sm"
                style="background-color: #f3f4f6; color: #6b7280;"
                onmouseover="this.style.backgroundColor='#e5e7eb';"
                onmouseout="this.style.backgroundColor='#f3f4f6';">
                Batal
            </button>

            <button onclick="submitDelete()" class="px-4 py-2 rounded text-white transition hover:shadow-md"
                style="background: linear-gradient(135deg, #ef4444, #dc2626);"
                onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
                onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
                Hapus Semua
            </button>
        </div>

    </div>
</div>

{{-- ROUTE --}}
<script>
    const deleteRoutes = {
        faq: "{{ route('admin.konten.faq.deleteAll') }}",
        link: "{{ route('admin.konten.link.deleteAll') }}",
        manfaat: "{{ route('admin.konten.manfaat.deleteAll') }}"
    };
</script>

{{-- SCRIPT --}}
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

        button.classList.remove('hidden');
        deleteBtn.classList.remove('hidden');

        if (tabName === 'manfaat') {

            title.innerText = 'Daftar Manfaat';
            button.innerText = '+ Tambah Manfaat';

            button.onclick = () => openModal('createManfaatModal');
            deleteBtn.onclick = () => openDeleteConfirm('manfaat');

        }

        if (tabName === 'faq') {

            title.innerText = 'Daftar FAQ';
            button.innerText = '+ Tambah FAQ';

            button.onclick = () => openModal('createModal');
            deleteBtn.onclick = () => openDeleteConfirm('faq');

        }

        if (tabName === 'link') {

            title.innerText = 'Daftar Link';
            button.innerText = '+ Tambah Link';

            button.onclick = () => openModal('createLinkModal');
            deleteBtn.onclick = () => openDeleteConfirm('link');

        }

    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {

            const tabName = tab.dataset.tab;

            // update URL TANPA reload
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            window.history.replaceState({}, '', url);

            activateTab(tabName);
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    let currentTab = urlParams.get('tab') || 'manfaat';

    if (!document.getElementById(currentTab)) {
        currentTab = 'manfaat';
    }

    activateTab(currentTab);
});

let deleteTarget = null;
let generatedCode = null;

function openDeleteConfirm(type) {
    deleteTarget = type;
    generatedCode = Math.random().toString(36).substring(2, 7).toUpperCase();

    document.getElementById('randomCode').innerText = generatedCode;

    const modal = document.getElementById('deleteConfirmModal');
    const box = document.getElementById('modalBox');
    const input = document.getElementById('confirmInput');
    const error = document.getElementById('errorMessage');

    input.value = '';
    error.classList.add('hidden');

    modal.classList.add('modal-show');

    setTimeout(() => {
        box.classList.add('modal-box-show');
    }, 50);

    setTimeout(() => input.focus(), 200);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteConfirmModal');
    const box = document.getElementById('modalBox');

    box.classList.remove('modal-box-show');

    setTimeout(() => {
        modal.classList.remove('modal-show');
    }, 200);
}

document.getElementById('deleteConfirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

function submitDelete() {
    const input = document.getElementById('confirmInput');
    const error = document.getElementById('errorMessage');
    const value = input.value;

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
        window.location.href = deleteRoutes[deleteTarget];
    }, 300);
}
</script>

@endsection