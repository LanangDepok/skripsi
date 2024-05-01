@extends('mahasiswa.template')

@section('content')
    <div class="w-1/2 mx-auto print:hidden">
        <a href="/mahasiswa/informasi"
            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block text-center">
            Back
        </a>
    </div>
    <div class="container w-1/2 mx-auto">
        <div class="border-4 border-black w-10 ml-auto">
            <p class="text-2xl font-semibold text-center">F3</p>
        </div>
    </div>
    <div class="container w-1/3 mx-auto">
        <p class="text-center font-bold underline text-2xl">Berita Acara Proposal Skripsi</p>
    </div>
    <div class="container w-1/2 mx-auto mt-10 mb-20">
        <p>Pada {{ $pengajuanSempro->tanggal }}, telah diakan penilaian proposal skripsi untuk saudara:</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <p>Bertindak sebagai pelaksana :</p>
        </div>
        <div class="mt-3">
            <div class="container flex flex-row justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">1. Ketua Sidang :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji1->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">2. Penguji 2 :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji2->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji2->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">3. Penguji 3 :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji3->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji3->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">4. Pembimbing :
                        </span>{{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-16 max-h-12"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproDospem->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
        </div>
        <div class="container mt-10 ">
            <p class="text-center">{{ $pengajuanSempro->tanggal }}</p>
            <p class="text-center">Mahasiswa Ybs,</p>
            <img src="/storage/assets/signature.png" class="max-w-60 mx-auto">
            <p class="text-center underline">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p class="text-center">NIM.{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
        </div>
    </div>
    <a href="#" onclick="downloadPDF()"
        class="block w-36 text-lg bg-primary text-white hover:text-black hover:bg-red-300 mx-auto rounded-md text-center print:hidden">Unduh
        PDF</a>

    <script>
        function downloadPDF() {
            window.print();
        }
    </script>
@endsection
