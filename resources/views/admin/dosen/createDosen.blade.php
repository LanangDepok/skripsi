@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Isi Biodata Dosen</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <form method="POST" action="/admin/dosen">
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
                            <label for="jabatan">jabatan:</label>
                            <select name="jabatan" id="jabatan" class="block border border-primary rounded-md w-full">
                                <option value="Dosen">Dosen</option>
                                <option value="KPS">KPS</option>
                                <option value="Kajur">Kajur</option>
                                <option value="Kalab">Kalab</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="fungsional">Jabatan Fungsional:</label>
                            <select name="fungsional" id="fungsional" class="block border border-primary rounded-md w-full">
                                <option value="Asisten Ahli">Asisten Ahli</option>
                                <option value="Lektor">Lektor</option>
                                <option value="Lektor Kepala">Lektor Kepala</option>
                                <option value="Guru Besar">Guru Besar</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <label for="gol_pangkat">Pangkat Golongan</label>
                            <select name="gol_pangkat" id="gol_pangkat"
                                class="block border border-primary rounded-md w-full">
                                <option value="III/a">III/a</option>
                                <option value="III/b">III/b</option>
                                <option value="III/c">III/c</option>
                                <option value="III/d">III/d</option>
                                <option value="IV/a">IV/a</option>
                                <option value="IV/b">IV/b</option>
                                <option value="IV/c">IV/c</option>
                                <option value="IV/d">IV/d</option>
                                <option value="IV/e">IV/e</option>
                            </select>
                        </div>
                        <div class="text-left mb-4">
                            <p>Role</p>
                            <input type="checkbox" id="ketua_komite" name="role[]" value="7" onchange="checkKomite()">
                            <label for="ketua_komite">Ketua Komite</label><br>
                            <input type="checkbox" id="komite" name="role[]" value="2">
                            <label for="komite">Komite</label><br>
                            <input type="checkbox" id="ketua_penguji" name="role[]" value="3"
                                onchange="checkDosenPenguji()">
                            <label for="ketua_penguji">Ketua Penguji</label><br>
                            <input type="checkbox" id="dosen_penguji" name="role[]" value="4">
                            <label for="dosen_penguji">Dosen Penguji</label><br>
                            <input type="checkbox" id="dosen_pembimbing" name="role[]" value="5">
                            <label for="dosen_pembimbing">Dosen Pembimbing</label><br>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <a href="/admin/dosen"
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

            if (ketuaPengujiCheckbox.checked) {
                dosenPengujiCheckbox.checked = true;
                dosenPengujiCheckbox.disabled = true;
            } else {
                dosenPengujiCheckbox.disabled = false;
            }
        }
    </script>

    <script>
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
    </script>
@endsection
