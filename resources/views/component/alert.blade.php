@php
$type = $type ?? 'success';
$message = $message ?? '';
$duration = $duration ?? 3000;

$styles = [
'success' => 'bg-green-500',
'error' => 'bg-red-500',
'warning' => 'bg-yellow-500',
'info' => 'bg-blue-500',
];
@endphp

@if($message)
<div x-data="{ show: false }" x-init="
        setTimeout(() => show = true, 100);
        setTimeout(() => show = false, {{ $duration }});
    " x-show="show" x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="-translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-10 opacity-0"
    class="w-full text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between {{ $styles[$type] ?? 'bg-green-500' }}">

    <span class="text-sm">{{ $message }}</span>

    <button @click="show = false" class="ml-4 font-bold">
        ✕
    </button>

</div>
@endif