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
            <P>Email: {{ $mahasiswa->user->email }}</P><br>
            <P>NIM: {{ $mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: Seminar Proposal</P><br>
            <P>No. Kontak Mahasiswa: {{ $mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $mahasiswa->no_kontak_ortu }}</P><br>
            <P>Nama Anggota Tim (Jika ada):
                {{ isset($mahasiswa->user->skripsi->anggota) ? $mahasiswa->user->skripsi->anggota : '' }}</P>
            <br>
            <P>Judul Skripsi:
                {{ isset($mahasiswa->user->skripsi->judul) ? $mahasiswa->user->skripsi->judul : '' }}</P><br>
            <P>Sub Judul Skripsi (Jika ada):
                {{ isset($mahasiswa->user->skripsi->sub_judul) ? $mahasiswa->user->skripsi->sub_judul : '' }}
            </P><br>
            <p>Abstrak/Ringkasan Skripsi:
                {{ $mahasiswa->user->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}
            </p>
            <br>
            <p>Dosen Pembimbing:
                {{ $mahasiswa->user->pengajuanJudul->sortByDesc('created_at')->first()->dosen_terpilih }}
            </p>
            <br>
            <p>Dosen Pembimbing 2:
                {{ $mahasiswa->user->pengajuanJudul->sortByDesc('created_at')->first()->dosen_terpilih2 }}
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
