@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('adm.getAllKompetensi') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $pengajuanKompetensi->user->mahasiswa->photo_profil ? $pengajuanKompetensi->user->mahasiswa->photo_profil : 'icons/user.png') }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanKompetensi->user->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanKompetensi->user->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanKompetensi->user->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanKompetensi->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanKompetensi->user->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanKompetensi->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanKompetensi->user->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanKompetensi->user->skripsi->sub_judul }}</P><br>
            <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanKompetensi->status }}</p><br>
            <p><span class="font-bold">kompetensi: </span></p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->kompetensi }}</textarea><br>
            <p><span class="font-bold">Bukti Kompetensi: </span>{{ $pengajuanKompetensi->bukti_kompetensi }}</p><br>
            <p><span class="font-bold">Keterangan: </span></p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
