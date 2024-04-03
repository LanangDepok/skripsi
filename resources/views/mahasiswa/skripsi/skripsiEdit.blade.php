@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-1/4 border-2 p-8 border-primary rounded-xl shadow-lg shadow-slate-400 mt-8">
        <form method="POST" action="/mahasiswa/skripsi/{{ Auth::user()->id }}" enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="text-xl font-semibold text-center underline">Edit Skripsi</h2>
            </div>
            <div class="mt-4">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="{{ isset(Auth::user()->skripsi->judul) ? Auth::user()->skripsi->judul : '' }}">
            </div>
            @error('judul')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class=" mt-4">
                <label for="sub_judul">Sub Judul</label>
                <input type="text" id="sub_judul" name="sub_judul"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="{{ isset(Auth::user()->skripsi->sub_judul) ? Auth::user()->skripsi->sub_judul : '' }}">
            </div>
            @error('sub_judul')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class=" mt-4">
                <label for="anggota">Anggota Tim (pisah menggunakan tanda koma, ex: ilham, dani, budi)</label>
                <input type="text" id="anggota" name="anggota"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="{{ isset(Auth::user()->skripsi->anggota) ? Auth::user()->skripsi->anggota : '' }}">
            </div>
            @error('anggota')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class=" mt-4">
                <label for="file_skripsi">File Skripsi (format: pdf)</label>
                <input type="file" id="file_skripsi" name="file_skripsi"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
            </div>
            @error('file_skripsi')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class="mt-8 flex justify-around">
                <button type="button"
                    class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black"><a
                        href="/mahasiswa/skripsi">Kembali</a></button>
                @method('PUT')
                <button type="submit"
                    class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black">Simpan</button>
            </div>
        </form>
    </div>
@endsection
