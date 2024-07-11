@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('adm.getAllAlat') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $pengajuanAlat->user->mahasiswa->photo_profil ? $pengajuanAlat->user->mahasiswa->photo_profil : 'icons/user.png') }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanAlat->user->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanAlat->user->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanAlat->user->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanAlat->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanAlat->user->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanAlat->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanAlat->user->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanAlat->user->skripsi->sub_judul }}</P><br>
            <P><span class="font-bold">Link Form F12:
                </span>{{ $pengajuanAlat->f12 }}</P><br>
            <P><span class="font-bold">Link Form F13:
                </span>{{ $pengajuanAlat->f13 }}</P><br>
            <P><span class="font-bold">Link Form F14:
                </span>{{ $pengajuanAlat->f14 }}</P><br>
            <P><span class="font-bold">Sertifikat TOEIC:
                </span>{{ $pengajuanAlat->sertifikat_toeic }}</P><br>
            <P><span class="font-bold">Sertifikat Prestasi:
                </span>{{ $pengajuanAlat->sertifikat_prestasi }}</P><br>
            <P><span class="font-bold">Sertifikat PKKP:
                </span>{{ $pengajuanAlat->sertifikat_pkkp }}</P><br>
            <P><span class="font-bold">Sertifikat Organisasi:
                </span>{{ $pengajuanAlat->sertifikat_organiasi }}</P><br>
            <P><span class="font-bold">Status:
                </span>{{ $pengajuanAlat->status }}</P><br>
            <P><span class="font-bold">Keterangan: </span></P><br>
            <textarea cols="50" rows="5" readonly>{{ $pengajuanAlat->keterangan }}</textarea>
        </div>
    </div>
@endsection
