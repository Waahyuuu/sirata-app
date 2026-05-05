@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="h-full flex flex-col overflow-hidden">

    <div class="flex-none">
        @include('admin.dashboard.welcome')
    </div>

    <div class="flex-1 min-h-0 overflow-y-auto custom-scroll pr-2">
        @include('admin.dashboard.content')
    </div>

</div>
@endsection

<style>
    /* Custom Scrollbar agar lebih estetik */
    .custom-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>