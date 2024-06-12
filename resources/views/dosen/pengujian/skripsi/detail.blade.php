@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/pengujian/skripsi"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil ? $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Dosen Pembimbing 1: {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p><br>
            <p>Dosen Pembimbing 2:
                {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}</p><br>
            {{-- <p>Apakah skripsi membuat alat? {{ $pengajuanSkripsi->membuat_alat }}</p><br> --}}
            <p>Penguji:
                <br>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P>Tanggal sidang: {{ $pengajuanSkripsi->tanggal }}</P><br>
            <P>Status: {{ $pengajuanSkripsi->status }}</P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi)
                <iframe src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
            @endif
        </div>
    </div>
@endsection
