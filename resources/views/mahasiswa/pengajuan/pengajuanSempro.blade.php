@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <form method="POST" action="{{ route('mhs.ajukanSempro', ['user' => Auth::user()->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Seminar Proposal</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <div class="text-left mb-4">
                        <p>
                            Pastikan skripsi anda sudah benar <a href="{{ route('mhs.getSkripsi') }}"
                                class="underline text-blue-500 font-semibold">di
                                sini</a>
                        </p>
                    </div>
                    <div class="text-left mb-4">
                        <label for="abstrak">Abstrak<span class="text-red-700">*</span></label>
                        <textarea id="abstrak" name="abstrak"
                            placeholder="ringkasan yang akan dikerjakan (latar belakang, batasan, metode/model/algoritma/teknologi)"
                            rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">{{ Auth::user()->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}</textarea>
                    </div>
                    @error('abstrak')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="metode">Metode Penyelesaian Masalah<span class="text-red-700">*</span></label>
                        <textarea id="metode" name="metode" placeholder="Tahap 1, Tahap 2, Tahap3, dst" rows="5"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('metode')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="anggota">Nama Anggota tim (Jika ada, contoh penulisan: ilham, budi, dst.)</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="anggota" id="anggota" value="{{ Auth::user()->skripsi->anggota }}">
                    </div>
                    <div class="text-left mb-4">
                        <label for="bukti_registrasi">Masukkan link bukti registrasi</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="bukti_registrasi" id="bukti_registrasi">
                    </div>
                    @error('bukti_registrasi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-12">
                        <button type="submit"
                            class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white"
                            onclick="return confirm('Ajukan pengajuan seminar proposal?')">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
