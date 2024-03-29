@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Edit Biodata Dosen</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <form method="POST" action="/admin/dosen/{{ $dosen->id }}">
                        @csrf
                        <div class="text-left mb-4">
                            <label for="email">Email<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="email" id="email" value="{{ $dosen->user->email }}">
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
                            <label for="nama">Nama<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nama" id="nama" value="{{ $dosen->user->nama }}">
                        </div>
                        @error('nama')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="nip">NIP<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nip" id="nip" value="{{ $dosen->nip }}">
                        </div>
                        @error('nip')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="jabatan">jabatan:</label>
                            <select name="jabatan" id="jabatan" class="block border border-primary rounded-md w-full">
                                <option value="Jabatan 1" {{ $dosen->jabatan == 'Jabatan 1' ? 'selected' : '' }}>Jabatan 1
                                </option>
                                <option value="Jabatan 2" {{ $dosen->jabatan == 'Jabatan 2' ? 'selected' : '' }}>Jabatan 2
                                </option>
                                <option value="Jabatan 3" {{ $dosen->jabatan == 'Jabatan 3' ? 'selected' : '' }}>Jabatan 3
                                </option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="Fungsional">Fungsional:</label>
                            <select name="fungsional" id="Fungsional" class="block border border-primary rounded-md w-full">
                                <option value="Fungsional 1" {{ $dosen->fungsional == 'Fungsional 1' ? 'selected' : '' }}>
                                    Fungsional 1</option>
                                <option value="Fungsional 2" {{ $dosen->fungsional == 'Fungsional 2' ? 'selected' : '' }}>
                                    Fungsional 2</option>
                                <option value="Fungsional 3" {{ $dosen->fungsional == 'Fungsional 3' ? 'selected' : '' }}>
                                    Fungsional 3</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="gol_pangkat">gol_pangkat:</label>
                            <select name="gol_pangkat" id="gol_pangkat"
                                class="block border border-primary rounded-md w-full">
                                <option value="gol_pangkat 1"
                                    {{ $dosen->gol_pangkat == 'gol_pangkat 1' ? 'selected' : '' }}>
                                    gol_pangkat 1</option>
                                <option value="gol_pangkat 2"
                                    {{ $dosen->gol_pangkat == 'gol_pangkat 2' ? 'selected' : '' }}>
                                    gol_pangkat 2</option>
                                <option value="gol_pangkat 3"
                                    {{ $dosen->gol_pangkat == 'gol_pangkat 3' ? 'selected' : '' }}>
                                    gol_pangkat 3</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <p>Role</p>
                            <input type="checkbox" id="dosen_pembimbing" name="role[]" value="Dosen Pembimbing"
                                {{ in_array('Dosen Pembimbing', $dosen->role) ? 'checked' : '' }}>
                            <label for="dosen_pembimbing">Dosen Pembimbing</label><br>
                            <input type="checkbox" id="dosen_penguji" name="role[]" value="Dosen Penguji"
                                {{ in_array('Dosen Penguji', $dosen->role) ? 'checked' : '' }}>
                            <label for="dosen_penguji">Dosen Penguji</label><br>
                            <input type="checkbox" id="ketua_penguji" name="role[]" value="Ketua Penguji"
                                {{ in_array('Ketua Penguji', $dosen->role) ? 'checked' : '' }}>
                            <label for="ketua_penguji">Ketua Penguji</label><br>
                            <input type="checkbox" id="komite" name="role[]" value="Komite"
                                {{ in_array('Komite', $dosen->role) ? 'checked' : '' }}>
                            <label for="komite">Komite</label><br>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <button type="button"
                                    class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white"><a
                                        href="/admin/dosen">Back</a></button>
                            </div>
                            @method('PUT')
                            <div class="text-center mt-12">
                                <button type="submit"
                                    class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
