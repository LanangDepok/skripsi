@extends('mahasiswa.template')

@section('content')
    <div class="print:hidden">
        <a href="{{ url()->previous() }}"
            class="bg-primary border rounded-md w-16 mx-auto text-white hover:text-black hover:bg-red-300 block text-center">
            Back
        </a>
    </div>
    <div class="container ml-auto mr-10">
        <div class="border-4 border-black w-20 ml-auto">
            <p class="text-4xl font-semibold text-center">F4</p>
        </div>
    </div>
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl">LEMBAR PERSETUJUAN PEMBIMBING <span class="underline"><br>MENGIKUTI SIDANG
                SKRIPSI</span></p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <p>Yang bertanda tangan di bawah ini adalah Pembimbing skripsi :</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama Mahasiswa : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}
            </p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}
            </p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <p>Sesuai dengan persyaratan yang diatur dalam Pedoman Skripsi Jurusan Teknik informatika dan Komputer , maka
                dengan ini menyetujui mahasiswa tersebut di atas untuk mengikuti sidang skripsi Tahun Akademik
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun_ajaran }}</p>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->acc_dospem }}</p>
            <p>Pembimbing,</p>
            <img class="max-w-32 max-h-24"
                src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan }}">
            <p>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->nip }}</p>
        </div>
        <div class="mt-3">
            <a href="#" onclick="downloadPDF()"
                class="block w-36 text-lg bg-primary text-white hover:text-black hover:bg-red-300 mx-auto rounded-md text-center print:hidden">Unduh
                PDF</a>
        </div>
        <script>
            function downloadPDF() {
                window.print();
            }
        </script>
    @endsection
