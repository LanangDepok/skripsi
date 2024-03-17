@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <button class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 h-8 rounded-xl"><a
                    href="/dosen/bimbingan/logbook">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/assets/4x6.jpg" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">Bagas Rizkiyanto</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <p>Uraian Bimbingan: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem iusto tempora amet ducimus
                quisquam expedita facilis ab! Facere molestias beatae corrupti ullam quis dolores fuga fugit ab natus magni
                ratione cumque iste, voluptates omnis esse possimus molestiae excepturi in? Dolorem porro eos ducimus
                assumenda rerum illum corporis temporibus vitae numquam.</p>
            <br>
            <p>Rencana Pencapaian: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem iusto tempora amet
                ducimus
                quisquam expedita facilis ab! Facere molestias beatae corrupti ullam quis dolores fuga fugit ab natus magni
                ratione cumque iste, voluptates omnis esse possimus molestiae excepturi in? Dolorem porro eos ducimus
                assumenda rerum illum corporis temporibus vitae numquam.</p>
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: Bagas Rizkiyanto</P>
            <br>
            <P>NIM: 2007412006</P>
            <br>
            <P>Kelas: TI-CCIT8</P>
            <br>
            <P>Prodi: Teknik Informatika</P>
            <br>
            <P>Tahun Ajaran: 2023-2024</P>
            <br>
            <P>Status: Seminar Proposal</P>
            <br>
            <P>Nama Anggota Tim (Jika ada): Kurniawan, Kurniadi</P>
            <br>
            <P>Judul Skripsi</P>
            <br>
            <P>Sub Judul Skripsi (Jika ada):</P>
            <br>
            <p>Dosen Pembimbing:</p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <iframe src="/storage/assets/Draf 4-Pro-Bagas Rizkiyanto.pdf" class="w-full h-[600px]"></iframe>
        </div>
    </div>
@endsection
