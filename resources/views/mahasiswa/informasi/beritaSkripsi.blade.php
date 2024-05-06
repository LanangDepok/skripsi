@extends('mahasiswa.template')

@section('content')
    <div class="w-1/2 mx-auto print:hidden">
        <a href="{{ url()->previous() }}"
            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block text-center">Back</a>
        </button>
    </div>
    <div class="container w-1/2 mx-auto">
        <div class="border-4 border-black w-10 ml-auto">
            <p class="text-2xl font-semibold text-center">F5</p>
        </div>
    </div>
    <div class="container w-1/3 mx-auto">
        <p class="text-center font-bold underline text-2xl">Berita Acara Sidang Skripsi</p>
    </div>
    <div class="container w-1/2 mx-auto mt-10">
        <p>Pada {{ $pengajuanSkripsi->tanggal }}, telah diakan sidang skripsi untuk saudara:</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}
            </p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <p>Bertindak sebagai pelaksana :</p>
        </div>
        <div class="mt-3">
            <div class="container flex flex-row justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">1. Ketua Sidang :
                        </span>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSkripsi->status == 'Lulus' ? $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">2. Penguji 2 :
                        </span>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSkripsi->status == 'Lulus' ? $pengajuanSkripsi->pengajuanSkripsiPenguji2->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">3. Penguji 3 :
                        </span>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSkripsi->status == 'Lulus' ? $pengajuanSkripsi->pengajuanSkripsiPenguji3->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">4. Pembimbing :
                        </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSkripsi->status == 'Lulus' ? $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
        </div>
        <div class="container mt-10 mb-20">
            <p class="text-center">Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p class="text-center">Mahasiswa Ybs,</p>
            <img src="/storage/assets/signature.png" class="max-w-60 mx-auto">
            <p class="text-center underline">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="text-center">NIM.{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
        </div>
    </div>
@endsection
