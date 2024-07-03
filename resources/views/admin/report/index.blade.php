@extends('admin.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Report akhir</p>
    <form action="/admin/report/excel" method="POST">
        @csrf
        <button type="submit"
            class="mt-5 bg-primary border rounded-md w-36 h-10 text-white text-lg hover:text-black hover:bg-red-300 block mx-auto">Export
            to
            excel</button>
    </form>
    <div class="container mx-auto mt-6 overflow-x-auto">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Nama Mahasiswa</th>
                    <th class="border-b border-slate-500 py-2">NIM</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Kelas</th>
                    <th class="border-b border-slate-500 py-2">Judul Skripsi</th>
                    <th class="border-b border-slate-500 py-2">Sub Judul Skripsi</th>
                    <th class="border-b border-slate-500 py-2">Tanggal Sidang/Lulus Sidang</th>
                    <th class="border-b border-slate-500 py-2">Nama Dosen Pembimbing 1</th>
                    <th class="border-b border-slate-500 py-2">Nama Dosen Pembimbing 2</th>
                    <th class="border-b border-slate-500 py-2">Nama Dosen Penguji 1</th>
                    <th class="border-b border-slate-500 py-2">Nama Dosen Penguji 2</th>
                    <th class="border-b border-slate-500 py-2">Nama Dosen Penguji 3</th>
                    <th class="border-b border-slate-500 py-2">Keterangan Revisi Alat</th>
                    <th class="border-b border-slate-500 py-2">Keterangan Revisi Laporan</th>
                    <th class="border-b border-slate-500 py-2">Tanggal Selesai Revisi</th>
                    <th class="border-b border-slate-500 py-2">Nilai Kelulusan Skripsi</th>
                    <th class="border-b border-slate-500 py-2">Nilai Mutu Skripsi</th>
                    <th class="border-b border-slate-500 py-2">No HP</th>
                    <th class="border-b border-slate-500 py-2">Email</th>
                    <th class="border-b border-slate-500 py-2">Sertifikat Lomba</th>
                    <th class="border-b border-slate-500 py-2">Sertifikat TOEIC</th>
                    <th class="border-b border-slate-500 py-2">Sertifikat Prestasi</th>
                    <th class="border-b border-slate-500 py-2">Sertifikat PKKP</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $startNumber = ($data->currentPage() - 1) * $data->perPage() + 1;
                @endphp
                @foreach ($data as $index => $mhsw)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $startNumber + $index }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->nim }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->prodi->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->kelas->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->skripsi ? $mhsw->user->skripsi->judul : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->skripsi ? $mhsw->user->skripsi->sub_judul : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->tanggal : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->bimbinganMahasiswa ? $mhsw->user->bimbinganMahasiswa->bimbinganDosen->nama : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->bimbinganMahasiswa ? ($mhsw->user->bimbinganMahasiswa->dosen2_id ? $mhsw->user->bimbinganMahasiswa->bimbinganDosen2->nama : '-') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji1->nama : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji2->nama : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji3->nama : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->revisi_alat : 'Lulus tanpa revisi') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->revisi_laporan : 'Lulus tanpa revisi') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->tanggal_revisi : 'Lulus tanpa revisi') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->nilai_total : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->nilai_mutu : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->no_kontak }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->email }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->status == 'Lulus' ? 'Lengkap' : '-') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-' }}
                        </td>
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
