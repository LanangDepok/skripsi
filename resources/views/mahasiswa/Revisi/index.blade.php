@extends('mahasiswa.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Daftar Revisi</p>
    <div class="container mx-auto mt-6">
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Dosen Penguji</th>
                    <th class="border-b border-slate-500 py-2">Revisi alat</th>
                    <th class="border-b border-slate-500 py-2">Revisi laporan</th>
                    <th class="border-b border-slate-500 py-2">Deadline</th>
                    @isset($pengajuanRevisi)
                        @if ($pengajuanRevisi->status == 'Revisi')
                            <th class="border-b border-slate-500 py-2">Action</th>
                        @endif
                    @endisset
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @isset($pengajuanRevisi)
                    <tr class="even:bg-slate-300">
                        <form method="POST" action="/mahasiswa/revisi/{{ $pengajuanRevisi->id }}">
                            @csrf
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>1. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                                <p>2. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
                                <p>3. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($pengajuanRevisi->revisi_alat) ? $pengajuanRevisi->revisi_alat : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($pengajuanRevisi->revisi_laporan) ? $pengajuanRevisi->revisi_laporan : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <span class="text-red-600">{{ $pengajuanRevisi->deadline }}</span>
                            </td>
                            @if ($pengajuanRevisi->status == 'Revisi')
                                <td class="border-b border-slate-500 text-center">
                                    <a href="/mahasiswa/revisi/{{ $pengajuanRevisi->id }}"
                                        class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                                </td>
                            @endif
                        </form>
                    </tr>
                @endisset
            </tbody>
        </table>
    </div>
@endsection
