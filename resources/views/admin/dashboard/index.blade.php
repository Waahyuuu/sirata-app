@extends('layouts.admin')

@section('title', 'Dasbor')

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