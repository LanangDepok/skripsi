@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('mhs.getInformations') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center py-[1px]">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanKompetensi->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanKompetensi->user->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $pengajuanKompetensi->user->mahasiswa->nim }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $pengajuanKompetensi->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $pengajuanKompetensi->user->mahasiswa->prodi->nama }}</P>
            <br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanKompetensi->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanKompetensi->user->mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa: </span>{{ $pengajuanKompetensi->user->mahasiswa->no_kontak }}
            </P><br>
            <P><span class="font-bold">Nama Orang Tua/Wali: </span>{{ $pengajuanKompetensi->user->mahasiswa->nama_ortu }}
            </P><br>
            <P><span class="font-bold">No. Kontak Orang Tua/Wali:
                </span>{{ $pengajuanKompetensi->user->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>:
                {{ $pengajuanKompetensi->user->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanKompetensi->user->pengajuanJudul->sortByDesc('created_at')->first()->judul }}</P><br>
            <P><span class="font-bold">Judul Skripsi (inggris):
                </span>{{ $pengajuanKompetensi->judul_skripsi_inggris }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>
                {{ $pengajuanKompetensi->user->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>
                {{ $pengajuanKompetensi->user->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1: </span>:
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p><br>
            <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanKompetensi->status }}</p><br>
            <p><span class="font-bold">kompetensi: </span></p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->kompetensi }}</textarea><br>
            <p><span class="font-bold">Bukti Kompetensi: </span>{{ $pengajuanKompetensi->bukti_kompetensi }}</p><br>
            <p><span class="font-bold">Keterangan: </span></p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
