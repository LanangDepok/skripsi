@extends('admin.template')

@section('content')
    <div class="container mx-auto flex justify-center">
        <button class="bg-primary text-white p-2 rounded-xl hover:text-black hover:bg-red-300"><a
                href="/admin/dosen/create">Tambah
                Dosen</a></button>
    </div>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <div class="flex justify-evenly items-center">
            <div>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" class="w-56">
            </div>
            <div>
                <label for="tahun_ajaran">Role:</label>
                <select name="tahun_ajaran" id="tahun_ajaran" class="w-56">
                    <option value="">Ketua Sidang</option>
                    <option value="">Dosen Penguji</option>
                    <option value="">Dosen Pembimbing</option>
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
                    <th class="border-b border-slate-500 py-2">NIP</th>
                    <th class="border-b border-slate-500 py-2">Role</th>
                    <th class="border-b border-slate-500 py-2">Mahasiswa dibimbing</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Pak Anggi, S.T, M.T</td>
                    <td class="border-b border-slate-500 py-2 text-center">01234567890</td>
                    <td class="border-b border-slate-500 py-2 text-center">Ketua Sidang</td>
                    <td class="border-b border-slate-500 py-2 text-center">3</td>
                    <td class="text-center  border-b border-slate-500">
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/admin/dosen/1/edit">Edit</a></button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Delete</button>
                    </td>
                </tr>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Pak Anggi, S.T, M.T</td>
                    <td class="border-b border-slate-500 py-2 text-center">01234567890</td>
                    <td class="border-b border-slate-500 py-2 text-center">Dosen Penguji</td>
                    <td class="border-b border-slate-500 py-2 text-center">3</td>
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
                    <td class="border-b border-slate-500 py-2 text-center">Pak Anggi, S.T, M.T</td>
                    <td class="border-b border-slate-500 py-2 text-center">01234567890</td>
                    <td class="border-b border-slate-500 py-2 text-center">Dosen Pembimbing</td>
                    <td class="border-b border-slate-500 py-2 text-center">3</td>
                    <td class="text-center  border-b border-slate-500">
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Detail</button>
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="">Edit</a></button>
                        <button
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
