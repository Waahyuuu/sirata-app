@extends('layouts.admin')

@section('title', 'Manajemen Pesan')

@section('content')

@php
$activeTab = request('tab', 'message');
@endphp

<div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col h-full" style="border-color: #ffd180;">

    {{-- TAB --}}
    <div class="flex gap-2 mb-6 p-1 rounded-xl w-fit" style="background-color: #fff8f0;">
        <button class="tab-btn {{ $activeTab == 'message' ? 'active-tab' : '' }}" data-tab="message">
            Pesan
        </button>

        <button class="tab-btn {{ $activeTab == 'notification' ? 'active-tab' : '' }}" data-tab="notification">
            Notifikasi
        </button>
    </div>

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h2 id="tabTitle" class="font-semibold text-lg" style="color: #2d2d2d;">
            Daftar Pesan
        </h2>

        <button id="deleteAllBtn" class="text-white px-3 py-2 rounded transition hover:shadow-md hidden"
            style="background: linear-gradient(135deg, #ef4444, #dc2626);"
            onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)';"
            onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    </div>

    {{-- CONTENT --}}
    <div class="overflow-y-auto custom-scrollbar">
        <div id="message" class="tab-content {{ $activeTab != 'message' ? 'hidden' : '' }}">
            @include('admin.pesan.message')
        </div>

        <div id="notification" class="tab-content {{ $activeTab != 'notification' ? 'hidden' : '' }}">
            @include('admin.pesan.notifikasi-pesan')
        </div>
    </div>

</div>

{{-- ================= MODAL ================= --}}

<div id="deleteConfirmModal"
    class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none flex items-center justify-center z-50 transition-all duration-300">

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

<script>
    const deleteRoutes = {
        message: "{{ route('admin.pesan.deleteAllMessage') }}"
    };

    document.addEventListener("DOMContentLoaded", function () {

        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        function activateTab(tabName){

            tabs.forEach(t => t.classList.remove('active-tab'));
            contents.forEach(c => c.classList.add('hidden'));

            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active-tab');
            document.getElementById(tabName).classList.remove('hidden');

            const title = document.getElementById('tabTitle');
            const deleteBtn = document.getElementById('deleteAllBtn');

            if(tabName === 'message'){

                title.innerText = 'Daftar Pesan';

                deleteBtn.classList.remove('hidden');
                deleteBtn.onclick = () => openDeleteModal('message');

            }

            if(tabName === 'notification'){

                title.innerText = 'Daftar Mahasiswa Cekal';

                deleteBtn.classList.add('hidden');

            }

        }

        tabs.forEach(tab=>{

            tab.addEventListener('click',()=>{

                const tabName = tab.dataset.tab;

                const url = new URL(window.location);
                url.searchParams.set('tab', tabName);
                window.history.replaceState({},'',url);

                activateTab(tabName);

            });

        });

        activateTab(new URLSearchParams(window.location.search).get('tab') || 'message');

    });

    let generatedCode = '';
    let currentDeleteType = '';

    function openDeleteModal(type){

        currentDeleteType = type;

        generatedCode = Math.random().toString(36).substring(2,7).toUpperCase();

        document.getElementById('randomCode').innerText = generatedCode;
        document.getElementById('confirmInput').value = '';
        document.getElementById('errorMessage').classList.add('hidden');

        const modal = document.getElementById('deleteConfirmModal');
        const box = document.getElementById('modalBox');

        modal.classList.remove('modal-show');
        box.classList.remove('modal-box-show');

        void modal.offsetWidth;

        modal.classList.add('modal-show');

        setTimeout(()=>{

            box.classList.add('modal-box-show');

        },50);

    }

    function closeDeleteModal(){

        const modal = document.getElementById('deleteConfirmModal');
        const box = document.getElementById('modalBox');

        box.classList.remove('modal-box-show');

        setTimeout(()=>{

            modal.classList.remove('modal-show');

        },200);

    }

    document.getElementById('deleteConfirmModal').addEventListener('click',function(e){

        if(e.target===this){

            closeDeleteModal();

        }

    });

    function submitDelete(){

        const input = document.getElementById('confirmInput');
        const error = document.getElementById('errorMessage');

        error.classList.add('hidden');

        if(input.value.trim()===''){

            error.innerText='Kode wajib diisi!';
            error.classList.remove('hidden');

            return;

        }

        if(input.value.trim()!==generatedCode){

            error.innerText='Kode tidak sesuai!';
            error.classList.remove('hidden');

            return;

        }

        const form=document.createElement('form');

        form.method='POST';
        form.action=deleteRoutes[currentDeleteType];

        form.innerHTML=`
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        `;

        document.body.appendChild(form);
        form.submit();

    }
</script>

<style>
    /* ========================================
       STYLE ADMIN INDEX
       ======================================== */

    /* Tab Button */
    .tab-btn {
        padding: 8px 18px;
        border-radius: 10px;
        font-weight: 500;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .tab-btn:hover {
        background: white;
        transform: translateY(-1px);
    }

    .active-tab {
        background: white;
        color: #ff6900;
    }

    /* Modal */
    .modal-show {
        opacity: 1 !important;
        pointer-events: auto !important;
    }

    .modal-box-show {
        opacity: 1 !important;
        transform: scale(1) translateY(0) !important;
    }

    #modalBox {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-4px); }
        50% { transform: translateX(4px); }
        75% { transform: translateX(-4px); }
        100% { transform: translateX(0); }
    }

    .shake {
        animation: shake 0.3s;
    }

    .chat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        max-width: 100%;
        overflow: hidden;
        padding-bottom: 8px;
    }

    .chat-card {
        max-width: 100%;
        min-width: 0;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-word;
        box-sizing: border-box;
    }

    .chat-card * {
        max-width: 100% !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        box-sizing: border-box !important;
    }

    .chat-preview {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 100%;
        line-height: 1.5;
        max-height: 3em;
    }

    .chat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    }

    /* ========================================
       RESPONSIVE
       ======================================== */

    @media (max-width: 640px) {
        .chat-grid {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        .chat-card {
            padding: 1rem !important;
        }
    }

    @media (min-width: 641px) and (max-width: 1024px) {
        .chat-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>

@endsection