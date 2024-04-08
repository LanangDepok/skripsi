@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/mahasiswa/informasi"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center py-[1px]">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">Bagas Rizkiyanto</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanJudul->user->email }}</P><br>
            <P>NIM: {{ $pengajuanJudul->user->mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $pengajuanJudul->user->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $pengajuanJudul->user->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanJudul->user->mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: {{ $pengajuanJudul->user->mahasiswa->status }}</P><br>
            <P>No. Kontak Mahasiswa: {{ $pengajuanJudul->user->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $pengajuanJudul->user->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $pengajuanJudul->user->mahasiswa->no_kontak_ortu }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ isset($pengajuanJudul->anggota) ? $pengajuanJudul->anggota : '' }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanJudul->judul }}</P><br>
            <p>Apakah judul dari dosen? {{ $pengajuanJudul->judul_dosen }}</p><br>
            <P>Sub Judul Skripsi (Jika ada): {{ isset($pengajuanJudul->sub_judul) ? $pengajuanJudul->sub_judul : '' }}</P>
            <br>
            <p>Abstrak/Ringkasan Skripsi: {{ $pengajuanJudul->abstrak }}</p><br>
            <p>Studi kasus: {{ $pengajuanJudul->studi_kasus }}</p><br>
            <p>Sumber referensi: {{ $pengajuanJudul->sumber_referensi }}</p><br>
            <p>Dosen Pembimbing:
                {{ isset($pengajuanJudul->dosen_terpilih) ? $pengajuanJudul->dosen_terpilih : 'menunggu' }}</p><br>
            <p>Status: {{ $pengajuanJudul->status }}</p>
        </div>
    </div>
@endsection
