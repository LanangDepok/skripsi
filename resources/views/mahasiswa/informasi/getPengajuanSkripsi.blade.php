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
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</P>
            <br>
            <P><span class="font-bold">kelas:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->status }}
            </P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->no_kontak }}</P><br>
            <P><span class="font-bold">Nama Orang Tua/Wali:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nama_ortu }}</P><br>
            <P><span class="font-bold">No. Kontak Orang Tua/Wali:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->no_kontak_ortu }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->anggota }}
            </P><br>
            <P><span class="font-bold">Judul Skripsi: </span>
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->judul }}
            </P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->sub_judul }}
            </P>
            <br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->pengajuanJudul->sortByDesc('created_at')->first()->abstrak }}
            </p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1: </span>
                {{ $bimbingan->bimbinganDosen->nama }}
            </p><br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($bimbingan->dosen2_id) ? $bimbingan->bimbinganDosen2->nama : '-' }}
            </p><br>
            <p><span class="font-bold">Dosen Penguji: </span></p>
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
            <p><span class="font-bold">Link Presentasi: </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanSkripsi->link_presentasi }}">{{ $pengajuanSkripsi->link_presentasi }}</a>
            </p><br>
            <p><span class="font-bold">Sertifikat Lomba: </span>
                <a class="text-blue-500"
                    href="{{ $pengajuanSkripsi->sertifikat_lomba }}">{{ $pengajuanSkripsi->sertifikat_lomba }}</a>
            </p><br>
            <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanSkripsi->status }}</p><br>
            <p><span class="font-bold">Nilai Dosen Pembimbing: </span>
                @if ($pengajuanSkripsi->nilai_pembimbing2)
                    {{ ($pengajuanSkripsi->nilai_pembimbing + $pengajuanSkripsi->nilai_pembimbing2) / 2 }}
                @else
                    {{ $pengajuanSkripsi->nilai_pembimbing }}
                @endif
            </p><br>
            <p><span class="font-bold">Nilai Dosen Penguji: </span>
                {{ ($pengajuanSkripsi->nilai1 + $pengajuanSkripsi->nilai2 + $pengajuanSkripsi->nilai3) / 3 }}
            </p><br>
            <p><span class="font-bold">Nilai Total: </span>{{ $pengajuanSkripsi->nilai }}</p><br>
            <p><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSkripsi->tanggal }}</p><br>
            <P><span class="font-bold">Keterangan: </span></P>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanSkripsi->keterangan }}</textarea><br>
        </div>
    </div>
@endsection
