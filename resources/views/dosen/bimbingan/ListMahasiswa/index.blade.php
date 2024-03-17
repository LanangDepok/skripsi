@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <p class="text-center text-2xl font-semibold mb-6">List Mahasiswa</p>
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama</th>
                    <th class="border-b border-slate-500 py-2">NIM</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Anggota TIm</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412006</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. At, quidem! Suscipit, ipsa! Iste autem dolore molestias doloremque fugiat quasi
                        aliquid veritatis ab, accusamus repudiandae earum quisquam nobis magnam, corporis numquam?</td>
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                    <td class="border-b border-slate-500 py-2 text-center">Kurniawan, Kurniadi</td>
                    <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/bimbingan/listMahasiswa/1">Detail</a></button>
                    </td>
                </tr>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Udin Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412005</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Quasi ducimus in perferendis, libero maxime totam atque reiciendis accusamus
                        deleniti beatae dignissimos molestiae ut distinctio ipsam?</td>
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                    <td class="border-b border-slate-500 py-2 text-center">Kurniawan, Kurniadi</td>
                    <td class="border-b border-slate-500 py-2 text-center">Mengajukan Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/bimbingan/listMahasiswa/1">Detail</a></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
