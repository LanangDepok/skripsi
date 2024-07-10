@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.getAllPersetujuanSidang') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil) ? $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P>
            <br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P>
            <br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P>
            <br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P>
            <br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Tanggal Pengajuan: </span>{{ $pengajuanSkripsi->created_at->format('d F Y') }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <br>
            <P>
                <span class="font-bold">Link Presentasi: </span>
                <a class="italic text-blue-400" href="{{ $pengajuanSkripsi->link_presentasi }}">
                    {{ $pengajuanSkripsi->link_presentasi }}
                </a>
            </P><br>
            <P>
                <span class="font-bold">Sertifikat Lomba: </span>
                <a class="italic text-blue-400" href="{{ $pengajuanSkripsi->sertifikat_lomba }}">
                    {{ $pengajuanSkripsi->sertifikat_lomba }}
                </a>
            </P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
            @endif
        </div>
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima persetujuan sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Terima</button>
                <button type="submit" name="tolak"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Tolak persetujuan sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Tolak</button>
            </div>
        </form>
    </div>
@endsection
