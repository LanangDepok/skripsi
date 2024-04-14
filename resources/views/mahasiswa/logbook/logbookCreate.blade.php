@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Logbook</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <form method="POST" action="/mahasiswa/logbook">
                    @csrf
                    <div class="text-left mb-4">
                        <p>
                            Pastikan skripsi anda sudah benar <a href="/mahasiswa/skripsi"
                                class="underline text-blue-500 font-semibold">di
                                sini</a>
                        </p>
                    </div>
                    <div class="text-left mb-4">
                        <label for="tanggal">Tanggal bimbingan<span class="text-red-700">*</span></label>
                        <input id="tanggal" name="tanggal" type="date"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    @error('tanggal')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="tempat">Tempat</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="tempat" id="tempat">
                    </div>
                    @error('tempat')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="uraian">Uraian<span class="text-red-700">*</span></label>
                        <textarea id="uraian" name="uraian" rows="5"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('uraian')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="rencana_pencapaian">Rencana Pencapaian<span class="text-red-700">*</span></label>
                        <textarea id="rencana_pencapaian" name="rencana_pencapaian" rows="5"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('rencana_pencapaian')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    {{-- <div class="text-left mb-4">
                        <label for="jenis_bimbingan">Jenis Bimbingan</label>
                        <select name="jenis_bimbingan" id="jenis_bimbingan"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            <option value="Proposal">Proposal</option>
                            <option value="Skripsi">Skripsi</option>
                        </select>
                    </div>
                    @error('jenis_bimbingan')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror --}}
                    <div class="text-center mt-16">
                        <button type="submit"
                            class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
