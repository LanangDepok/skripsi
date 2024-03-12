@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <p class="text-xl font-semibold">Masukkan Excel</p>
        </div>
        <div class="flex justify-center mt-3">
            <input type="file" name="excel">
        </div>
        <div class="flex justify-center mt-3">
            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Simpan</button>
        </div>
        <div class="flex justify-center mt-6">
            <p class="text-xl font-semibold">Atau</p>
        </div>
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Isi Biodata Mahasiswa</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">

                    <div class="text-left mb-4">
                        <label for="email">Email<span class="text-red-700">*</span></label>
                        <input type="text"
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
                        <label for="nim">NIM<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="nim" id="nim">
                    </div>
                    <div class="text-left mb-4">
                        <label for="kelas">Kelas:</label>
                        <select name="kelas" id="kelas" class="block border border-primary rounded-md">
                            <option value="volvo">TI-CCIT</option>
                            <option value="saab">TMJ 8</option>
                            <option value="mercedes">TMD 8</option>
                            <option value="audi">TI 8</option>
                        </select>
                    </div>
                    <div class="text-left mb-4">
                        <label for="prodi">Prodi:</label>
                        <select name="prodi" id="prodi" class="block border border-primary rounded-md">
                            <option value="volvo">Teknik Informatika</option>
                            <option value="saab">Teknik Multimedia Digital</option>
                            <option value="mercedes">Teknik Multimedia dan Jaringan</option>
                        </select>
                    </div>
                    <div class="text-left mb-4">
                        <label for="tahun_ajaran">Tahun Ajaran<span class="text-red-700">*</span></label>
                        <p>Contoh penulisan: 2023-2024</p>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="tahun_ajaran" id="tahun_ajaran">
                    </div>
                    <div class="flex justify-evenly">
                        <div class="text-center mt-12">
                            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white"><a
                                    href="/admin/mahasiswa">Back</a></button>
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
