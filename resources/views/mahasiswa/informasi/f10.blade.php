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
            <p class="text-4xl font-semibold text-center">F10</p>
        </div>
    </div>
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">LEMBAR REVISI ALAT/PROGRAM APLIKASI/APLIKASI MULTIMEDIA DAN ATAU
            LAPORAN SKRIPSI</p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <div class="mt-3">
            <p><span class="font-semibold">Nama Mahasiswa : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}
            </p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}
            </p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
            <p><span class="font-semibold">Tanggal Pelaksanaan Sidang :
                </span>{{ $pengajuanSkripsi->tanggal }}</p>
            <p><span class="font-semibold">Batas Akhir Persyaratan :
                </span>{{ $pengajuanSkripsi->pengajuanRevisi->deadline }}</p>
        </div>
        <div class="mt-3">
            <p class="font-semibold">A. Revisi Alat/Program Aplikasi Skripsi</p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanSkripsi->pengajuanRevisi->revisi_alat }}</textarea>
            <p class="font-semibold">B. Revisi Laporan Skripsi</p>
            <textarea class="w-full" rows="5" readonly>{{ $pengajuanSkripsi->pengajuanRevisi->revisi_laporan }}</textarea>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p>Ketua Sidang,</p>
            <img class="max-w-32 max-h-24"
                src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan }}">
            <p>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
            <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->nip }}2342424234223424</p>
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
