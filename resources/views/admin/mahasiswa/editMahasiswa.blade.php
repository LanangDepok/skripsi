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
                            <select name="kelas" id="kelas" class="block border border-primary rounded-md w-full">
                                <option value="TI-CCIT" {{ $mahasiswa->kelas == 'TI-CCIT' ? 'selected' : '' }}>TI-CCIT
                                </option>
                                <option value="SEC-CCIT" {{ $mahasiswa->kelas == 'SEC-CCIT' ? 'selected' : '' }}>SEC-CCIT
                                </option>
                                <option value="TMJ" {{ $mahasiswa->kelas == 'TMJ' ? 'selected' : '' }}>TMJ</option>
                                <option value="TMD" {{ $mahasiswa->kelas == 'TMD' ? 'selected' : '' }}>TMD</option>
                                <option value="TI" {{ $mahasiswa->kelas == 'TI' ? 'selected' : '' }}>TI</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="prodi">Prodi:</label>
                            <select name="prodi" id="prodi" class="block border border-primary rounded-md w-full">
                                <option value="Teknik Informatika"
                                    {{ $mahasiswa->prodi == 'Teknik Informatika' ? 'selected' : '' }}>
                                    Teknik Informatika
                                </option>
                                <option value="Teknik Multimedia Digital"
                                    {{ $mahasiswa->prodi == 'Teknik Multimedia Digital' ? 'selected' : '' }}>
                                    Teknik Multimedia Digital
                                </option>
                                <option value="Teknik Multimedia dan Jaringan"
                                    {{ $mahasiswa->prodi == 'Teknik Multimedia dan Jaringan' ? 'selected' : '' }}>
                                    Teknik Multimedia dan Jaringan
                                </option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="tahun_ajaran">Tahun Ajaran<span class="text-red-700">*</span></label>
                            <p>Contoh penulisan: 2023-2024</p>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="tahun_ajaran" id="tahun_ajaran" value="{{ $mahasiswa->tahun_ajaran }}">
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
