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
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P>NIM: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</P><br>
            <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun_ajaran }}</P><br>
            <P>Status: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->status }}</P><br>
            <P>No. Kontak Mahasiswa: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->no_kontak }}</P><br>
            <P>Nama Orang Tua/Wali: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nama_ortu }}</P><br>
            <P>No. Kontak Orang Tua/Wali: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P>Nama Anggota Tim (Jika ada):
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P>Judul Skripsi:
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->judul }}
            </P><br>
            <P>Sub Judul Skripsi (Jika ada):
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p>Abstrak/Ringkasan Skripsi:
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}
            </p>
            <br>
            <p>Dosen Pembimbing 1:
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p>Dosen Pembimbing 2:
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p><br>
            <p>Dosen Penguji: </p>
            <p>
                1.
                {{ isset($pengajuanSkripsi->pengajuanSkripsiPenguji1->nama) ? $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama : '-' }}
            </p>
            <p>
                2.
                {{ isset($pengajuanSkripsi->pengajuanSkripsiPenguji1->nama) ? $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama : '-' }}
            </p>
            <p>
                3.
                {{ isset($pengajuanSkripsi->pengajuanSkripsiPenguji1->nama) ? $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama : '-' }}
            </p>
            <br>
            <p>Link presentasi:
                <a class="text-blue-500"
                    href="{{ $pengajuanSkripsi->link_presentasi }}">{{ $pengajuanSkripsi->link_presentasi }}</a>
            </p><br>
            <p>Sertifikat lomba:
                <a class="text-blue-500"
                    href="{{ $pengajuanSkripsi->sertifikat_lomba }}">{{ $pengajuanSkripsi->sertifikat_lomba }}</a>
            </p><br>
            {{-- <p>Apakah skripsi membuat alat? {{ $pengajuanSkripsi->membuat_alat }}</p><br> --}}
            <p>Status: {{ $pengajuanSkripsi->status }}</p><br>
            <p>Nilai dosen pembimbing:
                @if ($pengajuanSkripsi->nilai_pembimbing2)
                    {{ ($pengajuanSkripsi->nilai_pembimbing + $pengajuanSkripsi->nilai_pembimbing2) / 2 }}
                @else
                    {{ $pengajuanSkripsi->nilai_pembimbing }}
                @endif
            </p><br>
            <p>Nilai dosen penguji:
                {{ ($pengajuanSkripsi->nilai1 + $pengajuanSkripsi->nilai2 + $pengajuanSkripsi->nilai3) / 3 }}
            </p><br>
            <p>Nilai total: {{ $pengajuanSkripsi->nilai }}</p><br>
            <p>Tanggal sidang: {{ $pengajuanSkripsi->tanggal }}</p><br>
            <P>Keterangan:</P>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanSkripsi->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
