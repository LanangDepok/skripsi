@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Tambah Program Studi</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <form method="POST" action="/admin/database/prodi">
                    @csrf
                    <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                        <div class="text-left mb-4">
                            <label for="nama">Program Studi<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nama" id="nama" value="{{ old('nama') }}">
                        </div>
                        @error('nama')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <a href="/admin/database/prodi"
                                    class="bg-primary w-24 rounded-2xl hover:bg-red-300 text-white block items-center">Back</a></button>
                            </div>
                            <div class="text-center mt-12">
                                <button type="submit" class="bg-primary w-24 rounded-2xl hover:bg-red-300 text-white"
                                    onclick="return confirm('Yakin ingin menambahkan data program studi?')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
