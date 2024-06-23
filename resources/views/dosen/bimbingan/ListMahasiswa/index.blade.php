@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <p class="text-center text-2xl font-semibold mb-6">List Mahasiswa</p>
        <div class="container mx-auto mt-6 overflow-x-auto">
            <table class="table-auto mx-auto border-2 border-slate-500 w-full">
                <thead class="bg-primary">
                    <tr>
                        <th class="border-b border-slate-500 py-2">No.</th>
                        <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                        <th class="border-b border-slate-500 py-2">Judul</th>
                        <th class="border-b border-slate-500 py-2">Pembimbing 1</th>
                        <th class="border-b border-slate-500 py-2">Pembimbing 2</th>
                        <th class="border-b border-slate-500 py-2">Anggota TIm</th>
                        <th class="border-b border-slate-500 py-2">Status</th>
                        <th class="border-b border-slate-500 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach (Auth::user()->bimbinganDosen as $listMahasiswa)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->nama }}
                                ({{ $listMahasiswa->bimbinganMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->skripsi->judul }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganDosen->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($listMahasiswa->dosen2_id) ? $listMahasiswa->bimbinganDosen2->nama : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->skripsi->anggota }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->mahasiswa->status }}
                            </td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/bimbingan/listMahasiswa/{{ $listMahasiswa->id }}"
                                    class="bg-primary border rounded-md w-16 block mx-auto text-white hover:text-black hover:bg-red-300">Detail</a>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSemproMahasiswa->isNotEmpty())
                                        @php
                                            $latestSempro = $listMahasiswa->bimbinganMahasiswa->pengajuanSemproMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSempro->status != 'Ditolak' && $latestSempro->status != 'Menunggu persetujuan pembimbing')
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f1"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F1
                                            </a>
                                        @endif
                                        @if ($latestSempro->status == 'Lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f2"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F2
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f3"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F3
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status != 'Menunggu persetujuan pembimbing' && $latestSkripsi->status != 'Ditolak')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f4"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F4
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f5"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F5
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f6a"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F6
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f6b"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F6
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7a"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7a
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7b"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7b
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7c"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7c
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f8"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F8
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f9"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F9
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->pengajuanRevisi)
                                            @if (
                                                $latestSkripsi->status == 'Lulus' ||
                                                    $latestSkripsi->status == 'Revisi' ||
                                                    $latestSkripsi->status == 'Menunggu persetujuan revisi')
                                                <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f10"
                                                    class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                    F10
                                                </a>
                                            @endif
                                            @if ($latestSkripsi->status == 'Lulus')
                                                <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f11"
                                                    class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                    F11
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach (Auth::user()->bimbinganDosen2 as $listMahasiswa)
                        <tr class="even:bg-slate-300">
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->nama }}
                                ({{ $listMahasiswa->bimbinganMahasiswa->mahasiswa->nim }})
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->skripsi->judul }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganDosen->nama }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($listMahasiswa->dosen2_id) ? $listMahasiswa->bimbinganDosen2->nama : '-' }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->skripsi->anggota }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ $listMahasiswa->bimbinganMahasiswa->mahasiswa->status }}
                            </td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/dosen/bimbingan/listMahasiswa/{{ $listMahasiswa->id }}"
                                    class="bg-primary border rounded-md w-16 block mx-auto text-white hover:text-black hover:bg-red-300">Detail</a>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSemproMahasiswa->isNotEmpty())
                                        @php
                                            $latestSempro = $listMahasiswa->bimbinganMahasiswa->pengajuanSemproMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSempro->status != 'Ditolak' && $latestSempro->status != 'Menunggu persetujuan pembimbing')
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f1"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F1
                                            </a>
                                        @endif
                                        @if ($latestSempro->status == 'Lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f2"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F2
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSempro->id }}/f3"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F3
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status != 'Menunggu persetujuan pembimbing' && $latestSkripsi->status != 'Ditolak')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f4"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F4
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f5"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F5
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f6a"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F6
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f6b"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F6
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7a"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7a
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7b"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7b
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f7c"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F7c
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa->isNotEmpty())
                                        @php
                                            $latestSkripsi = $listMahasiswa->bimbinganMahasiswa->pengajuanSkripsiMahasiswa
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($latestSkripsi->status == 'Lulus' || $latestSkripsi->status == 'Tidak lulus')
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f8"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F8
                                            </a>
                                            <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f9"
                                                class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                F9
                                            </a>
                                        @endif
                                        @if ($latestSkripsi->pengajuanRevisi)
                                            @if (
                                                $latestSkripsi->status == 'Lulus' ||
                                                    $latestSkripsi->status == 'Revisi' ||
                                                    $latestSkripsi->status == 'Menunggu persetujuan revisi')
                                                <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f10"
                                                    class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                    F10
                                                </a>
                                            @endif
                                            @if ($latestSkripsi->status == 'Lulus')
                                                <a href="/mahasiswa/informasi/{{ $latestSkripsi->id }}/f11"
                                                    class="bg-primary border rounded-md w-8 text-white hover:text-black hover:bg-red-300 inline-block mx-auto">
                                                    F11
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
