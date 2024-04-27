@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Bukti Penyerahan Alat dan Skripsi</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <div class="text-left mb-4">
                    <label for="form_f12">Berita Acara Serah Terima Sistem_Aplikasi_Video_Berkas Skripsi (F12), <a
                            href="/storage/assets/f12.pdf" target="_blank" class="text-blue-500">unduh sini</a></label>
                    <input type="text" id="form_f12" name="form_f12" placeholder="Masukkan link"
                        class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="text-left mb-4">
                    <label for="form_f13">Surat Penyerahan Hibah Alat (F13), <a href="/storage/assets/f13.pdf"
                            target="_blank" class="text-blue-500">unduh
                            sini</a></label>
                    <input type="text" id="form_f13" name="form_f13" placeholder="Masukkan link"
                        class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="text-left mb-4">
                    <label for="form_f14">Tanda Bukti Penyerahan Laporan Skripsi (F14), <a href="/storage/assets/f14.pdf"
                            target="_blank" class="text-blue-500">unduh sini</a></label>
                    <input type="text" id="form_f14" name="form_f14" placeholder="Masukkan link"
                        class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="text-center mt-12">
                    <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
