@extends('layouts.admin')

@section('title', 'Mahasiswa')

@section('content')

<div class="flex flex-col gap-5 h-full overflow-hidden p-1">

    <form method="GET" action="{{ route('admin.mahasiswa') }}" id="filterForm" class="flex flex-col h-full">

        {{-- hidden page --}}
        <input type="hidden" name="page" value="{{ request('page',1) }}">
        <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
        <input type="hidden" name="tahun" value="{{ request('tahun') }}">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Mahasiswa</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data mahasiswa aktif</p>
            </div>

            {{-- SEARCH --}}
            <div class="relative w-full sm:w-80">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26">
                        <path fill="currentColor"
                            d="M10 .188A9.81 9.81 0 0 0 .187 10A9.81 9.81 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.82 1.82 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16" />
                    </svg></span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM..."
                    class="search-input w-full pl-11 pr-4 py-2.5 rounded-xl border text-sm">
            </div>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl border shadow-sm flex flex-col flex-1 overflow-hidden">

            @include('admin.mahasiswa.tabel-mahasiswa')

        </div>

    </form>

</div>

@endsection