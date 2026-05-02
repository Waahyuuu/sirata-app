@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* WELCOME BANNER - Purple theme matching screenshot */
    .welcome-banner {
        background: linear-gradient(135deg, #aa9354 0%, #f6b65c 50%, #7c3aed 100%);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        min-height: 220px;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    /* STAT CARDS - Colorful like screenshot */
    .stat-card-yellow {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        border-radius: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card-yellow:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -8px rgba(251, 191, 36, 0.5);
    }

    .stat-card-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card-purple:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -8px rgba(139, 92, 246, 0.5);
    }

    .stat-card-pink {
        background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
        border-radius: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card-pink:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -8px rgba(244, 114, 182, 0.5);
    }

    .stat-card-blue {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        border-radius: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card-blue:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -8px rgba(96, 165, 250, 0.5);
    }

    .stat-card-green {
        background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        border-radius: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card-green:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -8px rgba(52, 211, 153, 0.5);
    }

    .stat-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* CALENDAR */
    .calendar-day {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.15s;
    }

    .calendar-day:hover:not(.empty) {
        background: #dca6f3;
    }

    .calendar-day.today {
        background: #8b5cf6;
        color: white;
        font-weight: 600;
    }

    .calendar-day.selected {
        background: #ede9fe;
        color: #7c3aed;
        font-weight: 600;
        border: 2px solid #8b5cf6;
    }

    /* DATE WIDGET */
    .date-widget {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }

    .date-widget::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .live-clock {
        font-variant-numeric: tabular-nums;
        letter-spacing: 0.05em;
    }

    /* ILLUSTRATION */
    .banner-illustration {
        position: absolute;
        right: 20px;
        bottom: 0;
        height: 200px;
        width: auto;
        z-index: 10;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
    }

    @media (max-width: 1024px) {
        .banner-illustration {
            display: none;
        }
    }
</style>

@php
$now = now();
$currentMonth = $now->format('F Y');
$daysInMonth = $now->daysInMonth;
$firstDayOfWeek = $now->copy()->startOfMonth()->dayOfWeek;
$today = $now->day;
@endphp

<div class="space-y-6 max-h-[78vh] overflow-y-auto rounded-xl">

    {{-- WELCOME BANNER --}}
    <div class="welcome-banner p-8 text-white relative">
        <div class="relative z-10 max-w-lg">
            <p class="text-purple-100 text-sm font-medium mb-2">Selamat Datang Kembali 👋</p>
            <h1 class="text-3xl lg:text-4xl font-bold mb-3">Dashboard Admin</h1>
            <p class="text-purple-100 text-sm max-w-md mb-6 leading-relaxed">
                Kelola data mahasiswa, konten website, dan chatbot dari satu tempat.
                Pantau statistik dan aktivitas sistem secara real-time.
            </p>
        </div>

        {{-- Illustration - Woman working on laptop --}}
        <img src="{{ asset('images/admin.svg') }}" alt="Admin Illustration" class="banner-illustration"
            onerror="this.style.display='none'">
    </div>

    {{-- COLORFUL STATISTICS CARDS - Like Screenshot --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- TOTAL MAHASISWA - Yellow --}}
        <div class="stat-card-yellow p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="stat-card-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ number_format($totalMahasiswa) }}</p>
            <p class="text-sm text-white/80 mt-1">Total Mahasiswa</p>
        </div>

        {{-- TOTAL MANFAAT - Purple --}}
        <div class="stat-card-purple p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="stat-card-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ number_format($totalManfaat) }}</p>
            <p class="text-sm text-white/80 mt-1">Manfaat</p>
        </div>

        {{-- TOTAL LINK - Pink --}}
        <div class="stat-card-pink p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="stat-card-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ number_format($totalLink) }}</p>
            <p class="text-sm text-white/80 mt-1">Link</p>
        </div>

        {{-- TOTAL FAQ - Blue --}}
        <div class="stat-card-blue p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="stat-card-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ number_format($totalFaq) }}</p>
            <p class="text-sm text-white/80 mt-1">FAQ</p>
        </div>

    </div>

    {{-- BOTTOM ROW: Date Widget + Calendar + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- TANGGAL HARI INI --}}
        <div class="date-widget p-8 text-white relative flex flex-col justify-center items-center text-center">
            <div class="relative z-10">
                <div class="mb-4">
                    <svg class="w-16 h-16 mx-auto text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-purple-100 text-sm font-medium mb-2 uppercase tracking-wider">Hari Ini</p>
                <h2 class="text-3xl lg:text-4xl font-bold mb-2">{{ $now->format('l') }}</h2>
                <p class="text-xl lg:text-2xl font-semibold text-purple-100">{{ $now->format('d F Y') }}</p>
                <div class="mt-5 inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-xl px-5 py-2.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-lg font-medium live-clock" id="liveClock2">{{ $now->format('H:i:s') }}</span>
                </div>
            </div>
        </div>

        {{-- CALENDAR WIDGET --}}
        <div class="dashboard-card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900">{{ $currentMonth }}</h3>
            </div>

            <div class="grid grid-cols-7 gap-1 mb-2">
                @foreach(['M','T','W','T','F','S','S'] as $day)
                <div class="text-center text-xs font-medium text-gray-400 py-1">{{ $day }}</div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 gap-1">
                @for($i = 0; $i < $firstDayOfWeek; $i++) <div class="calendar-day empty">
            </div>
            @endfor
            @for($day = 1; $day <= $daysInMonth; $day++) <div class="calendar-day {{ $day == $today ? 'today' : '' }}">
                {{ $day }}
        </div>
        @endfor
    </div>
</div>

</div>

</div>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = hours + ':' + minutes + ':' + seconds;
        
        const clock1 = document.getElementById('liveClock');
        const clock2 = document.getElementById('liveClock2');
        
        if (clock1) clock1.textContent = timeString;
        if (clock2) clock2.textContent = timeString;
    }
    
    updateClock();
    setInterval(updateClock, 1000);
</script>

@endsection