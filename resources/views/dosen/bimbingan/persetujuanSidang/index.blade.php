@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <p class="text-center text-2xl font-semibold mb-6">Persetujuan Sidang</p>
        <div>
            <p class="text-red-600 ml-10 font-semibold">Keterangan</p>
            <p class="ml-10">1. Persetujuan Seminar Proposal merupakan <span class="font-bold">form F1</span></p>
            <p class="ml-10">2. Persetujuan Sidang Skripsi merupakan <span class="font-bold">form F4</span></p>
        </div>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full mt-5">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Jenis Sidang</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">
                        <p>Bagas Rizkiyanto</p>
                        <p>(2007412006)</p>
                    </td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Eum, quidem commodi facere delectus eaque accusantium. Dolore vitae animi harum
                        nisi aliquid aspernatur repellendus autem pariatur obcaecati et! Excepturi, laudantium facilis.</td>
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">Sidang Skripsi</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/bimbingan/persetujuanSidang/1">Detail</a></button>
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="#">Terima</a></button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
                    </td>
                </tr>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">
                        <p>Udin yang pertama</p>
                        <p>(2007412006)</p>
                    </td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem ipsum, dolor sit amet consectetur
                        adipisicing elit. Totam illo esse, officiis voluptates alias quidem id suscipit modi sint neque, aut
                        vero, earum perspiciatis? Sapiente qui pariatur provident optio necessitatibus harum distinctio
                        architecto obcaecati cumque!</td>
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/bimbingan/logbook/1">Detail</a></button>
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="#">Terima</a></button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
