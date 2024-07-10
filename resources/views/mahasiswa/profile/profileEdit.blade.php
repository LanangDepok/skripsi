@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-1/4 border-2 p-8 border-primary rounded-xl shadow-lg shadow-slate-400 mt-8">
        <form method="POST" action="{{ route('mhs.updateProfile', ['user' => Auth::user()->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="text-xl font-semibold text-center underline">Edit Profil</h2>
            </div>
            <div class="mt-4">
                <label for="photo_profil">Foto Profil (PNG, JPG, JPEG)</label>
                <input type="file" id="photo_profil" name="photo_profil"
                    class="border-primary border block w-full rounded-md">
            </div>
            @error('photo_profil')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class="mt-4">
                <label for="tanda_tangan">Tanda Tangan (PNG, JPG, JPEG)</label>
                <input type="file" id="tanda_tangan" name="tanda_tangan"
                    class="border-primary border block w-full rounded-md">
            </div>
            @error('tanda_tangan')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class="mt-4">
                <label for="password">Password (Jika ingin mengganti password)</label>
                <input type="password" id="password" name="password" class="border-primary border block w-full rounded-md">
            </div>
            @error('password')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class="mt-4">
                <label for="no_kontak">No. Kontak</label>
                <input type="text" id="no_kontak" name="no_kontak" class="border-primary border block w-full rounded-md"
                    value="{{ Auth::user()->mahasiswa->no_kontak }}">
            </div>
            @error('no_kontak')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class=" mt-4">
                <label for="nama_ortu">Nama Orang Tua/Wali</label>
                <input type="text" id="nama_ortu" name="nama_ortu" class="border-primary border block w-full rounded-md"
                    value="{{ Auth::user()->mahasiswa->nama_ortu }}">
            </div>
            @error('nama_ortu')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class=" mt-4">
                <label for="no_kontak_ortu">No. Kontak Orang Tua/Wali</label>
                <input type="text" id="no_kontak_ortu" name="no_kontak_ortu"
                    class="border-primary border block w-full rounded-md"
                    value="{{ Auth::user()->mahasiswa->no_kontak_ortu }}">
            </div>
            @error('no_kontak_ortu')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
            <div class="mt-8 flex justify-around">
                <a href="{{ route('mhs.getProfile') }}"
                    class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black text-center">Kembali</a></button>
                @method('PUT')
                <button type="submit"
                    class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black">Simpan</button>
            </div>
        </form>
    </div>
@endsection
