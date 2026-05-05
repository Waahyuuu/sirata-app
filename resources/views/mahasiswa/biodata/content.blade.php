<div class="bg-gray-100 rounded-3xl p-6">

    @php
    $p = $mahasiswa['prospective'];
    $s = $mahasiswa['student'];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Nama & NIM -->
        <div>
            <label class="block mb-1 text-sm">Nama Lengkap</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['name'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">NIM</label>
            <div class="bg-white border rounded-xl p-3">{{ $s['nim'] }}</div>
        </div>

        <!-- Jenis Kelamin & TTL -->
        <div>
            <label class="block mb-1 text-sm">Jenis Kelamin</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['gender'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">Tempat, Tanggal Lahir</label>
            <div class="bg-white border rounded-xl p-3">
                {{ $p['birth_place'] }},
                {{ \Carbon\Carbon::parse($p['birth_date'])->locale('id')->translatedFormat('d F Y') }}
            </div>
        </div>

        <!-- Agama & Telepon -->
        <div>
            <label class="block mb-1 text-sm">Agama</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['religion'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">Nomer Telepon</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['phone_number'] }}</div>
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
            <label class="block mb-1 text-sm">Alamat Domisili</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['domicile_address'] }}</div>
        </div>

        <div class="md:col-span-2">
            <label class="block mb-1 text-sm">Alamat Asal</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['origin_address'] }}</div>
        </div>

        <!-- Kota & Negara -->
        <div>
            <label class="block mb-1 text-sm">Asal Sekolah / Kampus</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['origin'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">Warga Negara</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['nationality'] }}</div>
        </div>

        <!-- Prodi & Semester -->
        <div>
            <label class="block mb-1 text-sm">Program Studi</label>
            <div class="bg-white border rounded-xl p-3">{{ $s['study_program'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">Tahun Masuk</label>
            <div class="bg-white border rounded-xl p-3">{{ $s['entry_year'] }}</div>
        </div>

        <!-- Orang Tua -->
        <div>
            <label class="block mb-1 text-sm">Nama Ibu Kandung</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['mother_name'] }}</div>
        </div>

        <div>
            <label class="block mb-1 text-sm">Nama Ayah Kandung</label>
            <div class="bg-white border rounded-xl p-3">{{ $p['father_name'] }}</div>
        </div>

        <!-- Email -->
        <div class="md:col-span-2">
            <label class="block mb-1 text-sm">Email Kampus</label>
            <div class="bg-white border rounded-xl p-3">{{ $s['stimata_email'] }}</div>
        </div>

    </div>

</div>