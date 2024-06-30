@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/history/sempro"
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
            <P><span class="font-bold">Email: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p><br>
            <p><span class="font-bold">Penguji 1</span>
                <br>1. {{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}
                <br>2. {{ $pengajuanSempro->pengajuanSemproPenguji2->nama }}
                <br>3. {{ $pengajuanSempro->pengajuanSemproPenguji3->nama }}
            </p><br>
            <P><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSempro->tanggal }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSempro->status }}</P><br>
            <P><span class="font-bold">Nilai: </span>{{ $pengajuanSempro->nilai }}</P><br>
            <P><span class="font-bold">Keterangan: </span></P><br>
            <textarea cols="50" rows="5" readonly>{{ $pengajuanSempro->keterangan }}</textarea>
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
