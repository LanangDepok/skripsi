@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('mhs.getInformations') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center py-[1px]">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanJudul->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanJudul->user->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $pengajuanJudul->user->mahasiswa->nim }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $pengajuanJudul->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $pengajuanJudul->user->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanJudul->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanJudul->user->mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa: </span>{{ $pengajuanJudul->user->mahasiswa->no_kontak }}</P>
            <br>
            <P><span class="font-bold">Nama Orang Tua/Wali: </span>{{ $pengajuanJudul->user->mahasiswa->nama_ortu }}</P>
            <br>
            <P><span class="font-bold">No. Kontak Orang Tua/Wali:
                </span>{{ $pengajuanJudul->user->mahasiswa->no_kontak_ortu }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ isset($pengajuanJudul->anggota) ? $pengajuanJudul->anggota : '' }}</P><br>
            <P><span class="font-bold">Judul Skripsi: </span>{{ $pengajuanJudul->judul }}</P><br>
            <p><span class="font-bold">Apakah judul dari dosen? </span>{{ $pengajuanJudul->judul_dosen }}</p><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ isset($pengajuanJudul->sub_judul) ? $pengajuanJudul->sub_judul : '' }}</P>
            <br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>{{ $pengajuanJudul->abstrak }}</p><br>
            <p><span class="font-bold">Studi Kasus: </span>{{ $pengajuanJudul->studi_kasus }}</p><br>
            <p><span class="font-bold">Sumber Referensi: </span>{{ $pengajuanJudul->sumber_referensi }}</p><br>
            <p><span class="font-bold">Dosen Pembimbing: </span>
                {{ isset($bimbingan->dosen_id) ? $bimbingan->bimbinganDosen->nama : 'menunggu' }}</p><br>
            <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanJudul->status }}</p>
        </div>
    </div>
@endsection
