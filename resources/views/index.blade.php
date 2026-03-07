@extends('layouts.app')

@section('content')

<!-- BUTTON KIRIM PESAN -->
@include('partials.chatbot-button')

{{-- skeleton --}}
@include('partials.skeleton-loading')

{{-- CONTENT --}}

{{-- HEADER --}}
<div id="content" class="hidden px-6 pt-6">

    {{-- HERO --}}
    @include('partials.hero')

    {{-- MENU --}}
    @include('partials.menu')

    {{-- FORM --}}
    @include('partials.form')

    {{-- MANFAAT --}}
    @include('partials.manfaat')

    {{-- FAQ --}}
    @include('partials.faq')

</div>

<div id="content-footer" class="hidden">

    {{-- LINK --}}
    @include('partials.link')

    {{-- FOOTER --}}
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

@endsection