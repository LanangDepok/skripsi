@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Nilai Akhir</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Pembimbing (Nilai)</th>
                    <th class="border-b border-slate-500 py-2">Penguji 1 (Nilai)</th>
                    <th class="border-b border-slate-500 py-2">Penguji 2 (Nilai)</th>
                    <th class="border-b border-slate-500 py-2">Penguji 3 (Nilai)</th>
                    {{-- <th class="border-b border-slate-500 py-2">Nilai Akhir</th> --}}
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
                            <p>({{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}) </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                        <td id="nilaiPembimbing" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai_pembimbing }}
                        </td>
                        <td id="nilaiPenguji1" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai1 }}
                        </td>
                        <td id="nilaiPenguji2" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai2 }}
                        </td>
                        <td id="nilaiPenguji3" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai3 }}
                        </td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/dosen/rekapitulasi/{{ $pengajuanSkripsi->id }}"
                                class="bg-primary border rounded-md w-16 block text-white hover:text-black hover:bg-red-300 mx-auto">Detail</a>
                            {{-- <button id="terimaButton"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Nilai</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
