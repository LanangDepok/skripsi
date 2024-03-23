@extends('mahasiswa.template')

@section('content')
    <div class="w-1/2 mx-auto">
        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">
            <a href="/mahasiswa/informasi">Back</a>
        </button>
    </div>
    <div class="container w-1/2 mx-auto">
        <div class="border-4 border-black w-10 ml-auto">
            <p class="text-2xl font-semibold text-center">F3</p>
        </div>
    </div>
    <div class="container w-1/3 mx-auto">
        <p class="text-center font-bold underline text-2xl">Berita Acara Proposal Skripsi</p>
    </div>
    <div class="container w-1/2 mx-auto mt-10">
        <p>Pada 20 Maret 2024, telah diakan penilaian proposal skripsi untuk saudara:</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama : </span>Bagas Rizkiyanto</p>
            <p><span class="font-semibold">NIM : </span>2007412006</p>
            <p><span class="font-semibold">Program Studi : </span>Teknik Informatika</p>
            <p><span class="font-semibold">Judul Skripsi : </span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Possimus veniam qui dolore dolores
                repellendus, temporibus facere earum soluta animi odio fugiat iste ab libero? Quia labore cumque error
                tenetur minima!</p>
        </div>
        <div class="mt-3">
            <p>Bertindak sebagai pelaksana :</p>
        </div>
        <div class="mt-3">
            <div class="container flex flex-row justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">1. Ketua Sidang : </span>Ketua sidang proposal, S.Pd, M.Pd</p>
                </div>
                <div class="basis-1/3">
                    <img src="/storage/assets/signature.png">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">2. Penguji 2 : </span>Penguji sidang proposal, S.Pd, M.Pd</p>
                </div>
                <div class="basis-1/3">
                    <img src="/storage/assets/signature.png">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">3. Penguji 3 : </span>Penguji sidang proposal, S.Pd, M.Pd</p>
                </div>
                <div class="basis-1/3">
                    <img src="/storage/assets/signature.png">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">4. Pembimbing : </span>Pembimbing sidang proposal, S.Pd, M.Pd</p>
                </div>
                <div class="basis-1/3">
                    <img src="/storage/assets/signature.png">
                </div>
            </div>
        </div>
        <div class="container mt-10 mb-20">
            <p class="text-center">Depok, 20 Maret 2024</p>
            <p class="text-center">Mahasiswa Ybs,</p>
            <img src="/storage/assets/signature.png" class="max-w-60 mx-auto">
            <p class="text-center underline">Bagas Rizkiyanto</p>
            <p class="text-center">NIM.2007412006</p>
        </div>
    </div>
@endsection
