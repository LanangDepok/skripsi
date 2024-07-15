@extends('admin.template')

@section('content')
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
            role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto flex justify-center">
        <a href="{{ route('adm.createJabatan') }}"
            class="bg-primary text-white p-2 rounded-xl hover:text-black hover:bg-red-300">
            Tambah Jabatan</a>
    </div>
    <div class="mx-auto mt-6 overflow-x-auto">
        <table class="table-auto mx-auto border-2 border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">ID</th>
                    <th class="border-b border-slate-500 py-2">Jabatan</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $jabatan)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $jabatan->id }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $jabatan->nama }}</td>
                        <td class="text-center  border-b border-slate-500">
                            <a href="{{ route('adm.editJabatan', ['jabatan' => $jabatan->id]) }}"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
