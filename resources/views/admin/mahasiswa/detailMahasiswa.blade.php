@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <button class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 h-8 rounded-xl"><a
                    href="/admin/mahasiswa">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/assets/4x6.jpg" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">Bagas Rizkiyanto</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: Bagas Rizkiyanto</P>
            <P>NIM: 2007412006</P>
            <P>Kelas: TI-CCIT8</P>
            <P>Prodi: Teknik Informatika</P>
            <P>Tahun Ajaran: 2023-2024</P>
            <P>Status: Seminar Proposal</P>
            <P>No. Kontak Mahasiswa:</P>
            <P>Nama Orang Tua/Wali:</P>
            <P>No. Kontak Orang Tua/Wali:</P>
            <P>Nama Anggota Tim (Jika ada): Kurniawan, Kurniadi</P>
            <P>Judul Skripsi</P>
            <P>Sub Judul Skripsi (Jika ada):</P>
            <p>Abstrak/Ringkasan Skripsi:</p>
            <p>Dosen Pembimbing:</p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <iframe src="/storage/assets/Draf 4-Pro-Bagas Rizkiyanto.pdf" class="w-full h-[600px]"></iframe>
        </div>
    </div>
@endsection
