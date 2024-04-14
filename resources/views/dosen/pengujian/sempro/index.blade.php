@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pengujian Seminar Proposal</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Penguji</th>
                    <th class="border-b border-slate-500 py-2">Tanggal Sidang</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                {{-- @if (count($dosen_pembimbing) > 0)
                    <p>Mahasiswa Bimbingan</p>
                    <div class="w-3/4 h-1 bg-primary"></div>
                @endif --}}
                @foreach ($dosen_pembimbing as $dosen_pembimbing)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_pembimbing->pengajuanSemproMahasiswa->nama }}
                            ({{ $dosen_pembimbing->pengajuanSemproMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_pembimbing->pengajuanSemproMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_pembimbing->pengajuanSemproMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_pembimbing->pengajuanSemproDospem->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            1. {{ $dosen_pembimbing->pengajuanSemproPenguji1->nama }}<br>
                            2. {{ $dosen_pembimbing->pengajuanSemproPenguji2->nama }}<br>
                            3. {{ $dosen_pembimbing->pengajuanSemproPenguji3->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_pembimbing->tanggal }}</td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/dosen/pengujian/sempro/{{ $dosen_pembimbing->id }}"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a></button>
                        </td>
                    </tr>
                @endforeach
                @foreach ($ketua_sidang as $ketua_sidang)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $ketua_sidang->pengajuanSemproMahasiswa->nama }}
                            ({{ $ketua_sidang->pengajuanSemproMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $ketua_sidang->pengajuanSemproMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $ketua_sidang->pengajuanSemproMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $ketua_sidang->pengajuanSemproDospem->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            1. {{ $ketua_sidang->pengajuanSemproPenguji1->nama }}<br>
                            2. {{ $ketua_sidang->pengajuanSemproPenguji2->nama }}<br>
                            3. {{ $ketua_sidang->pengajuanSemproPenguji3->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $ketua_sidang->tanggal }}</td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/dosen/pengujian/sempro/{{ $ketua_sidang->id }}"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a></button>
                            <a href="/dosen/pengujian/sempro/{{ $ketua_sidang->id }}/terima"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Nilai</a></button>
                        </td>
                    </tr>
                @endforeach
                @foreach ($dosen_penguji as $dosen_penguji)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_penguji->pengajuanSemproMahasiswa->nama }}
                            ({{ $dosen_penguji->pengajuanSemproMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_penguji->pengajuanSemproMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_penguji->pengajuanSemproMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $dosen_penguji->pengajuanSemproDospem->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            1. {{ $dosen_penguji->pengajuanSemproPenguji1->nama }}<br>
                            2. {{ $dosen_penguji->pengajuanSemproPenguji2->nama }}<br>
                            3. {{ $dosen_penguji->pengajuanSemproPenguji3->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $dosen_penguji->tanggal }}</td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/dosen/pengujian/sempro/{{ $dosen_penguji->id }}"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
