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
            <P><span class="font-bold">Email: </span>{{ $pengajuanAlat->user->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $pengajuanAlat->user->mahasiswa->nim }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $pengajuanAlat->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $pengajuanAlat->user->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanAlat->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanAlat->user->mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa: </span>{{ $pengajuanAlat->user->mahasiswa->no_kontak }}</P><br>
            <P><span class="font-bold">Nama Orang Tua/Wali: </span>{{ $pengajuanAlat->user->mahasiswa->nama_ortu }}</P><br>
            <P><span class="font-bold">No. Kontak Orang Tua/Wali:
                </span>{{ $pengajuanAlat->user->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>:
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>
                {{ $pengajuanAlat->user->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1: </span>:
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p><br>
            <p><span class="font-bold">Link form F12: </span>
                <a class="text-blue-500" href="{{ $pengajuanAlat->f12 }}">{{ $pengajuanAlat->f12 }}</a>
            </p><br>
            <p><span class="font-bold">Link form F13: </span>
                <a class="text-blue-500" href="{{ $pengajuanAlat->f13 }}">{{ $pengajuanAlat->f13 }}</a>
            </p><br>
            <p><span class="font-bold">Link form F14: </span>
                <a class="text-blue-500" href="{{ $pengajuanAlat->f14 }}">{{ $pengajuanAlat->f14 }}</a>
            </p><br>
            <p><span class="font-bold">Link sertifikat kompetensi Bahasa Inggris TOEIC yang masih berlaku: </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanAlat->sertifikat_toeic }}">{{ $pengajuanAlat->sertifikat_toeic }}</a>
            </p><br>
            <p><span class="font-bold">Link sertifikat Aktivitas Prestasi dan Penghargaan: </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanAlat->sertifikat_prestasi }}">{{ $pengajuanAlat->sertifikat_prestasi }}</a>
            </p><br>
            <p><span class="font-bold">Link sertifikat Pendidikan Karakter (ESQ,PKKP,DLL): </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanAlat->sertifikat_pkkp }}">{{ $pengajuanAlat->sertifikat_pkkp }}</a>
            </p><br>
            <p><span class="font-bold">Link Pengalaman Berorganisasi (Jika ada): </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanAlat->sertifikat_organisasi }}">{{ $pengajuanAlat->sertifikat_organisasi }}</a>
            </p><br>
            <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanAlat->status }}</p><br>
            <p><span class="font-bold">Keterangan: </span></p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanAlat->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
