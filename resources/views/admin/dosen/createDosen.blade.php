@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Isi Biodata Dosen</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <form method="POST" action="{{ route('adm.storeLecturer') }}">
                    @csrf
                    <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                        @if (session('success'))
                            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
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
                            <label for="nama">Nama<span class="text-red-700">*</span></label>
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
                            <label for="nip">NIP<span class="text-red-700">*</span></label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nip" id="nip" value="{{ old('nip') }}">
                        </div>
                        @error('nip')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <span class="font-medium">Error!</span> {{ $message }}
                            </div>
                        @enderror
                        <div class="text-left mb-4">
                            <label for="jabatan">Jabatan:</label>
                            <select name="jabatan_id" id="jabatan" class="block border border-primary rounded-md w-full">
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="fungsional">Jabatan Fungsional:</label>
                            <select name="fungsional_id" id="fungsional"
                                class="block border border-primary rounded-md w-full">
                                @foreach ($fungsional as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="gol_pangkat">Pangkat Golongan:</label>
                            <select name="gol_pangkat_id" id="gol_pangkat"
                                class="block border border-primary rounded-md w-full">
                                @foreach ($golongan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <p>Role</p>
                            {{-- <input type="checkbox" id="ketua_komite" name="role[]" value="7" onchange="checkKomite()">
                            <label for="ketua_komite">Ketua Komite</label><br> --}}
                            <input type="checkbox" id="komite" name="role[]" value="2">
                            <label for="komite">Komite</label><br>
                            <input type="checkbox" id="ketua_penguji" name="role[]" value="3"
                                onchange="checkDosenPenguji()">
                            <label for="ketua_penguji">Ketua Penguji</label><br>
                            <input type="checkbox" id="dosen_penguji" name="role[]" value="4">
                            <input type="hidden" id="dosen_penguji2" name="role[]" value="4" disabled>
                            <label for="dosen_penguji">Dosen Penguji</label><br>
                            <input type="checkbox" id="dosen_pembimbing" name="role[]" value="5">
                            <label for="dosen_pembimbing">Dosen Pembimbing</label><br>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <a href="{{ route('adm.getLecturers') }}"
                                    class="bg-primary w-24 rounded-2xl hover:bg-red-300 text-white block items-center">Back</a></button>
                            </div>
                            <div class="text-center mt-12">
                                <button type="submit"
                                    class="bg-primary w-24 rounded-2xl hover:bg-red-300 text-white">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function checkDosenPenguji() {
            var ketuaPengujiCheckbox = document.getElementById('ketua_penguji');
            var dosenPengujiCheckbox = document.getElementById('dosen_penguji');
            var dosenPenguji2Checkbox = document.getElementById('dosen_penguji2');

            if (ketuaPengujiCheckbox.checked) {
                dosenPengujiCheckbox.checked = true;
                dosenPengujiCheckbox.disabled = true;
                dosenPenguji2Checkbox.disabled = false;
            } else {
                dosenPengujiCheckbox.disabled = false;
                dosenPenguji2Checkbox.disabled = true;
            }
        }
    </script>

    {{-- <script>
        function checkKomite() {
            var ketuaKomiteCheckbox = document.getElementById('ketua_komite');
            var komiteCheckbox = document.getElementById('komite');

            if (ketuaKomiteCheckbox.checked) {
                komiteCheckbox.checked = true;
                komiteCheckbox.disabled = true;
            } else {
                komiteCheckbox.disabled = false;
            }
        }
    </script> --}}
@endsection
