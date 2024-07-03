@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/admin/pelaksanaan/skripsi"
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
            <P><span class="font-bold">Email: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <P><span class="font-bold">Link Presentasi:
                </span>{{ $pengajuanSkripsi->link_presentasi }}</P>
            <br>
            <P><span class="font-bold">Sertifikat Lomba:
                </span>{{ $pengajuanSkripsi->sertifikat_lomba }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1: </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}</p><br>
            <p><span class="font-bold">Penguji: </span>
                <br>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSkripsi->tanggal }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSkripsi->status }}</P><br>
            <P><span class="font-bold">Nilai: </span>{{ $pengajuanSkripsi->nilai_total }}</P><br>
            <P><span class="font-bold">Nilai Mutu: </span>{{ $pengajuanSkripsi->nilai_mutu }}</P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            @if ($pengajuanSkripsi->pengajuanRevisi)
                <p class="font-bold text-xl text-center mt-5">Revisi</p>
                <p class="font-semibold text-lg mt-5">A. Revisi Alat/Program Aplikasi Skripsi</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->revisi_alat }}
               </textarea>
                <p class="font-bold mt-1">Link revisi alat:
                    <a href="{{ $pengajuanSkripsi->pengajuanRevisi->link_revisi_alat }}" target="_blank"
                        class="text-blue-600 italic">{{ $pengajuanSkripsi->pengajuanRevisi->link_revisi_alat }}</a>
                </p>
                <p class="font-semibold text-lg mt-5">B. Revisi Laporan Skripsi</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->revisi_laporan }}
               </textarea>
                <p class="font-semibold text-lg mt-5">Keterangan Pembimbing 1</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_pembimbing }}
               </textarea>
                <p class="font-semibold text-lg mt-5">Keterangan Pembimbing 2</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_pembimbing2 }}
               </textarea>
                <p class="font-semibold text-lg mt-5">Keterangan Penguji 1</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji1 }}
               </textarea>
                <p class="font-semibold text-lg mt-5">Keterangan Penguji 2</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji2 }}
               </textarea>
                <p class="font-semibold text-lg mt-5">Keterangan Penguji 3</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                    {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji3 }}
               </textarea>
                <P><span class="font-bold">Status revisi: </span>{{ $pengajuanSkripsi->pengajuanRevisi->status }}</P><br>
                <P><span class="font-bold">Deadline: </span>{{ $pengajuanSkripsi->pengajuanRevisi->deadline }}</P><br>
                <P><span class="font-bold">Tanggal selesai revisi:
                    </span>{{ $pengajuanSkripsi->pengajuanRevisi->tanggal_revisi }}</P><br>
                <div class="h-1 bg-primary"></div>
            @endif
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
