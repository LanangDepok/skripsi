@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Daftar Pengajuan Revisi</p>
    <div class="container mx-auto mt-6 overflow-x-auto">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Penguji</th>
                    <th class="border-b border-slate-500 py-2">Nilai Akhir</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($terima_penguji1 as $terima_penguji1)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>{{ $terima_penguji1->pengajuanSkripsiMahasiswa->nama }}</p>
                            <p>{{ $terima_penguji1->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji1->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji1->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji1->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($terima_penguji1->dospem2_id) ? $terima_penguji1->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji1->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $terima_penguji1->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $terima_penguji1->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $terima_penguji1->nilai_total }}</td>
                        <td class="border-b border-slate-500 text-center">
                            <a href="{{ route('dsn.getRevisi', ['pengajuanRevisi' => $terima_penguji1->pengajuanRevisi->id]) }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($terima_penguji2 as $terima_penguji2)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>{{ $terima_penguji2->pengajuanSkripsiMahasiswa->nama }}</p>
                            <p>{{ $terima_penguji2->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji2->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji2->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji2->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($terima_penguji2->dospem2_id) ? $terima_penguji2->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji2->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $terima_penguji2->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $terima_penguji2->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $terima_penguji2->nilai_total }}</td>
                        <td class="border-b border-slate-500 text-center">
                            <a href="{{ route('dsn.getRevisi', ['pengajuanRevisi' => $terima_penguji2->pengajuanRevisi->id]) }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($terima_penguji3 as $terima_penguji3)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>{{ $terima_penguji3->pengajuanSkripsiMahasiswa->nama }}</p>
                            <p>{{ $terima_penguji3->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji3->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_penguji3->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji3->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($terima_penguji3->dospem2_id) ? $terima_penguji3->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_penguji3->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $terima_penguji3->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $terima_penguji3->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $terima_penguji3->nilai_total }}</td>
                        <td class="border-b border-slate-500 text-center">
                            <a href="{{ route('dsn.getRevisi', ['pengajuanRevisi' => $terima_penguji3->pengajuanRevisi->id]) }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($terima_pembimbing as $terima_pembimbing)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>{{ $terima_pembimbing->pengajuanSkripsiMahasiswa->nama }}</p>
                            <p>{{ $terima_pembimbing->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_pembimbing->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_pembimbing->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_pembimbing->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($terima_pembimbing->dospem2_id) ? $terima_pembimbing->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_pembimbing->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $terima_pembimbing->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $terima_pembimbing->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $terima_pembimbing->nilai_total }}</td>
                        <td class="border-b border-slate-500 text-center">
                            <a href="{{ route('dsn.getRevisi', ['pengajuanRevisi' => $terima_pembimbing->pengajuanRevisi->id]) }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($terima_pembimbing2 as $terima_pembimbing2)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>{{ $terima_pembimbing2->pengajuanSkripsiMahasiswa->nama }}</p>
                            <p>{{ $terima_pembimbing2->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_pembimbing2->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $terima_pembimbing2->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_pembimbing2->pengajuanSkripsiDospem->nama }}</p>
                            <p>2.
                                {{ isset($terima_pembimbing2->dospem2_id) ? $terima_pembimbing2->pengajuanSkripsiDospem2->nama : '-' }}
                            </p>
                        </td>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $terima_pembimbing2->pengajuanSkripsiPenguji1->nama }}</p>
                            <p>2. {{ $terima_pembimbing2->pengajuanSkripsiPenguji2->nama }}</p>
                            <p>3. {{ $terima_pembimbing2->pengajuanSkripsiPenguji3->nama }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $terima_pembimbing2->nilai_total }}</td>
                        <td class="border-b border-slate-500 text-center">
                            <a href="{{ route('dsn.getRevisi', ['pengajuanRevisi' => $terima_pembimbing2->pengajuanRevisi->id]) }}"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
