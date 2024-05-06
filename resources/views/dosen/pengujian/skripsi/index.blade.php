@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pengujian Skripsi</p>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <form method="GET" action="/dosen/pengujian/skripsi">
            @csrf
            <div class="flex justify-evenly items-center">
                <div>
                    <label for="cari_nama">Nama:</label>
                    <input type="text" id="cari_nama" name="cari_nama" class="w-56"
                        value="{{ request()->input('cari_nama') }}">
                </div>
                <div>
                    <label for="cari_prodi">Program Studi:</label>
                    <select name="cari_prodi" id="cari_prodi" class="w-72">
                        <option value="">(Tanpa filter)</option>
                        <option value="Teknik Informatika"
                            {{ request()->input('cari_prodi') === 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                            Informatika</option>
                        <option value="Teknik Multimedia Digital"
                            {{ request()->input('cari_prodi') === 'Teknik Multimedia Digital' ? 'selected' : '' }}>Teknik
                            Multimedia Digital</option>
                        <option value="Teknik Multimedia dan Jaringan"
                            {{ request()->input('cari_prodi') === 'Teknik Multimedia dan Jaringan' ? 'selected' : '' }}>
                            Teknik
                            Multimedia dan Jaringan</option>
                    </select>
                </div>
                <div>
                    <label for="cari_bimbingan">Target pengujian:</label>
                    <select name="cari_bimbingan" id="cari_bimbingan" class="w-72">
                        <option value="">(Tanpa filter)</option>
                        <option value="mahasiswa_bimbingan"
                            {{ request()->input('cari_bimbingan') === 'mahasiswa_bimbingan' ? 'selected' : '' }}>Mahasiswa
                            bimbingan</option>
                        <option value="mahasiswa_teruji"
                            {{ request()->input('cari_bimbingan') === 'mahasiswa_teruji' ? 'selected' : '' }}>
                            Mahasiswa selain bimbingan
                        </option>
                    </select>
                </div>
                <button class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
            </div>
        </form>
    </div>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Penguji</th>
                    <th class="border-b border-slate-500 py-2">Tanggal Sidang</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $startNumber = ($data->currentPage() - 1) * $data->perPage() + 1;
                @endphp
                @foreach ($data as $index => $dosen_skripsi)
                    @if ($dosen_skripsi->nilai_pembimbing == null)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $startNumber + $index }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_skripsi->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $dosen_skripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_skripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_skripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_skripsi->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                1. {{ $dosen_skripsi->pengajuanSkripsiPenguji1->nama }}<br>
                                2. {{ $dosen_skripsi->pengajuanSkripsiPenguji2->nama }}<br>
                                3. {{ $dosen_skripsi->pengajuanSkripsiPenguji3->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_skripsi->tanggal }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_skripsi->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                <a href="/dosen/pengujian/terbimbing/{{ $dosen_skripsi->id }}/terima"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                {{-- @foreach ($dosen_pembimbing as $dosen_pembimbing)
                    @if ($dosen_pembimbing->nilai_pembimbing == null)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_pembimbing->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $dosen_pembimbing->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_pembimbing->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_pembimbing->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_pembimbing->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                1. {{ $dosen_pembimbing->pengajuanSkripsiPenguji1->nama }}<br>
                                2. {{ $dosen_pembimbing->pengajuanSkripsiPenguji2->nama }}<br>
                                3. {{ $dosen_pembimbing->pengajuanSkripsiPenguji3->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_pembimbing->tanggal }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_pembimbing->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                <a href="/dosen/pengujian/terbimbing/{{ $dosen_pembimbing->id }}/terima"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($dosen_penguji1 as $dosen_penguji1)
                    @if ($dosen_penguji1->nilai1 == null)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji1->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $dosen_penguji1->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji1->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji1->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji1->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                1. {{ $dosen_penguji1->pengajuanSkripsiPenguji1->nama }}<br>
                                2. {{ $dosen_penguji1->pengajuanSkripsiPenguji2->nama }}<br>
                                3. {{ $dosen_penguji1->pengajuanSkripsiPenguji3->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_penguji1->tanggal }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_penguji1->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_penguji1->id }}/terima"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($dosen_penguji2 as $dosen_penguji2)
                    @if ($dosen_penguji2->nilai2 == null)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji2->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $dosen_penguji2->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji2->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji2->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji2->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                1. {{ $dosen_penguji2->pengajuanSkripsiPenguji1->nama }}<br>
                                2. {{ $dosen_penguji2->pengajuanSkripsiPenguji2->nama }}<br>
                                3. {{ $dosen_penguji2->pengajuanSkripsiPenguji3->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_penguji2->tanggal }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/pengujian/sempro/{{ $dosen_penguji2->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_penguji2->id }}/terima"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($dosen_penguji3 as $dosen_penguji3)
                    @if ($dosen_penguji3->nilai3 == null)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji3->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $dosen_penguji3->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji3->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji3->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $dosen_penguji3->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                1. {{ $dosen_penguji3->pengajuanSkripsiPenguji1->nama }}<br>
                                2. {{ $dosen_penguji3->pengajuanSkripsiPenguji2->nama }}<br>
                                3. {{ $dosen_penguji3->pengajuanSkripsiPenguji3->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_penguji3->tanggal }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/pengujian/sempro/{{ $dosen_penguji3->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                <a href="/dosen/pengujian/skripsi/{{ $dosen_penguji3->id }}/terima"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a>
                            </td>
                        </tr>
                    @endif
                @endforeach --}}
            </tbody>
        </table>
    </div>

    {{-- pagination --}}
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $data->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $data->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $data->total() }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="{{ $data->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 {{ $data->onFirstPage() ? 'pointer-events-none opacity-40' : '' }}">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                    @php
                        // Hitung jumlah halaman yang akan ditampilkan di pagination
                        $maxPages = min($data->lastPage(), 5);
                        // Hitung halaman pertama yang akan ditampilkan di pagination
                        $startPage = max(1, min($data->currentPage() - 2, $data->lastPage() - 4));
                    @endphp
                    @for ($i = $startPage; $i < $startPage + $maxPages; $i++)
                        <a href="{{ $data->url($i) . '&' . http_build_query(request()->except('page')) }}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $data->currentPage() == $i ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0' }}">{{ $i }}</a>
                    @endfor

                    <a href="{{ $data->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 {{ $data->hasMorePages() ? '' : 'pointer-events-none opacity-40' }}">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
@endsection
