@extends('admin.template')

@section('content')
    @can('admin')
        <div class="container mx-auto flex justify-center">
            <a href="/admin/mahasiswa/create"
                class="bg-primary text-white p-2 rounded-xl hover:text-black hover:bg-red-300">Tambah
                Mahasiswa</a>
        </div>
    @endcan
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
                <label for="tahun_ajaran">Status:</label>
                <select name="tahun_ajaran" id="tahun_ajaran" class="w-56">
                    <option value="">Mengajukan judul</option>
                    <option value="">Bimbingan sempro</option>
                    <option value="">Sidang sempro</option>
                    <option value="">Bimbingan skripsi</option>
                    <option value="">Sidang skripsi</option>
                </select>
            </div>
            <button class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
        </div>
    </div>
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
            role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto mt-6">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Kelas</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Tahun Ajaran</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $mahasiswa)
                    <tr class="even:bg-slate-300">
                        <form method="POST" action="/admin/mahasiswa/{{ $mahasiswa->id }}">
                            @csrf
                            <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                <p>{{ $mahasiswa->user->nama }}</p>
                                <p>({{ $mahasiswa->nim }})</p>
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $mahasiswa->prodi }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $mahasiswa->kelas }}</td>
                            {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                            <td class="border-b border-slate-500 py-2 text-center">{{ $mahasiswa->tahun_ajaran }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                {{ empty($mahasiswa->status) ? 'Belum mengajukan judul' : $mahasiswa->status }}</td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/admin/mahasiswa/{{ $mahasiswa->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                @can('admin')
                                    <a href="/admin/mahasiswa/{{ $mahasiswa->id }}/edit"
                                        class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Edit</a>
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                                        type="submit" onclick="confirmDelete(event)">Delete</button>
                                @endcan

                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(event) {
            if (!confirm('Apakah yakin ingin menghapus?')) {
                event.preventDefault();
            }
        }
    </script>
@endsection
