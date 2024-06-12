@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/bimbingan/persetujuanSidang"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a></button>
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
            <P>Email: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P>
            <br>
            <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P>
            <br>
            <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P>
            <br>
            <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P>
            <br>
            <P>Judul Skripsi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P>
            <br>
            <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Tanggal pengajuan: {{ $pengajuanSkripsi->created_at->format('d F Y') }}</p>
            <br>
            <p>Dosen Pembimbing: {{ Auth::user()->nama }}</p>
            <br>
            <P>
                Link presentasi:
                <a class="italic text-blue-400" href="{{ $pengajuanSkripsi->link_presentasi }}">
                    {{ $pengajuanSkripsi->link_presentasi }}
                </a>
            </P><br>
            <P>
                Sertifikat lomba:
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
        <form method="POST" action="/dosen/bimbingan/persetujuanSkripsi/{{ $pengajuanSkripsi->id }}">
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
