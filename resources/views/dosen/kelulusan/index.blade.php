@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Keputusan Kelulusan</p>
    <div class="mx-auto mt-6 overflow-x-auto">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Penguji</th>
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
                            {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td id="nilaiPembimbing" class="border-b border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai_total }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->status }}</td>
                        <td class="border-b border-slate-500">
                            <a href="{{ route('dsn.getKelulusan', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}"
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
