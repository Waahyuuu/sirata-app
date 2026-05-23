@extends('layouts.app')

@section('content')

<x-loading-overlay text="Mencari data mahasiswa..." />

@include('partials.chatbot-button')

@include('partials.skeleton-loading')

<div id="content" class="hidden px-4 py-4 md:px-6 md:pt-6">

    <div class="hidden md:block page-enter-right">
        @include('partials.hero')
    </div>

    <div class="block md:hidden page-enter-up">
        @include('partials.hero-mobile')
    </div>

    <div class="hidden md:block page-enter-left delay-200">
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

@endsection