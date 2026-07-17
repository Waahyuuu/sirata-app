<style>
    /* Custom scrollbar */
    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Table styles */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table-modern th {
        background: #fff8f0;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #475569;
        padding: 0.875rem 1rem;
        border-bottom: 2px solid #ffd180;
        white-space: nowrap;
    }

    .table-modern td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
        color: #334155;
        vertical-align: middle;
    }

    .table-modern tbody tr {
        transition: all 0.15s ease;
    }

    .table-modern tbody tr:hover {
        background: #fff5e9;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .table-modern tbody tr:nth-child(even) {
        background: #fafbfc;
    }

    .table-modern tbody tr:nth-child(even):hover {
        background: #fff5e9;
    }

    /* Sticky header */
    .sticky-header th {
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(255, 105, 0, 0.08);
    }

    /* Search input */
    .search-input {
        transition: all 0.2s ease;
        border-color: #e2e8f0;
    }

    .search-input:focus {
        box-shadow: 0 0 0 3px rgba(255, 105, 0, 0.1);
        border-color: #ff6900;
        outline: none;
    }

    /* Sort button */
    .sort-btn {
        transition: all 0.2s ease;
        opacity: 0.5;
        color: #64748b;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .sort-btn:hover {
        opacity: 1;
        background: #ffd180;
        color: #ff6900;
        border-radius: 6px;
    }

    .sort-btn.active {
        opacity: 1;
        color: #ff6900;
    }

    /* Dropdown */
    .dropdown-menu {
        animation: fadeIn 0.15s ease;
        border-color: #ffd180;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-4px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        transition: all 0.15s ease;
    }

    .dropdown-item:hover {
        background: #fff5e9;
    }

    .dropdown-item.active {
        background: #fff5e9;
        color: #ff6900;
        font-weight: 500;
    }

    /* Badge styles - TETAP SEPERTI ASLINYA */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-ti {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-si {
        background: #dcfce7;
        color: #166534;
    }

    .badge-d3 {
        background: #fef3c7;
        color: #92400e;
    }

    /* Status styles */
    .status-aktif {
        background: #dcfce7;
        color: #166534;
    }

    .status-tidak-aktif {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 6px;
    }

    .status-dot.aktif {
        background: #22c55e;
    }

    .status-dot.tidak-aktif {
        background: #ef4444;
    }

    /* Pagination */
    .page-btn {
        transition: all 0.15s ease;
        border: 1px solid #e2e8f0;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.875rem;
        color: #475569;
        background: white;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .page-btn:hover:not(:disabled) {
        background: #fff5e9;
        border-color: #ff6900;
        color: #ff6900;
    }

    .page-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .page-btn.active {
        background: #ff6900;
        color: white;
        border-color: #ff6900;
    }

    /* Size button */
    .size-btn {
        transition: all 0.15s ease;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #64748b;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .size-btn:hover {
        background: #fff5e9;
        color: #ff6900;
    }

    .size-btn.active {
        background: #ff6900;
        color: white;
        box-shadow: 0 2px 8px rgba(255, 105, 0, 0.3);
    }

    /* Empty state */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }

    /* NIM badge */
    .nim-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-family: monospace;
        font-weight: 600;
        font-size: 0.8rem;
    }

    /* Tahun badge */
    .tahun-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Pagination container */
    .pagination-container {
        border-top: 1px solid #f1f5f9;
        background: white;
    }

    /* Info text */
    .info-text {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .info-text span {
        color: #2d2d2d;
        font-weight: 600;
    }
</style>

{{-- TABLE CONTAINER --}}
<div class="overflow-y-auto custom-scroll flex-1">

    <table class="table-modern">

        <thead class="sticky-header">
            <tr>
                <th class="text-center w-auto">NIM</th>

                <th class="text-center w-auto">
                    <div class="flex items-center justify-center gap-2">
                        <span>Nama Lengkap</span>
                        <button type="submit" name="sort_nama"
                            value="{{ request('sort_nama') === 'asc' ? 'desc' : 'asc' }}"
                            class="sort-btn p-1 rounded-lg {{ request('sort_nama') ? 'active' : '' }}" title="Urutkan nama">
                            @if(request('sort_nama') === 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m6.288 4.293l-3.995 4l-.084.095a1 1 0 0 0 .084 1.32l.095.083a1 1 0 0 0 1.32-.084L6 7.41V19l.007.117a1 1 0 0 0 .993.884l.117-.007A1 1 0 0 0 8 19V7.417l2.293 2.29l.095.084a1 1 0 0 0 1.319-1.499l-4.006-4l-.094-.083a1 1 0 0 0-1.32.084M17 4.003l-.117.007a1 1 0 0 0-.883.993v11.58l-2.293-2.29l-.095-.084a1 1 0 0 0-1.319 1.498l4.004 4l.094.084a1 1 0 0 0 1.32-.084l3.996-4l.084-.095a1 1 0 0 0-.084-1.32l-.095-.083a1 1 0 0 0-1.32.084L18 16.587V5.003l-.007-.116A1 1 0 0 0 17 4.003" />
                            </svg>
                            @elseif(request('sort_nama') === 'desc')
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m6.288 4.293l-3.995 4l-.084.095a1 1 0 0 0 .084 1.32l.095.083a1 1 0 0 0 1.32-.084L6 7.41V19l.007.117a1 1 0 0 0 .993.884l.117-.007A1 1 0 0 0 8 19V7.417l2.293 2.29l.095.084a1 1 0 0 0 1.319-1.499l-4.006-4l-.094-.083a1 1 0 0 0-1.32.084M17 4.003l-.117.007a1 1 0 0 0-.883.993v11.58l-2.293-2.29l-.095-.084a1 1 0 0 0-1.319 1.498l4.004 4l.094.084a1 1 0 0 0 1.32-.084l3.996-4l.084-.095a1 1 0 0 0-.084-1.32l-.095-.083a1 1 0 0 0-1.32.084L18 16.587V5.003l-.007-.116A1 1 0 0 0 17 4.003" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m6.288 4.293l-3.995 4l-.084.095a1 1 0 0 0 .084 1.32l.095.083a1 1 0 0 0 1.32-.084L6 7.41V19l.007.117a1 1 0 0 0 .993.884l.117-.007A1 1 0 0 0 8 19V7.417l2.293 2.29l.095.084a1 1 0 0 0 1.319-1.499l-4.006-4l-.094-.083a1 1 0 0 0-1.32.084M17 4.003l-.117.007a1 1 0 0 0-.883.993v11.58l-2.293-2.29l-.095-.084a1 1 0 0 0-1.319 1.498l4.004 4l.094.084a1 1 0 0 0 1.32-.084l3.996-4l.084-.095a1 1 0 0 0-.084-1.32l-.095-.083a1 1 0 0 0-1.32.084L18 16.587V5.003l-.007-.116A1 1 0 0 0 17 4.003" />
                            </svg>
                            @endif
                        </button>
                    </div>
                </th>

                <th class="text-center w-auto">
                    <div class="flex justify-center items-center gap-2">
                        <span>Program Studi</span>
                        <div class="relative">
                            <button type="button" onclick="toggleDropdown('jurusanDropdown')"
                                class="sort-btn p-1 rounded-lg {{ request('jurusan') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M6.532 4.75c-.458 0-.854 0-1.165.03c-.307.028-.685.095-.993.348A1.72 1.72 0 0 0 3.75 6.45c-.002.39.172.726.34.992c.168.27.411.59.695.964l2.596 3.422c.252.332.315.42.359.51q.068.14.099.297c.02.1.023.212.023.634v2.97c0 .238-.001.494.07.738c.062.212.165.41.303.585c.16.2.37.346.562.477l.048.033l.99.683c.166.115.331.23.475.31s.388.202.69.183c.363-.022.69-.208.9-.495c.172-.236.21-.499.224-.663c.014-.166.014-.37.014-.578v-4.243c0-.422.004-.534.023-.634q.03-.157.1-.297c.043-.09.106-.178.358-.51l2.596-3.422c.284-.374.527-.694.696-.964c.167-.266.34-.602.339-.992a1.72 1.72 0 0 0-.624-1.322c-.308-.253-.686-.32-.993-.349c-.311-.029-.707-.029-1.165-.029zM5.251 6.439a.22.22 0 0 1 .057-.134c.024-.007.083-.021.2-.032c.232-.022.556-.023 1.06-.023h6.864c.504 0 .828 0 1.06.023c.117.01.176.025.2.032c.03.033.053.08.057.134a1 1 0 0 1-.11.207c-.128.205-.33.472-.64.881L13.64 8H6.36L6 7.527c-.31-.41-.512-.676-.64-.881a1 1 0 0 1-.11-.207M16.5 9.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5zm-1.5 2.5a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5zm-.5 2.5a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5zm0 2.5a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5z" />
                                </svg>
                            </button>

                            <div id="jurusanDropdown"
                                class="dropdown-menu hidden absolute right-0 mt-2 w-auto bg-white border rounded-xl shadow-lg z-50 overflow-hidden"
                                style="border-color: #ffd180;">
                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b" style="border-color: #ffd180;">
                                    Filter Program
                                </div>
                                <div onclick="setFilter('jurusan','')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2
                                    {{ request('jurusan','') === '' ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 inline-block shrink-0 rounded-full bg-gray-300"></span>
                                    Semua Program
                                </div>

                                <div onclick="setFilter('jurusan','TI')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2
                                    {{ request('jurusan') === 'TI' ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 inline-block shrink-0 rounded-full bg-blue-400"></span>
                                    S1 Teknologi Informasi
                                </div>

                                <div onclick="setFilter('jurusan','SI')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2
                                    {{ request('jurusan') === 'SI' ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 inline-block shrink-0 rounded-full bg-green-400"></span>
                                    S1 Sistem Informasi
                                </div>

                                <div onclick="setFilter('jurusan','D3')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2
                                    {{ request('jurusan') === 'D3' ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 inline-block shrink-0 rounded-full bg-amber-400"></span>
                                    D3 Sistem Informasi
                                </div>
                            </div>

                            <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                        </div>
                    </div>
                </th>

                <th class="text-center w-auto">Email</th>

                <th class="text-center w-auto">Status</th>

                <th class="text-center w-auto">
                    <div class="flex justify-center items-center gap-2">
                        <span>Angkatan</span>
                        <div class="relative">
                            <button type="button" onclick="toggleDropdown('tahunDropdown')"
                                class="sort-btn p-1 rounded-lg {{ request('tahun') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 20 20">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M6 2a1 1 0 0 0-1 1v1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1V3a1 1 0 1 0-2 0v1H7V3a1 1 0 0 0-1-1m0 5a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="tahunDropdown"
                                class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg z-50 overflow-hidden"
                                style="border-color: #ffd180;">
                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b" style="border-color: #ffd180;">
                                    Filter Tahun
                                </div>
                                <div onclick="setFilter('tahun','')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2 {{ request('tahun') == '' ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 rounded-full bg-gray-300"></span> Semua Tahun
                                </div>
                                @for($i = date('Y'); $i >= 2020; $i--)
                                <div onclick="setFilter('tahun','{{ $i }}')"
                                    class="dropdown-item px-4 py-2.5 cursor-pointer text-sm flex items-center gap-2 {{ request('tahun') == $i ? 'active' : 'text-gray-700' }}">
                                    <span class="w-2 h-2 rounded-full" style="background: #ff6900;"></span> {{ $i }}
                                </div>
                                @endfor
                            </div>

                            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                        </div>
                    </div>
                </th>

            </tr>
        </thead>

        <tbody>
            @forelse($mahasiswa as $mhs)
            <tr>
                <td class="text-center">
                    <span class="nim-badge">{{ $mhs['nim'] }}</span>
                </td>

                <td>
                    <div class="flex items-center gap-3">
                        <span class="font-medium text-gray-900">{{ $mhs['name'] }}</span>
                    </div>
                </td>

                <td class="text-center font-sans">
                    @php
                    $badgeClass = match($mhs['programe']) {
                    'S1 - Teknologi Informasi' => 'badge-ti',
                    'S1 - Sistem Informasi' => 'badge-si',
                    'D3 - Sistem Informasi' => 'badge-d3',
                    default => 'bg-gray-100 text-gray-700',
                    };

                    $programName = match($mhs['programe']) {
                    'S1 - Teknologi Informasi' => 'S1 Teknologi Informasi',
                    'S1 - Sistem Informasi' => 'S1 Sistem Informasi',
                    'D3 - Sistem Informasi' => 'D3 Sistem Informasi',
                    default => $mhs['programe'],
                    };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $programName }}</span>
                </td>

                <td class="text-center font-sans text-gray-500">{{ $mhs['stimata_email'] ?? '-' }}</td>

                <td class="text-center font-medium">
                    @php
                    $status = $mhs['status'] ?? '-';
                    $isAktif = strtolower($status) === 'aktif';
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $isAktif ? 'status-aktif' : 'status-tidak-aktif' }}">
                        <span class="status-dot {{ $isAktif ? 'aktif' : 'tidak-aktif' }}"></span>
                        {{ $status }}
                    </span>
                </td>

                <td class="text-center font-sans">
                    <span class="tahun-badge">
                        {{ \Carbon\Carbon::parse($mhs['entry_date'])->format('Y') }}
                    </span>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-gray-900 font-medium mb-1">Tidak ada data</h3>
                        <p class="text-gray-500 text-sm">Belum ada mahasiswa yang terdaftar</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

{{-- PAGINATION --}}
@if($total > 0)
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-4 pagination-container">

    {{-- INFO --}}
    <div class="info-text">
        Menampilkan
        <span>{{ $start }}</span>
        –
        <span>{{ $end }}</span>
        dari
        <span>{{ $total }}</span>
        data
    </div>

    <div class="flex items-center gap-3">

        {{-- SIZE --}}
        <div class="flex items-center gap-2 text-sm relative z-20">
            <span class="text-gray-500">Show</span>

            <div class="flex bg-gray-100 gap-1 p-1 rounded-lg shadow-sm">
                @foreach([10,25,50,100] as $opt)
                <button type="button" onclick="changeSize({{ $opt }})" 
                    class="size-btn {{ $size == $opt ? 'active' : '' }}">
                    {{ $opt }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="flex items-center gap-1">

            {{-- PREV --}}
            @if($page > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}"
                class="page-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            @else
            <button disabled class="page-btn opacity-40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            @endif

            {{-- PAGE NUMBER --}}
            <span class="px-3 py-1.5 rounded-lg text-sm font-semibold" style="background: #fff5e9; color: #ff6900; border: 1px solid #ffd180;">
                {{ $page }}
            </span>

            {{-- NEXT --}}
            @if($end < $total)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}"
                class="page-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            <button disabled class="page-btn opacity-40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            @endif

        </div>
    </div>
</div>
@endif

<script>
    const form = document.getElementById('filterForm');

    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isHidden = dropdown.classList.contains('hidden');
        
        // Close all dropdowns first
        document.querySelectorAll('[id$="Dropdown"]').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Toggle current
        if (isHidden) {
            dropdown.classList.remove('hidden');
        }
    }

    function setFilter(name, value) {
        // hapus semua input dengan nama sama (hindari duplikat)
        document.querySelectorAll(`input[name="${name}"]`).forEach(el => el.remove());

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;

        form.appendChild(input);
        form.submit();
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.querySelectorAll('[id$="Dropdown"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });

    // Auto-submit search after typing stops (debounce)
    let searchTimeout;
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length === 0 || this.value.length >= 2) {
                    form.submit();
                }
            }, 500);
        });
    }

    function resetPage() {
        const form = document.getElementById('filterForm');

        // reset page ke 1
        let pageInput = form.querySelector('input[name="page"]');
        if (pageInput) {
            pageInput.value = 1;
        }

        form.submit();
    }

    function changeSize(size) {
        const url = new URL(window.location.href);
        url.searchParams.set('size', size);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>