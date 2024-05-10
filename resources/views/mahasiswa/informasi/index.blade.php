@extends('mahasiswa.template')

@section('content')
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
            role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    @if (session('messages'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
            role="alert">
            <span class="font-medium">Error!</span> {{ session('messages') }}
        </div>
    @endif
    <div class="container mx-auto w-full">
        <p class=" text-2xl font-semibold text-center">Pengajuan Judul & Dosen Pembimbing</p>
        <div class="bg-primary h-1 mb-3 mx-auto"></div>
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Abstrak</th>
                    <th class="border-b border-slate-500 py-2">Studi Kasus</th>
                    <th class="border-b border-slate-500 py-2">Dosen Terpilih</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @isset(Auth::user()->pengajuanJudul)
                    @php
                        $i = 1;
                    @endphp
                    @foreach (Auth::user()->pengajuanJudul->where('user_id', Auth::user()->id)->get() as $data)
                        <tr>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->abstrak }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->studi_kasus }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->dosen_terpilih) ? $data->dosen_terpilih : 'menunggu' }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->status }} </td>
                            <td class="text-center border-b border-slate-500">
                                <a href="/mahasiswa/informasi/{{ $data->id }}/pengajuanJudul"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-full mt-5">
        <p class=" text-2xl font-semibold text-center">Seminar Proposal</p>
        <div class="bg-primary h-1 mb-3 mx-auto"></div>
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Metode</th>
                    <th class="border-b border-slate-500 py-2">Tanggal sidang</th>
                    <th class="border-b border-slate-500 py-2">Nilai</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @isset(Auth::user()->pengajuanSemproMahasiswa)
                    @php
                        $i = 1;
                    @endphp
                    @foreach (Auth::user()->pengajuanSemproMahasiswa as $data)
                        <tr>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $data->pengajuanSemproMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->metode }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->tanggal) ? $data->tanggal : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->nilai) ? $data->nilai : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->status }} </td>
                            <td class="text-center border-b border-slate-500">
                                <a href="/mahasiswa/informasi/{{ $data->id }}/pengajuanSempro"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                    Detail
                                </a>
                                <div>
                                    @if ($data->status != 'Menunggu persetujuan pembimbing' && $data->status != 'Ditolak')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f1"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F1
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f2"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F2
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f3"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F3
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-full mt-5">
        <p class=" text-2xl font-semibold text-center">Sidang Skripsi</p>
        <div class="bg-primary h-1 mb-3 mx-auto"></div>
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Tanggal sidang</th>
                    <th class="border-b border-slate-500 py-2">Nilai Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Nilai Penguji</th>
                    <th class="border-b border-slate-500 py-2">Total Nilai</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @isset(Auth::user()->pengajuanSkripsiMahasiswa)
                    @php
                        $i = 1;
                    @endphp
                    @foreach (Auth::user()->pengajuanSkripsiMahasiswa as $data)
                        <tr>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $data->pengajuanSkripsiMahasiswa->skripsi->judul }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->tanggal) ? $data->tanggal : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->nilai_pembimbing) ? $data->nilai_pembimbing : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->nilai1, $data->nilai2, $data->nilai3) ? ($data->nilai1 + $data->nilai2 + $data->nilai3) / 3 : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->nilai_total) ? $data->nilai_total : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->status }} </td>
                            <td class="text-center border-b border-slate-500">
                                <a href="/mahasiswa/informasi/{{ $data->id }}/pengajuanSkripsi"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                    Detail
                                </a>
                                <div>
                                    @if ($data->status != 'Menunggu persetujuan pembimbing' && $data->status != 'Ditolak')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f4"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F4
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f5"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F5
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f6"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F6
                                        </a>
                                    @endif
                                </div>
                                <div>
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f7a"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F7a
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f7b"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F7b
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f7c"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F7c
                                        </a>
                                    @endif
                                </div>
                                <div>
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f8"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F8
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Tidak lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f9"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F9
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus' || $data->status == 'Revisi' || $data->status == 'Menunggu persetujuan revisi')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f10"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F10
                                        </a>
                                    @endif
                                    @if ($data->status == 'Lulus')
                                        <a href="/mahasiswa/informasi/{{ $data->id }}/f11"
                                            class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                            F11
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-full mt-5">
        <p class=" text-2xl font-semibold text-center">Serah terima alat & skripsi</p>
        <div class="bg-primary h-1 mb-3 mx-auto"></div>
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Keterangan</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach (Auth::user()->pengajuanAlat as $data)
                    <tr>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $data->user->skripsi->judul }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $data->status }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ isset($data->keterangan) ? $data->keterangan : '-' }}</td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/mahasiswa/informasi/{{ $data->id }}/pengajuanAlat"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
