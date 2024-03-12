@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Isi Biodata Dosen</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <div class="text-left mb-4">
                        <label for="email">Email<span class="text-red-700">*</span></label>
                        <input type="email"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="email" id="email">
                    </div>
                    <div class="text-left mb-4">
                        <label for="name">Nama<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="name" id="name">
                    </div>
                    <div class="text-left mb-4">
                        <label for="nip">NIP<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="nip" id="nip">
                    </div>
                    <div class="text-left mb-4">
                        <label for="jabatan">Jabatan<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="jabatan" id="jabatan">
                    </div>
                    <div class="text-left mb-4">
                        <label for="fungsional">Fungsional<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="fungsional" id="fungsional">
                    </div>
                    <div class="text-left mb-4">
                        <label for="gol_pangkat">Gol & Pangkat<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="gol_pangkat" id="gol_pangkat">
                    </div>
                    <div class="text-left mb-4">
                        <p>Role</p>
                        <input type="checkbox" id="dosen_pembimbing" name="dosen_pembimbing" value="Dosen Pembimbing">
                        <label for="dosen_pembimbing">Dosen Pembimbing</label><br>
                        <input type="checkbox" id="dosen_penguji" name="dosen_penguji" value="Dosen Penguji">
                        <label for="dosen_penguji">Dosen Penguji</label><br>
                        <input type="checkbox" id="ketua_penguji" name="ketua_penguji" value="Ketua Penguji">
                        <label for="ketua_penguji">Ketua Penguji</label><br>
                        <input type="checkbox" id="komite" name="komite" value="Komite">
                        <label for="komite">Komite</label><br>
                    </div>
                    <div class="flex justify-evenly">
                        <div class="text-center mt-12">
                            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white"><a
                                    href="/admin/dosen">Back</a></button>
                        </div>
                        <div class="text-center mt-12">
                            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
