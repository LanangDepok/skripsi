@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-1/2">
        <p class=" text-2xl font-semibold">Pengajuan Judul & Dosen Pembimbing</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="border-b border-slate-500 py-2">Calon Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b border-slate-500 py-2 text-center">
                        <ul>
                            <li>1. Pak anggi</li>
                            <li>2. Pak asep</li>
                            <li>3. Pak mauldy</li>
                        </ul>
                    </td>
                    <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                        consectetur,
                        adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                        architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                        similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                    <td class="border-b border-slate-500 py-2 text-center">Menunggu</td>
                    <td class="text-center  border-b border-slate-500"><button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mx-auto w-1/2 mt-6">
        <p class=" text-2xl font-semibold">Hasil Sidang Seminar atau Skripsi</p>
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
                    <td class="text-center  border-b border-slate-500"><button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
