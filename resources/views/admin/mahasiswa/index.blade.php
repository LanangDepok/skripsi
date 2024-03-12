@extends('admin.template')

@section('content')
    <div class="container mx-auto flex justify-center">
        <a href="/admin/mahasiswa/create"
            class="bg-primary text-white p-2 rounded-xl hover:text-black hover:bg-red-300">Tambah
            Mahasiswa</a>
    </div>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <div class="flex justify-evenly items-center">
            <div>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" class="w-56">
            </div>
            <div>
                <label for="program_studi">Program Studi:</label>
                <select name="program_studi" id="program_studi" class="w-56">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Multimedia Digital">Teknik Multimedia Digital</option>
                    <option value="Teknik Multimedia dan Jaringan">Teknik Multimedia dan Jaringan</option>
                </select>
            </div>
            <div>
                <label for="tahun_ajaran">Tahun Ajaran:</label>
                <select name="tahun_ajaran" id="tahun_ajaran" class="w-56">
                    <option value="">2023-2024</option>
                </select>
            </div>
            <button class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
        </div>
    </div>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama</th>
                    <th class="border-b border-slate-500 py-2">NIM</th>
                    <th class="border-b border-slate-500 py-2">Kelas</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Tahun Ajaran</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412006</td>
                    <td class="border-b border-slate-500 py-2 text-center">TI-CCIT</td>
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">2023-2024</td>
                    <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/admin/mahasiswa/1">Detail</a></button>
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/admin/mahasiswa/1/edit">Edit</a></button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Delete</button>
                    </td>
                </tr>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412006</td>
                    <td class="border-b border-slate-500 py-2 text-center">TI-CCIT</td>
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">2023-2024</td>
                    <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Edit</button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Delete</button>
                    </td>
                </tr>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412006</td>
                    <td class="border-b border-slate-500 py-2 text-center">TI-CCIT</td>
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">2023-2024</td>
                    <td class="border-b border-slate-500 py-2 text-center">Seminar Proposal</td>
                    <td class="text-center  border-b border-slate-500">
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Edit</button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
