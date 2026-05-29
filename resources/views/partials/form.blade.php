<section id="sirata" class="min-h-screen flex items-center justify-center bg-white px-4">

    <div class="w-full max-w-xl text-center">

        <div class="max-w-5xl mx-auto text-center mb-16 px-4 reveal reveal-up">

            <div class="flex justify-center mb-4">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-[var(--primary-color)] bg-white">

                    <span class="w-2 h-2 rounded-full bg-[var(--primary-color)]"></span>

                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.18em] text-[var(--text-dark)]">
                        SIRATA
                    </span>
                </div>
            </div>

            <h1
                class="text-3xl md:text-5xl font-bold mb-6 tracking-tight text-[var(--text-dark)] leading-tight">
                Akses Informasi<br>Akademik Mahasiswa
            </h1>

            <p class="max-w-3xl mx-auto text-base md:text-lg text-gray-600 leading-relaxed">
                Masukan Nama Ibu, Tanggal Lahir Mahasiswa dan NIM Mahasiswa
                Untuk Mengakses Informasi Mahasiswa
            </p>

        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('mahasiswa.cari') }}" class="space-y-5 text-left reveal reveal-up delay-1">
            @csrf

            <!-- Nama Ibu -->
            <div>
                <label class="block text-sm mb-2 pl-2">
                    Nama Ibu
                </label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required placeholder="Nama ibu"
                    class="w-full border border-[var(--border-color)] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]">

                @error('nama_ibu')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-sm mb-2 pl-2">
                    Tanggal Lahir Mahasiswa
                </label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                    class="w-full border border-[var(--border-color)] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]">

                @error('tanggal_lahir')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- NIM -->
            <div>
                <label class="block text-sm mb-2 pl-2">
                    Nim Mahasiswa
                </label>
                <input type="text" name="nim" value="{{ old('nim') }}" required placeholder="22010001"
                    class="w-full border border-[var(--border-color)] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]">

                @error('nim')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" id="btnCari"
                class="w-full bg-[var(--button-bg)] hover:bg-[var(--button-hover)] text-[var(--button-text)] py-3 rounded-xl font-semibold transition-all duration-300 shadow-md hover:scale-[1.01]">
                Cari Informasi
            </button>

        </form>

        {{-- error --}}
        @if(session('error'))
        <div class="mt-4 text-red-600 font-semibold">
            {{ session('error') }}
        </div>
        @endif

        {{-- success --}}
        @if(session('success'))
        <div class="mt-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
        @endif

    </div>

</section>