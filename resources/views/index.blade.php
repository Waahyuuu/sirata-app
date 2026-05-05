@extends('layouts.app')

@section('content')

<x-loading-overlay text="Mencari data mahasiswa..." />

@include('partials.chatbot-button')

@include('partials.skeleton-loading')


<div id="content" class="hidden px-6 pt-6">

    @include('partials.hero')

    @include('partials.menu')

    @include('partials.form')

    @include('partials.manfaat')

    @include('partials.faq')

</div>

<div id="content-footer" class="hidden">

    @include('partials.link')

    @include('partials.footer')

</div>

<button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-blue-600 text-white flex items-center justify-center rounded-full shadow-xl
            opacity-0 translate-y-4 pointer-events-none transform transition-all duration-300 ease-in-out
            hover:bg-blue-700 hover:scale-110 hover:shadow-2xl active:scale-95
            focus:outline-none focus:ring-2 focus:ring-blue-400" title="Kembali ke Atas">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('#sirata form');
    const btn  = document.getElementById('btnCari');
    const overlay = document.getElementById('loadingOverlay');

    if (form) {
        form.addEventListener('submit', function (e) {

            e.preventDefault();

            if (overlay) {
                overlay.classList.remove('hidden');
            }

            if (btn) {
                btn.disabled = true;
                btn.innerText = 'Mencari...';
            }

            setTimeout(() => {
                form.submit();
            }, 300);
        });
    }

});
</script>

@endsection