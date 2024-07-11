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
                <p class="text-4xl font-semibold">F9</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">SURAT KEPUTUSAN SIDANG SKRIPSI</p>
        <p class="text-center font-bold text-2xl underline">JURUSAN TEKNIK INFORMATIKA DAN KOMPUTER</p>
        <p class="text-center font-bold text-2xl underline">POLITEKNIK NEGERI JAKARTA</p>
        <p class="text-center font-bold mt-3">Nomor :
            .......................................................................</p>
    </div>
    <div class="container w-full mx-auto mt-5 mb-20">
        <p class="text-center">Tentang</p>
        <p class="font-semibold text-center">Alat/Program Aplikasi SIdang Skripsi</p>
        <div class="flex justify-start mt-3">
            <p>Mengingat &nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <div>
                <p>- Peraturan Akademik Politeknik Negeri Jakarta Tahun 2019</p>
                <p>- Pedoman skripsi Jurusan Teknik Informatika dan Komputer Tahun 2021</p>
            </div>
        </div>
        <div class="flex justify-start mt-3">
            <p>Menimbang : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <div>
                <p>- Batas kelulusan minimal dalam penilaian</p>
                <p>- Alat/Program Aplikasi/ Produk evaluasi penguji dan pembimbing</p>
            </div>
        </div>
        <div class="mt-3">
            <p class="text-center text-lg font-bold">MEMUTUSKAN</p>
            <p><span class="font-semibold">Nama Mahasiswa : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}
            </p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}
            </p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
            <p class="font-semibold"><span class="font-semibold">Dinyatakan :
                </span>{{ $pengajuanSkripsi->status }}</p>
            <div class="flex justify-start">
                <p class="font-semibold">Dengan Nilai : &nbsp;&nbsp;</p>
                <div>
                    <div class="border-2 border-black w-20">
                        <p class="text-center">{{ $pengajuanSkripsi->nilai_total }}</p>
                    </div>
                    <div class="border-2 border-black w-96 mt-2">
                        <p class="text-center">{{ $terbilang }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <p class="font-semibold">Persyaratan Kelulusan :</p>
            <p>1. Merevisi Alat/Program Aplikasi dan atau laporan skripsi sesuai Form F8 dan harus dipenuhi paling lambat
                pada
                {{ isset($pengajuanSkripsi->pengajuanRevisi) ? $pengajuanSkripsi->pengajuanRevisi->deadline : $deadline }},
                yaitu <span class="font-semibold">10 hari
                    kerja</span> setelah tanggal pelaksanaan
                sidang.</p>
            <p>2. Jika revisi tidak dipenuhi sampai batas waktu pada poin (1), putusan ini dinyatakan <span
                    class="font-semibold">batal</span> dan teruji harus
                mengikuti sidang ulang pada periode sidang yang ditentukan.</p>
        </div>
        <div class="mt-3">
            <p>Ditetapkan di : Depok</p>
            <p>Pada tanggal : {{ $pengajuanSkripsi->tanggal }}</p>
        </div>
        <div class="mt-3 flex justify-between">
            <div>
                <p>Persetujuan Teruji,</p>
                <img class="max-w-32 max-h-24"
                    src="{{ asset('storage/' . $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tanda_tangan) }}">
                <p>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
                <p>NIM.{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
            </div>
            <div>
                <p>Ketua Sidang,</p>
                <img class="max-w-32 max-h-24"
                    src="{{ asset('storage/' . $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan) }}">
                <p>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->nip }}</p>
            </div>
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
