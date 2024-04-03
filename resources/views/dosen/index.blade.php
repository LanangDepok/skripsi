@extends('dosen.template')

@section('content')
    <div class="container text-center mx-auto w-3/4">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Timeline Skripsi</h2>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/{{ $konten[0]->gambar }}" class="w-full">
    </div>
    <div class="container text-center mx-auto w-3/4 mt-24">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Alur Skripsi</h2>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/{{ $konten[1]->gambar }}" class="w-full">
    </div>
@endsection
