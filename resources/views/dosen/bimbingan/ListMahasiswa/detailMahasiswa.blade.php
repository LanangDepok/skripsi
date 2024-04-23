@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/bimbingan/listMahasiswa"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center p-[1px]">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil) ? $bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $bimbingan->bimbinganMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $bimbingan->bimbinganMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $bimbingan->bimbinganMahasiswa->email }}</P><br>
            <P>Kelas: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->status }}</P><br>
            <P>No. Kontak: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $bimbingan->bimbinganMahasiswa->mahasiswa->no_kontak_ortu }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $bimbingan->bimbinganMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $bimbingan->bimbinganMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $bimbingan->bimbinganMahasiswa->skripsi->sub_judul }}</P><br>
            <p>Dosen Pembimbing: {{ $bimbingan->bimbinganDosen->nama }}</p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($bimbingan->bimbinganMahasiswa->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $bimbingan->bimbinganMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum upload file skripsi</p>
            @endif
        </div>
    </div>
@endsection
