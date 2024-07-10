@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.getAllPersetujuanSidang') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil) ? $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P>
            <br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas->nama }}</P>
            <br>
            <P><span class="font-bold">Prodi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</P>
            <br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->anggota }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</P>
            <br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Metode: </span>{{ $pengajuanSempro->metode }}</p>
            <br>
            <p><span class="font-bold">Tanggal Pengajuan: </span>{{ $pengajuanSempro->created_at->format('d F Y') }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ Auth::user()->nama }}</p>
            <br>
            <P>
                <span class="font-bold">Bukti Registrasi: </span>
                <a class="italic text-blue-400" href="{{ $pengajuanSempro->bukti_registrasi }}">
                    {{ $pengajuanSempro->bukti_registrasi }}
                </a>
            </P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($pengajuanSempro->pengajuanSemproMahasiswa->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
            @endif
        </div>
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima persetujuan seminar proposal atas nama {{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}?')">Terima</button>
                <button type="submit" name="tolak"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Tolak persetujuan seminar proposal atas nama {{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}?')">Tolak</button>
            </div>
        </form>
    </div>
@endsection
