@php
    $layout = null;
    if (auth()->user()->can('dosen_pembimbing')) {
        $layout = 'dosen.template';
    } elseif (auth()->user()->can('mahasiswa')) {
        $layout = 'mahasiswa.template';
    }
@endphp

@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="print:hidden">
        <a href="{{ url()->previous() }}"
            class="bg-primary border rounded-md w-16 mx-auto text-white hover:text-black hover:bg-red-300 block text-center">
            Back
        </a>
    </div>
    <div class="container flex justify-evenly mt-10 mx-auto">
        <div class="flex items-center">
            <img src="{{ asset('storage/assets/logo_pnj.png') }}" class="w-32 h-32">
        </div>
        <div class="text-center">
            <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</p>
            <p>POLITEKNIK NEGERI JAKARTA</p>
            <p class="font-bold">JURUSAN TEKNIK INFORMATIKA DAN KOMPUTER</p>
            <br>
            <p>Jl. Prof.DR.G.A. Siwabesy, Kampus UI, Depok 16425</p>
            <p>Telp. (021) 91274097, Fax (021) 7863531</p>
            <p>Laman : http://www.pnj.ac.id, e-mail:tik@pnj.ac.id</p>
        </div>
        <div class="flex items-start">
            <div class="border-4 border-black w-20 h-20 flex items-center justify-center">
                <p class="text-4xl font-semibold">F10</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
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
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p>
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
            <img class="max-w-36 max-h-28"
                src="{{ asset('storage/' . $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan) }}">
            <p>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
            <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->nip }}</p>
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
