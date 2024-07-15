@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Bukti Penyerahan Alat dan Skripsi</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <form method="POST" action="{{ route('mhs.ajukanAlat', ['user' => Auth::user()->id]) }}">
                    @csrf
                    <div class="text-left mb-4">
                        <label for="f12">Berita Acara Serah Terima Sistem_Aplikasi_Video_Berkas Skripsi (F12), <a
                                href="/storage/assets/f12.pdf" target="_blank" class="text-blue-500">unduh sini</a></label>
                        <input type="text" id="f12" name="f12" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('f12')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="f13">Surat Penyerahan Hibah Alat (F13), <a href="/storage/assets/f13.pdf"
                                target="_blank" class="text-blue-500">unduh
                                sini</a></label>
                        <input type="text" id="f13" name="f13" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('f13')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="f14">Tanda Bukti Penyerahan Laporan Skripsi (F14), <a
                                href="/storage/assets/f14.pdf" target="_blank" class="text-blue-500">unduh sini</a></label>
                        <input type="text" id="f14" name="f14" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('f14')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="bebas_perpustakaan">Tanda Bukti Bebas Perpustakaan, <a
                                href="/storage/assets/bebas_perpustakaan.pdf" target="_blank" class="text-blue-500">unduh
                                sini</a></label>
                        <input type="text" id="bebas_perpustakaan" name="bebas_perpustakaan" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('bebas_perpustakaan')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sertifikat_toeic">Link sertifikat kompetensi Bahasa Inggris TOEIC yang masih berlaku:
                        </label>
                        <input type="text" id="sertifikat_toeic" name="sertifikat_toeic" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('sertifikat_toeic')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sertifikat_prestasi">Link sertifikat Aktivitas Prestasi dan Penghargaan:
                        </label>
                        <input type="text" id="sertifikat_prestasi" name="sertifikat_prestasi"
                            placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('sertifikat_prestasi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sertifikat_pkkp">Link sertifikat Pendidikan Karakter (ESQ,PKKP,DLL):
                        </label>
                        <input type="text" id="sertifikat_pkkp" name="sertifikat_pkkp" placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('sertifikat_pkkp')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sertifikat_organisasi">Link Pengalaman Berorganisasi (Jika ada):
                        </label>
                        <input type="text" id="sertifikat_organisasi" name="sertifikat_organisasi"
                            placeholder="Masukkan link"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('sertifikat_organisasi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-12">
                        <button type="submit" class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white"
                            onclick="return confirm('Ajukan penyerahan skripsi dan alat?')">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
