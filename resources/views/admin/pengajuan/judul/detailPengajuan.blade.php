@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <button class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 h-8 rounded-xl"><a
                    href="/admin/pengajuan/judul">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/assets/4x6.jpg" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">Bagas Rizkiyanto</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: Bagas Rizkiyanto</P><br>
            <P>NIM: 2007412006</P><br>
            <P>Kelas: TI-CCIT8</P><br>
            <P>Prodi: Teknik Informatika</P><br>
            <P>Tahun Ajaran: 2023-2024</P><br>
            <P>Status: Seminar Proposal</P><br>
            <P>No. Kontak Mahasiswa:</P><br>
            <P>Nama Orang Tua/Wali:</P><br>
            <P>No. Kontak Orang Tua/Wali:</P><br>
            <P>Nama Anggota Tim (Jika ada): Kurniawan, Kurniadi</P><br>
            <P>Judul Skripsi: Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae nihil cupiditate error vel
                eius impedit rerum. Quasi, harum. Nemo repellat nam omnis at ipsum reprehenderit voluptate maiores eum cum
                est, consectetur tenetur corrupti, minus eos sint vero officia natus quibusdam modi porro doloribus! Error
                ipsum dolor explicabo voluptates mollitia labore.</P><br>
            <P>Sub Judul Skripsi (Jika ada):</P><br>
            <p>Abstrak/Ringkasan Skripsi:</p><br>
            <p>Dosen Pembimbing:</p>
        </div>
    </div>
@endsection
