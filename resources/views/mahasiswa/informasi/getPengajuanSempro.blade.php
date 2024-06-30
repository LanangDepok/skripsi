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
            <P<span class="font-bold">Email: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P><br>
                <P><span class="font-bold">NIM: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}
                </P><br>
                <P><span class="font-bold">Kelas:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas->nama }}</P><br>
                <P><span class="font-bold">Program Studi:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</P><br>
                <P><span class="font-bold">Tahun Ajaran:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun->nama }}</P><br>
                <P><span class="font-bold">Status:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->status }}</P><br>
                <P><span class="font-bold">No. Kontak Mahasiswa:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->no_kontak }}</P><br>
                <P><span class="font-bold">Nama Orang Tua/Wali:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nama_ortu }}</P><br>
                <P><span class="font-bold">No. Kontak Orang Tua/Wali:
                    </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->no_kontak_ortu }}
                </P>
                <br>
                <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>
                    {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
                </P><br>
                <P><span class="font-bold">Judul Skripsi: </span>
                    {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->judul }}
                </P><br>
                <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>:
                    {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
                </P>
                <br>
                <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>
                    {{ $pengajuanSempro->pengajuanSemproMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}
                </p><br>
                <p><span class="font-bold">Dosen Pembimbing: </span>
                    {{ $bimbingan->bimbinganDosen->nama }}
                </p><br>
                <p><span class="font-bold">Dosen Penguji: </span></p>
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
                <p><span class="font-bold">Metode: </span>{{ $pengajuanSempro->metode }}</p><br>
                <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanSempro->status }}</p><br>
                <p><span class="font-bold">Nilai: </span>{{ $pengajuanSempro->nilai }}</p><br>
                <p><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSempro->tanggal }}</p><br>
                <p><span class="font-bold">Keterangan: </span></p>
                <textarea class="w-full" rows="5" readonly>{{ $pengajuanSempro->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
