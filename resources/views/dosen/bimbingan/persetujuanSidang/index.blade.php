@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <p class="text-center text-2xl font-semibold mb-6">Persetujuan Sidang</p>
        <div>
            <p class="text-red-600 ml-10 font-semibold">Keterangan</p>
            <p class="ml-10">1. Persetujuan Seminar Proposal merupakan <span class="font-bold">form F1</span></p>
            <p class="ml-10">2. Persetujuan Sidang Skripsi merupakan <span class="font-bold">form F4</span></p>
        </div>
        <div class="mx-auto mt-6 overflow-x-auto">
            <table class="table-auto mx-auto border-2 border-slate-500 w-full">
                <thead class="bg-primary">
                    <tr>
                        <th class="border-b border-slate-500 py-2">No.</th>
                        <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                        <th class="border-b border-slate-500 py-2">Judul</th>
                        <th class="border-b border-slate-500 py-2">Program Studi</th>
                        <th class="border-b border-slate-500 py-2">Jenis Sidang</th>
                        <th class="border-b border-slate-500 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach (Auth::user()->pengajuanSemproDospem->where('status', '=', 'Menunggu persetujuan pembimbing') as $pengajuanSempro)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
                                <p>({{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }})</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="{{ route('dsn.getPersetujuanSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach (Auth::user()->pengajuanSkripsiDospem->where('status', '=', 'Menunggu persetujuan pembimbing') as $pengajuanSkripsi)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
                                <p>({{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">Sidang Skripsi</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="{{ route('dsn.getPersetujuanSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a></button>
                            </td>
                        </tr>
                    @endforeach

                    @foreach (Auth::user()->pengajuanSkripsiDospem2->where('status', '=', 'Menunggu persetujuan pembimbing') as $pengajuanSkripsi2)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $pengajuanSkripsi2->pengajuanSkripsiMahasiswa->nama }}</p>
                                <p>({{ $pengajuanSkripsi2->pengajuanSkripsiMahasiswa->mahasiswa->nim }})</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSkripsi2->pengajuanSkripsiMahasiswa->skripsi->judul }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $pengajuanSkripsi2->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">Sidang Skripsi</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="{{ route('dsn.getPersetujuanSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi2->id]) }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
