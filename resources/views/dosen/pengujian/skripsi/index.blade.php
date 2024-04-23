@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pengujian Skripsi</p>
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
                @foreach ($dosen_pembimbing as $dosen_pembimbing)
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
