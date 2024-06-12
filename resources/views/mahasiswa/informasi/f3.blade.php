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
                <p class="text-4xl font-semibold">F3</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
    <div class="container mx-auto">
        <p class="text-center font-bold underline text-2xl">Berita Acara Proposal Skripsi</p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <p>Pada {{ $pengajuanSempro->tanggal }}, telah diakan penilaian proposal skripsi untuk saudara:</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</p>
            <p><span class="font-semibold">Judul Skripsi :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <p>Bertindak sebagai pelaksana :</p>
        </div>
        <div class="mt-3">
            <div class="container flex flex-row justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">1. Ketua/ Penguji-1 :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-32 max-h-24"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji1->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">2. Penguji-2 :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji2->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-32 max-h-24"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji2->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">3. Penguji-3 :
                        </span>{{ $pengajuanSempro->pengajuanSemproPenguji3->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-32 max-h-24"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproPenguji3->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
            <div class="container flex justify-between items-center">
                <div class="basis-2/3">
                    <p><span class="font-semibold">4. Pembimbing :
                        </span>{{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p>
                </div>
                <div class="basis-1/3">
                    <img class="max-w-32 max-h-24"
                        src="/storage/{{ $pengajuanSempro->status == 'Lulus' ? $pengajuanSempro->pengajuanSemproDospem->dosen->tanda_tangan : '-' }}">
                </div>
            </div>
        </div>
        <div class="container mt-10 ">
            <p class="text-center">Depok, {{ $pengajuanSempro->tanggal }}</p>

        </div>
        <div class="flex justify-between mt-10">
            <div>
                <p class="text-center">Mahasiswa Ybs,</p>
                <img src="/storage/assets/signature.png" class="max-w-60 mx-auto">
                <p class="text-center underline">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
                <p class="text-center">NIM.{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
            </div>
            <div>
                <p class="text-center">Ketua Sidang,</p>
                <img src="/storage/assets/signature.png" class="max-w-60 mx-auto">
                <p class="text-center underline">{{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}</p>
                <p class="text-center">NIP.{{ $pengajuanSempro->pengajuanSemproPenguji1->dosen->nip }}</p>
            </div>
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
