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
            <P>Email: {{ $mahasiswa->user->email }}</P><br>
            <P>NIM: {{ $mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: Seminar Proposal</P><br>
            <P>No. Kontak Mahasiswa:</P><br>
            <P>Nama Orang Tua/Wali:</P><br>
            <P>No. Kontak Orang Tua/Wali:</P><br>
            <P>Nama Anggota Tim (Jika ada): Kurniawan, Kurniadi</P><br>
            <P>Judul Skripsi</P><br>
            <P>Sub Judul Skripsi (Jika ada):</P><br>
            <p>Abstrak/Ringkasan Skripsi:</p><br>
            <p>Dosen Pembimbing:</p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <iframe src="/storage/assets/Draf 4-Pro-Bagas Rizkiyanto.pdf" class="w-full h-[600px]"></iframe>
        </div>
    </div>
@endsection
