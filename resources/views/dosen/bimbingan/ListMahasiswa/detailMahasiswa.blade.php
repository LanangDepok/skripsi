@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/bimbingan/listMahasiswa"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center p-[1px]">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/assets/4x6.jpg" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $bimbingan->mahasiswa->user->nama }}</p>
            <p class="font-semibold text-lg">{{ $bimbingan->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $bimbingan->mahasiswa->user->email }}</P><br>
            <P>Kelas: {{ $bimbingan->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $bimbingan->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $bimbingan->mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: {{ $bimbingan->mahasiswa->status }}</P><br>
            <P>No. Kontak Mahasiswa: {{ $bimbingan->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $bimbingan->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $bimbingan->mahasiswa->no_kontak_ortu }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $bimbingan->mahasiswa->user->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $bimbingan->mahasiswa->user->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $bimbingan->mahasiswa->sub_judul }}</P><br>
            <p>Dosen Pembimbing: {{ $bimbingan->dosen->user->nama }}</p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($bimbingan->mahasiswa->user->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $bimbingan->mahasiswa->user->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum upload file skripsi</p>
            @endif
        </div>
    </div>
@endsection
