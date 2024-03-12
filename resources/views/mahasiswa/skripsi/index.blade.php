@extends('mahasiswa.template')

@section('content')
    <div class="container text-center mx-auto">
        <a href="/mahasiswa/skripsi/1/edit"
            class="rounded-md border border-slate-300 shadow-md shadow-slate-400 bg-primary text-white w-56 p-3 hover:text-black hover:bg-red-300">Tambah
            atau Edit
            Skripsi</a>
    </div>
    <div class="container w-1/2 mx-auto mt-6">
        <p><span class="font-semibold">Judul : </span> Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Saepe
            commodi omnis quam assumenda,
            doloribus aut accusantium amet ratione ab repellat pariatur perferendis, esse a rem quae voluptates,
            deserunt unde cumque molestias iure! Consequatur ipsam, ab illum iure, harum sequi ut suscipit corrupti
            provident ea sit numquam placeat explicabo possimus! Deserunt?</p>
        <p class="mt-3"><span class="font-semibold">Sub Judul : </span>Lorem ipsum dolor sit amet consectetur
            adipisicing elit.
            Cumque error mollitia eos voluptatem doloribus voluptatum minima vitae cupiditate. Ea in repudiandae
            accusamus. Nam provident illo minus! Aliquam quod veniam numquam?</p>
        <p class="mt-3"><span class="font-semibold">Anggota : </span>bagas rizkiyanto, nida dhiya ulhak, fillea
            rethia yuma</p>
    </div>
    <div class="container w-1/2 mx-auto mt-6">
        <iframe src="/storage/assets/Draf 4-Pro-Bagas Rizkiyanto.pdf" class="w-full h-[500px]" title="Skripsi"></iframe>
    </div>
@endsection
