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
            <img src="/storage/assets/logo_pnj.png" class="w-32 h-32">
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
                <p class="text-4xl font-semibold">F4</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
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
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <p>Sesuai dengan persyaratan yang diatur dalam Pedoman Skripsi Jurusan Teknik informatika dan Komputer , maka
                dengan ini menyetujui mahasiswa tersebut di atas untuk mengikuti sidang skripsi Tahun Akademik
                {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</p>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->acc_dospem }}</p>
            @if ($pengajuanSkripsi->pengizin == $pengajuanSkripsi->pengajuanSkripsiDospem->id)
                <p>Pembimbing 1,</p>
                <img class="max-w-32 max-h-24"
                    src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan }}">
                <p>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
                <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->nip }}</p>
            @endif
            @isset($pengajuanSkripsi->dospem2_id)
                @if ($pengajuanSkripsi->pengizin == $pengajuanSkripsi->pengajuanSkripsiDospem2->id)
                    <p>Pembimbing 2,</p>
                    <img class="max-w-32 max-h-24"
                        src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiDospem2->dosen->tanda_tangan }}">
                    <p>{{ $pengajuanSkripsi->pengajuanSkripsiDospem2->nama }}</p>
                    <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiDospem2->dosen->nip }}</p>
                @endif
            @endisset
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
