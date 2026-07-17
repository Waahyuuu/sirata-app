<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-gray-700">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">NIM</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">Nama Mahasiswa</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">Program Studi</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3.5 text-center font-semibold text-gray-600 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse ($mahasiswaCekal as $mhs)

                <tr class="hover:bg-orange-50/30 transition-colors duration-200">

                    <td class="px-5 py-4 font-medium text-gray-900">
                        {{ $mhs['nim'] }}
                    </td>

                    <td class="px-5 py-4">
                        {{ $mhs['nama'] }}
                    </td>

                    <td class="px-5 py-4 text-gray-600">
                        {{ $mhs['prodi'] }}
                    </td>

                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-semibold border border-red-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                            {{ $mhs['status'] }}
                        </span>
                    </td>

                    <td class="px-5 py-4">
                        <div class="flex justify-center items-center gap-2">

                            {{-- WhatsApp Orang Tua --}}
                            <a href="{{ route('admin.notifikasi.wa', $mhs['nim']) }}" target="_blank"
                                class="inline-flex items-center gap-1.5 bg-[#25D366] hover:bg-[#1ebe57] text-white text-xs font-medium px-3 py-2 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                WhatsApp
                            </a>

                            {{-- SMS Orang Tua --}}
                            <form action="{{ route('admin.notifikasi.sms', $mhs['nim']) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-[#ff6900] hover:bg-[#e55e00] text-white text-xs font-medium px-3 py-2 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    Kirim SMS
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <div class="bg-gray-50 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Tidak ada mahasiswa yang terkena cekal</p>
                        </div>
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>