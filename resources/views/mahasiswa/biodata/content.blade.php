<div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

    @php
    $p = $mahasiswa['prospective'];
    $s = $mahasiswa['student'];
    @endphp

    <!-- Section Header -->
    <div class="flex items-center gap-3 mb-6 pb-4 border-b" style="border-color: #ffd180;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <div>
            <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Data Diri Mahasiswa</h2>
            <p class="text-xs" style="color: #6b7280;">Informasi pribadi dan akademik</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Nama & NIM -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Nama Lengkap
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['name'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                    NIM
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $s['nim'] }}
            </div>
        </div>

        <!-- Jenis Kelamin & TTL -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path d="M12 6.569a6 6 0 1 1-7.165-.256M8.25 17.25v6" />
                        <path d="M9.634 13.824a6 6 0 1 1 8.6-.9m-.491-7.932L21.75.75M18 .75h3.75V4.5M5.25 20.25h6" />
                    </svg>
                    Jenis Kelamin
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['gender'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Tempat, Tanggal Lahir
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['birth_place'] }},
                {{ \Carbon\Carbon::parse($p['birth_date'])->locale('id')->translatedFormat('d F Y') }}
            </div>
        </div>

        <!-- Agama & Telepon -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                        <path d="M9 6h6" />
                        <path d="M9 10h4" />
                    </svg>
                    Agama
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['religion'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Nomer Telepon
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['phone_number'] }}
            </div>
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Alamat Domisili
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium leading-relaxed"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['domicile_address'] }}
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Alamat Asal
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium leading-relaxed"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['origin_address'] }}
            </div>
        </div>

        <!-- Asal Sekolah & Warga Negara -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Asal Sekolah / Kampus
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['origin'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" style="color: #ff6900;">
    <rect x="3" y="4" width="18" height="16" rx="2" ry="2" />
    <line x1="3" y1="10" x2="21" y2="10" />
    <path d="M7 15h4" />
    <path d="M7 13h2" />
    <circle cx="17" cy="14" r="2" />
    <path d="M17 18v-1a2 2 0 0 1 2-2h1" />
</svg>
                    Warga Negara
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['nationality'] }}
            </div>
        </div>

        <!-- Prodi & Tahun Masuk -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    Program Studi
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $s['study_program'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" style="color: #ff6900;">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                        <path d="M16 16l-4-4-4 4" />
                        <path d="M12 12v8" />
                    </svg>
                    Tahun Masuk
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $s['entry_year'] }}
            </div>
        </div>

        <!-- Orang Tua -->
        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"
                        viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" d="M14 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                        <path
                            d="M10 16v4c0 .943 0 1.414.293 1.707S11.057 22 12 22s1.414 0 1.707-.293S14 20.943 14 20v-4h.26c1.553 0 2.329 0 2.633-.485c.303-.486-.062-1.142-.792-2.456l-1.8-3.235C13.848 9.009 12.963 8.5 12 8.5s-1.848.509-2.3 1.324L7.9 13.06c-.731 1.313-1.096 1.97-.793 2.455S8.187 16 9.74 16z" />
                    </svg>
                    Nama Ibu Kandung
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['mother_name'] }}
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"
                        viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" d="M14 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                        <path
                            d="M16 12.5c0-1.886 0-2.828-.586-3.414S13.886 8.5 12 8.5s-2.828 0-3.414.586S8 10.614 8 12.5V14c0 .943 0 1.414.293 1.707S9.057 16 10 16v4c0 .943 0 1.414.293 1.707S11.057 22 12 22s1.414 0 1.707-.293S14 20.943 14 20v-4c.943 0 1.414 0 1.707-.293S16 14.943 16 14z" />
                    </svg>
                    Nama Ayah Kandung
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $p['father_name'] }}
            </div>
        </div>

        <!-- Email -->
        <div class="md:col-span-2">
            <label class="block mb-1.5 text-sm font-medium" style="color: #6b7280;">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Kampus
                </span>
            </label>
            <div class="bg-[#fff8f0] border rounded-xl p-3 text-sm font-medium"
                style="border-color: #ffd180; color: #2d2d2d;">
                {{ $s['stimata_email'] }}
            </div>
        </div>

    </div>

</div>