<section id="sirata" class="min-h-screen flex items-center justify-center bg-white px-4">

    <div class="w-full max-w-xl text-center">

        <h1 class="text-7xl font-black mb-3 tracking-wide">
            SIRATA
        </h1>

        <p class="text-l font-bold text-gray-700 mb-8">
            Masukan Nama Ibu, Tanggal Lahir Mahasiswa dan NIM Mahasiswa <br>
            Untuk Mengakses Informasi Mahasiswa
        </p>

        <!-- Form -->
        <form method="POST" action="{{ route('mahasiswa.cari') }}" class="space-y-5 text-left">
            @csrf

            <!-- Nama Ibu -->
            <div>
                <label class="block text-sm mb-2">
                    Nama Ibu
                </label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required placeholder="Nama ibu"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('nama_ibu')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-sm mb-2">
                    Tanggal Lahir Mahasiswa
                </label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('tanggal_lahir')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- NIM -->
            <div>
                <label class="block text-sm mb-2">
                    Nim Mahasiswa
                </label>
                <input type="text" name="nim" value="{{ old('nim') }}" required placeholder="22010001"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('nim')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit" id="btnCari"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                CARI
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