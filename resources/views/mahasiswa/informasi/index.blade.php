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
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
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
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
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
                                <button class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300">
                                    <a href="/mahasiswa/informasi/1/berita_skripsi">Berita Acara</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endisset
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
