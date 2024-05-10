@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Keputusan Kelulusan</p>
    <div class="container mx-auto mt-6">
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Nilai Akhir</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($pengajuanSkripsi as $pengajuanSkripsi)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p> {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }} </p>
                            <p> ({{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}) </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</td>
                        <td id="nilaiPembimbing" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai_total }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->status }}</td>
                        <td class="border-b border-slate-500">
                            <a href="/dosen/kelulusan/{{ $pengajuanSkripsi->id }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto block text-center">Detail</a>
                            {{-- <button id="revisiButton"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Revisi</button>
                            <button id="lulusButton"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Luluskan</button>
                            <button
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Tolak</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
