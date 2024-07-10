@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
                role="alert">
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="border-2 border-primary rounded-md w-1/2 mx-auto">
            <form method="POST" action="{{ route('adm.storeStudentExcel') }}" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <p class="text-xl font-semibold">Masukkan Excel</p>
                </div>
                <div class="text-center mt-3">
                    <input type="file" name="excel" class="border border-black rounded-sm" accept=".xlsx">
                </div>
                <div class="text-center mt-3">
                    <button type="submit"
                        class="bg-primary mb-2 w-36 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white">Import
                        excel</button>
                </div>
            </form>
        </div>
        <div class="flex justify-center mt-6">
            <p class="text-xl font-semibold">Atau</p>
        </div>
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Isi Biodata Mahasiswa</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <form method="POST" action="{{ route('adm.storeStudent') }}">
                    @csrf
                    <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                        <div class="text-left mb-4">
                            <label for="email">Email<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="email" id="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="password">Password<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="password" id="password">
                        </div>
                        @error('password')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="nama">nama<span class="text-red-700">*</span></label>
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
                        <div class="text-left mb-4">
                            <label for="nim">NIM<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nim" id="nim" value="{{ old('nim') }}">
                        </div>
                        @error('nim')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="kelas">Kelas:</label>
                            <select name="kelas_id" id="kelas" class="block border border-primary rounded-md w-full">
                                @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="prodi">Prodi:</label>
                            <select name="prodi_id" id="prodi" class="block border border-primary rounded-md w-full">
                                @foreach ($prodi as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="tahun_ajaran">Tahun Ajaran:</label>
                            <select name="tahun_ajaran_id" id="tahun_ajaran"
                                class="block border border-primary rounded-md w-full">
                                @foreach ($tahun as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4 hidden">
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="status" value="Belum mengajukan judul">
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white"
                                    type="button"><a href="{{ route('adm.getStudents') }}">Back</a></button>
                            </div>
                            <div class="text-center mt-12">
                                <button
                                    class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white"
                                    type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
