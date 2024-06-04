@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Sidang Skripsi</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <form method="POST" action="/mahasiswa/pengajuan/skripsi/{{ Auth::user()->id }}">
                    @csrf
                    <div class="text-left mb-4">
                        <p>
                            Pastikan skripsi anda sudah benar <a href="/mahasiswa/skripsi"
                                class="underline text-blue-500 font-semibold">di
                                sini</a>
                        </p>
                    </div>
                    <div class="text-left mb-4">
                        <label for="sertifikat_lomba">Link Sertifikat Lomba</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="sertifikat_lomba" id="sertifikat_lomba">
                    </div>
                    @error('sertifikat_lomba')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="link_presentasi">Link video Presentasi</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="link_presentasi" id="link_presentasi">
                    </div>
                    @error('video_presentasi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-12">
                        <button type="submit"
                            class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white"
                            onclick="return confirm('Ajukan pengajuan sidang skripsi?')">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
