@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/admin/mahasiswa"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 p-[1px] rounded-xl block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($mahasiswa->photo_profil) ? $mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $mahasiswa->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $mahasiswa->user->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $mahasiswa->nim }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa: </span>{{ $mahasiswa->no_kontak }}</P><br>
            <P><span class="font-bold">Nama Orang Tua/Wali: </span>{{ $mahasiswa->nama_ortu }}</P><br>
            <P><span class="font-bold">No. Kontak Orang Tua/Wali: </span>{{ $mahasiswa->no_kontak_ortu }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>
                {{ isset($mahasiswa->user->skripsi->anggota) ? $mahasiswa->user->skripsi->anggota : '' }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi: </span>
                {{ isset($mahasiswa->user->skripsi->judul) ? $mahasiswa->user->skripsi->judul : '' }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>
                {{ isset($mahasiswa->user->skripsi->sub_judul) ? $mahasiswa->user->skripsi->sub_judul : '' }}
            </P><br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>
                {{ $mahasiswa->user->pengajuanJudul->isNotEmpty() ? $mahasiswa->user->pengajuanJudul->sortByDesc('created_at')->first()->abstrak : 'Belum ada' }}
            </p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>
                {{ $bimbingan ? $bimbingan->bimbinganDosen->nama : 'Belum ada' }}
            </p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($mahasiswa->user->skripsi != null && $mahasiswa->user->skripsi->file_skripsi != null)
                <iframe src="{{ asset('storage/' . $mahasiswa->user->skripsi->file_skripsi) }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum upload file skripsi</p>
            @endif
        </div>
    </div>
@endsection
