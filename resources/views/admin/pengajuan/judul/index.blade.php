@extends('admin.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pengajuan Judul & Dosen Pembimbing</p>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <form method="GET" action="{{ route('adm.pengajuanJudul') }}">
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
                        @foreach ($prodi as $prd)
                            <option value="{{ $prd->id }}"
                                {{ request()->input('cari_prodi') == $prd->id ? 'selected' : '' }}>
                                {{ $prd->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="cari_tahun">Tahun Ajaran:</label>
                    <select name="cari_tahun" id="cari_tahun" class="w-72">
                        <option value="">(Tanpa filter)</option>
                        @foreach ($tahun as $thn)
                            <option value="{{ $thn->id }}"
                                {{ request()->input('cari_tahun') == $thn->id ? 'selected' : '' }}>
                                {{ $thn->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
            </div>
        </form>
    </div>
    <div class="container mx-auto mt-6 overflow-x-auto">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Dosen Pilihan</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $startNumber = ($pengajuanJudul->currentPage() - 1) * $pengajuanJudul->perPage() + 1;
                @endphp
                @foreach ($pengajuanJudul as $index => $data)
                    <tr class="even:bg-slate-300">
                        <form>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $startNumber + $index }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $data->user->nama }}</p>
                                <p>({{ $data->user->mahasiswa->nim }})</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $data->user->mahasiswa->prodi->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->judul }}</td>
                            @php
                                $no = 1;
                                $dosen_pilihan = explode('- ', $data->dosen_pilihan);
                            @endphp
                            <td class="border-b border-slate-500 py-2 text-center">
                                @foreach ($dosen_pilihan as $dospil)
                                    {{ $no++ }}. {{ $dospil }}<br>
                                @endforeach
                            </td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="{{ route('adm.getPengajuanJudul', ['pengajuanJudul' => $data->id]) }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                            </td>
                        </form>
                    </tr>
                @endforeach
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
                    <span class="font-medium">{{ $pengajuanJudul->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $pengajuanJudul->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $pengajuanJudul->total() }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="{{ $pengajuanJudul->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 {{ $pengajuanJudul->onFirstPage() ? 'pointer-events-none opacity-40' : '' }}">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    @php
                        // Hitung jumlah halaman yang akan ditampilkan di pagination
                        $maxPages = min($pengajuanJudul->lastPage(), 5);
                        // Hitung halaman pertama yang akan ditampilkan di pagination
                        $startPage = max(1, min($pengajuanJudul->currentPage() - 2, $pengajuanJudul->lastPage() - 4));
                    @endphp
                    @for ($i = $startPage; $i < $startPage + $maxPages; $i++)
                        <a href="{{ $pengajuanJudul->url($i) . '&' . http_build_query(request()->except('page')) }}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $pengajuanJudul->currentPage() == $i ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0' }}">{{ $i }}</a>
                    @endfor

                    <a href="{{ $pengajuanJudul->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 {{ $pengajuanJudul->hasMorePages() ? '' : 'pointer-events-none opacity-40' }}">
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
