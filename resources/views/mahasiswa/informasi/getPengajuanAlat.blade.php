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
            <p class="font-semibold text-lg">{{ $pengajuanAlat->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanAlat->user->email }}</P><br>
            <P>NIM: {{ $pengajuanAlat->user->mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $pengajuanAlat->user->mahasiswa->kelas->nama }}</P><br>
            <P>Prodi: {{ $pengajuanAlat->user->mahasiswa->prodi->nama }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanAlat->user->mahasiswa->tahun->nama }}</P><br>
            <P>Status: {{ $pengajuanAlat->user->mahasiswa->status }}</P><br>
            <P>No. Kontak Mahasiswa: {{ $pengajuanAlat->user->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $pengajuanAlat->user->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $pengajuanAlat->user->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P>Nama Anggota Tim (Jika ada):
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P>Judul Skripsi: {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada):
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p>Abstrak/Ringkasan Skripsi:
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}</p>
            <br>
            <p>Dosen Pembimbing 1:
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p>Dosen Pembimbing 2:
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p><br>
            <p>Link form F12:
                <a class="text-blue-500" href="{{ $pengajuanAlat->f12 }}">{{ $pengajuanAlat->f12 }}</a>
            </p><br>
            <p>Link form F13:
                <a class="text-blue-500" href="{{ $pengajuanAlat->f12 }}">{{ $pengajuanAlat->f13 }}</a>
            </p><br>
            <p>Link form F14:
                <a class="text-blue-500" href="{{ $pengajuanAlat->f12 }}">{{ $pengajuanAlat->f14 }}</a>
            </p><br>
            <p>Status: {{ $pengajuanAlat->status }}</p><br>
            <p>Keterangan:</p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanAlat->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
