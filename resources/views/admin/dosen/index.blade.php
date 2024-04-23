@extends('admin.template')

@section('content')
    @can('admin')
        <div class="container mx-auto flex justify-center">
            <a href="/admin/dosen/create" class="bg-primary text-white p-2 rounded-xl hover:text-black hover:bg-red-300">Tambah
                Dosen</a>
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
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
            role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">No.</th>
                    <th class="border-b border-slate-500 py-2">Nama</th>
                    <th class="border-b border-slate-500 py-2">NIP</th>
                    <th class="border-b border-slate-500 py-2">Role</th>
                    <th class="border-b border-slate-500 py-2">Mahasiswa dibimbing</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($data as $dosen)
                    <tr class="even:bg-slate-300">
                        <form method="POST" action="/admin/dosen/{{ $dosen->id }}">
                            @csrf
                            <td class="border-b border-slate-500 py-2 text-center">{{ ++$i }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen->user->nama }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ $dosen->nip }}</td>
                            <td class="border-b border-slate-500 py-2 text-center">
                                @php
                                    $roles = $dosen->user->roles->pluck('nama')->implode(', ');
                                @endphp
                                {{ $roles }}
                            </td>
                            <td class="border-b border-slate-500 py-2 text-center">{{ count($dosen->user->bimbinganDosen) }}
                            </td>
                            <td class="text-center  border-b border-slate-500">
                                <a href="/admin/dosen/{{ $dosen->id }}"
                                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Detail</a>
                                @can('admin')
                                    <a href="/admin/dosen/{{ $dosen->id }}/edit"
                                        class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Edit</a>
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                                        onclick="confirmDelete(event)">Delete</button>
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
