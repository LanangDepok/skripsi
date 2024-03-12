@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Seminar Proposal</h2>
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
                    <label for="abstrak">Abstrak<span class="text-red-700">*</span></label>
                    <textarea id="abstrak" name="abstrak"
                        placeholder="ringkasan yang akan dikerjakan (latar belakang, batasan, metode/model/algoritma/teknologi)"
                        rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                </div>
                <div class="text-left mb-4">
                    <label for="metode">Metode Penyelesaian Masalah<span class="text-red-700">*</span></label>
                    <textarea id="metode" name="metode" placeholder="Tahap 1, Tahap 2, Tahap3, dst" rows="5"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                </div>
                <div class="text-left mb-4">
                    <label for="tim">Nama Anggota Tim (Jika ada, contoh penulisan: ilham, budi, dst.)</label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="tim" id="tim" placeholder="Ilham, Kurniawan, Kurniadi">
                </div>
                <div class="text-left mb-4">
                    <label for="bukti_bayar">Bukti Registrasi</label>
                    <input type="file" id="bukti_bayar" name="bukti_bayar">
                </div>
                <div class="text-center mt-12">
                    <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
