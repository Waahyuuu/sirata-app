<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Biodata Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

        <h1 class="text-2xl font-bold mb-5 text-center">
            Biodata Mahasiswa
        </h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="space-y-3 text-gray-700">

            <div class="border-b pb-2">
                <span class="font-semibold">Nama:</span>
                {{ $mahasiswa['name'] ?? '-' }}
            </div>

            <div class="border-b pb-2">
                <span class="font-semibold">NIM:</span>
                {{ $mahasiswa['nim'] ?? '-' }}
            </div>

            <div class="border-b pb-2">
                <span class="font-semibold">Email:</span>
                {{ $mahasiswa['email'] ?? '-' }}
            </div>

            <div class="border-b pb-2">
                <span class="font-semibold">Nama Ibu:</span>
                {{ $mahasiswa['mother_name'] ?? '-' }}
            </div>

            <div class="border-b pb-2">
                <span class="font-semibold">Tanggal Lahir:</span>
                {{ $mahasiswa['birth_date'] ?? '-' }}
            </div>

        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kembali
            </a>
        </div>

    </div>

</body>

</html>