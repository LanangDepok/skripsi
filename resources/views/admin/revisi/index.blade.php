@extends('admin.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Daftar Pengajuan Revisi</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Dosen Penguji</th>
                    <th class="border-b border-slate-500 py-2">Nilai Akhir</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($pengajuanRevisi as $pengajuanRevisi)
                    @if ($pengajuanRevisi->status != 'Diterima')
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
                                <p>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>1. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                                <p>2. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
                                <p>3. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanRevisi->pengajuanSkripsi->nilai_total }}</td>
                            <td class="border-b border-slate-500 text-center">
                                <a href="/admin/revisi/{{ $pengajuanRevisi->id }}"
                                    class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
