@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Edit Biodata Mahasiswa</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <form method="POST" action="/admin/mahasiswa/{{ $mahasiswa->id }}">
                        @csrf
                        <div class="text-left mb-4">
                            <label for="email">Email<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="email" id="email" value="{{ $mahasiswa->user->email }}">
                        </div>
                        @error('email')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="password">Password (Masukkan ketika ingin mengganti password)</label>
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
                            <label for="name">Nama<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nama" id="name" value="{{ $mahasiswa->user->nama }}">
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
                                name="nim" id="nim" value="{{ $mahasiswa->nim }}">
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
                                    <option value="{{ $data->id }}"
                                        {{ $data->id == $mahasiswa->kelas_id ? 'selected' : '' }}>
                                        {{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="prodi">Prodi:</label>
                            <select name="prodi_id" id="prodi" class="block border border-primary rounded-md w-full">
                                @foreach ($prodi as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $data->id == $mahasiswa->prodi_id ? 'selected' : '' }}>{{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="tahun_ajaran_id">Tahun Ajaran<span class="text-red-700">*</span></label>
                            <select name="tahun_ajaran" id="tahun_ajaran"
                                class="block border border-primary rounded-md w-full">
                                @foreach ($tahun as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $data->id == $mahasiswa->tahun_ajaran_id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <button type="button"
                                    class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white hover:text-black"><a
                                        href="/admin/mahasiswa">Back</a></button>
                            </div>
                            <div class="text-center mt-12">
                                @method('PUT')
                                <button type="submit"
                                    class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white hover:text-black"
                                    onclick="return confirm('Yakin ingin mengubah data mahasiswa atas nama {{ $mahasiswa->user->nama }}?')">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
