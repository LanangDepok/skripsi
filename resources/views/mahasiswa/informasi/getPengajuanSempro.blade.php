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
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P><br>
            <P>NIM: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->status }}</P><br>
            <P>No. Kontak Mahasiswa: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P>Nama Anggota Tim (Jika ada):
                {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P>Judul Skripsi:
                {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->judul }}
            </P><br>
            <P>Sub Judul Skripsi (Jika ada):
                {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p>Abstrak/Ringkasan Skripsi:
                {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}
            </p><br>
            <p>Dosen Pembimbing:
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p>Dosen Penguji: </p>
            <p>
                1.
                {{ isset($pengajuanSempro->pengajuanSemproPenguji1->nama) ? $pengajuanSempro->pengajuanSemproPenguji1->nama : '-' }}
            </p>
            <p>
                2.
                {{ isset($pengajuanSempro->pengajuanSemproPenguji1->nama) ? $pengajuanSempro->pengajuanSemproPenguji2->nama : '-' }}
            </p>
            <p>
                3.
                {{ isset($pengajuanSempro->pengajuanSemproPenguji1->nama) ? $pengajuanSempro->pengajuanSemproPenguji3->nama : '-' }}
            </p>
            <br>
            <p>Metode: {{ $pengajuanSempro->metode }}</p><br>
            <p>Status: {{ $pengajuanSempro->status }}</p><br>
            <p>Nilai: {{ $pengajuanSempro->nilai }}</p><br>
            <p>Tanggal sidang: {{ $pengajuanSempro->tanggal }}</p><br>
            <p>Keterangan:</p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanSempro->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
