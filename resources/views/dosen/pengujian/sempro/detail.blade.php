@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/pengujian/sempro"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil ? $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P><br>
            <P>Kelas: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun_ajaran }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Dosen Pembimbing: {{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p><br>
            <p>Penguji:
                <br>1. {{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}
                <br>2. {{ $pengajuanSempro->pengajuanSemproPenguji2->nama }}
                <br>3. {{ $pengajuanSempro->pengajuanSemproPenguji3->nama }}
            </p><br>
            <P>Tanggal sidang: {{ $pengajuanSempro->tanggal }}</P><br>
            <P>Status: {{ $pengajuanSempro->status }}</P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($pengajuanSempro->pengajuanSemproMahasiswa->skripsi->file_skripsi)
                <iframe src="/storage/{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
            @endif
        </div>
    </div>
@endsection
