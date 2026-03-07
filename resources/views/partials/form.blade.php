<section id="sirata" class="min-h-screen flex items-center justify-center bg-white px-4">

    <div class="w-full max-w-xl text-center">

        <!-- Title -->
        <h1 class="text-7xl font-black mb-3 tracking-wide">
            SIRATA
        </h1>

        <!-- Subtitle -->
        <p class="text-l font-bold text-gray-700 mb-8">
            Masukan Nama Ibu, Tanggal Lahir Mahasiswa dan NIM Mahasiswa <br>
            Untuk Mengakses Informasi Mahasiswa
        </p>

        <!-- Form -->
        <form class="space-y-5 text-left">

            <!-- Nama Ibu -->
            <div>
                <label class="form-section block text-sm mb-2">
                    Nama Lengkap Ibu
                </label>
                <input type="text"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-sm mb-2">
                    Tanggal Lahir Mahasiswa
                </label>
                <input type="date"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- NIM -->
            <div>
                <label class="block text-sm mb-2">
                    Nim Mahasiswa
                </label>
                <input type="text" placeholder="12.34.5678"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                CARI
            </button>

        </form>

    </div>

</section>