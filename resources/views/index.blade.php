@extends('layouts.app')

@section('content')

<x-loading-overlay text="Mencari data mahasiswa..." />

@include('partials.chatbot-button')

@include('partials.skeleton-loading')

<div id="content" class="hidden px-4 py-4 md:px-6 md:pt-6">

    {{-- HERO ADAPTIVE --}}
    <div class="hidden md:block">
        @include('partials.hero')
    </div>

    <div class="block md:hidden">
        @include('partials.hero-mobile')
    </div>

    {{-- MENU ADAPTIVE --}}
    <div class="hidden md:block">
        @include('partials.menu')
    </div>

    <div class="block md:hidden">
        @include('partials.menu-mobile')
    </div>

    @include('partials.form')

    @include('partials.manfaat')

    @include('partials.faq')

</div>

<div id="content-footer" class="hidden">

    @include('partials.link')

    @include('partials.footer')

</div>

@include('components.back-to-top')

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