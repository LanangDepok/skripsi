@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <p class="text-center text-2xl font-semibold mb-6">List Mahasiswa</p>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Anggota TIm</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach (Auth::user()->dosen->bimbingans as $listMahasiswa)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $listMahasiswa->mahasiswa->user->nama }} ({{ $listMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $listMahasiswa->mahasiswa->user->skripsi->judul }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $listMahasiswa->mahasiswa->user->skripsi->anggota }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $listMahasiswa->mahasiswa->status }}
                        </td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="/dosen/bimbingan/listMahasiswa/{{ $listMahasiswa->id }}"
                                class="bg-primary border rounded-md w-16 block mx-auto text-white hover:text-black hover:bg-red-300">Detail</a></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
