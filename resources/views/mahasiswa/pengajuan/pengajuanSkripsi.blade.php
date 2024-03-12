@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Sidang Skripsi</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <div class="text-left mb-4">
                    <p>
                        Pastikan skripsi anda sudah benar <a href="/mahasiswa/skripsi"
                            class="underline text-blue-500 font-semibold">di
                            sini</a>
                    </p>
                </div>
                <div class="text-left mb-4">
                    <label for="sertifikat_lomba">Sertifikat Lomba</label>
                    <input type="file" id="sertifikat_lomba" name="sertifikat_lomba"
                        class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="text-left mb-4">
                    <label for="video_presentasi">Link Video Presentasi</label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="video_presentasi" id="video_presentasi">
                </div>
                <div class="text-left mb-4">
                    <p>Apakah skripsinya membuat alat?<span class="text-red-700">*</span></p>
                    <label for="alat_skripsi">Ya</label>
                    <input type="radio" name="alat_skripsi" id="alat_skripsi">
                    <label for="alat_skripsi">Tidak</label>
                    <input type="radio" name="alat_skripsi" id="alat_skripsi">
                </div>
                <div class="text-center mt-12">
                    <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
