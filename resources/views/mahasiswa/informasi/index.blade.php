@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-3/4">
        <p class=" text-2xl font-semibold">Pengajuan Judul & Dosen Pembimbing</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
        @if (session('messages'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Error!</span> {{ session('messages') }}
            </div>
        @endif
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">No</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
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
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ isset($data->dosen_terpilih) ? $data->dosen_terpilih : 'menunggu' }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $data->status }}
                            </td>
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
    <div class="container mx-auto w-1/2 mt-6">
        <p class=" text-2xl font-semibold">Seminar Proposal</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">Tanggal</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b border-slate-500 py-2 text-center">2 Agustus 2024</td>
                    <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                        consectetur,
                        adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                        architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                        similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lulus</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">
                            Detail
                        </button>
                        <button class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300">
                            <a href="/mahasiswa/informasi/1/berita_sempro">Berita Acara</a>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-1/2 mt-6 mb-20">
        <p class=" text-2xl font-semibold">Sidang Skripsi</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">Tanggal</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b border-slate-500 py-2 text-center">2 Agustus 2024</td>
                    <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                        consectetur,
                        adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                        architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                        similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lulus</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">
                            Detail
                        </button>
                        <button class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300">
                            <a href="/mahasiswa/informasi/1/berita_skripsi">Berita Acara</a>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-1/2 mt-6 mb-20">
        <p class=" text-2xl font-semibold">Serah terima alat & skripsi</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">Tanggal</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b border-slate-500 py-2 text-center">2 Agustus 2024</td>
                    <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                        consectetur,
                        adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                        architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                        similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                    <td class="border-b border-slate-500 py-2 text-center">Menunggu</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">
                            Detail
                        </button>
                        <button class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300">
                            <a href="/mahasiswa/informasi/1/berita_skripsi">Berita Acara</a>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
