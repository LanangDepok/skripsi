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
            <P><span class="font-bold">Email: </span>{{ $bimbingan->bimbinganMahasiswa->email }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->prodi->nama }}
            </P><br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P><span class="font-bold">Status: </span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak</span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->no_kontak }}</P><br>
            <P><span class="font-bold">Nama Orang Tua/Wali</span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->nama_ortu }}
            </P><br>
            <P><span class="font-bold">No. Kontak Orang
                    Tua/Wali</span>{{ $bimbingan->bimbinganMahasiswa->mahasiswa->no_kontak_ortu }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $bimbingan->bimbinganMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi: </span>{{ $bimbingan->bimbinganMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $bimbingan->bimbinganMahasiswa->skripsi->sub_judul }}</P><br>
            <p><span class="font-bold">Dosen Pembimbing</span>{{ $bimbingan->bimbinganDosen->nama }}</p>
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
