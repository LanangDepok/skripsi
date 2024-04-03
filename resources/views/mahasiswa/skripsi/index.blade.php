@extends('mahasiswa.template')

@section('content')
    <div class="container text-center mx-auto">
        <a href="/mahasiswa/skripsi/edit"
            class="rounded-md border border-slate-300 shadow-md shadow-slate-400 bg-primary text-white w-56 p-3 hover:text-black hover:bg-red-300">Tambah
            atau Edit
            Skripsi</a>
    </div>
    @if (!isset(Auth::user()->skripsi->file_skripsi))
        <div class="mt-20">
            <p class="text-center font-bold text-2xl">Data Masih kosong, silahkan tambah terlebih dahulu</p>
        </div>
    @else
        <div class="container w-1/2 mx-auto mt-6">
            <p><span class="font-semibold">Judul : </span> {{ Auth::user()->skripsi->judul }}</p>
            <p class="mt-3"><span class="font-semibold">Sub Judul :
                </span>{{ isset(Auth::user()->skripsi->sub_judul) ? Auth::user()->skripsi->sub_judul : '-' }}</p>
            <p class="mt-3"><span class="font-semibold">Anggota :
                </span>{{ isset(Auth::user()->skripsi->anggota) ? Auth::user()->skripsi->anggota : '-' }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <iframe src="/storage/assets/Draf 4-Pro-Bagas Rizkiyanto.pdf" class="w-full h-[500px]" title="Skripsi"></iframe>
        </div>
    @endif
@endsection
