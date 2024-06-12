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
                <p class="text-4xl font-semibold">F2</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">PENILAIAN PROPOSAL SKRIPSI JURUSAN TEKNIK INFORMATIKA DAN
            KOMPUTER </p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <p>Yang bertanda tangan di bawah ini adalah Pembimbing skripsi :</p>
        <div class="mt-3">
            <p><span class="font-semibold">Nama : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p><span class="font-semibold">NIM : </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
            <p><span class="font-semibold">Program Studi :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</p>
            <p><span class="font-semibold">JUDUL* :
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</p>
        </div>
        <div class="mt-3">
            <table class="table-auto mx-auto w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-500 py-2 text-left">NO</th>
                        <th class="border border-slate-500 py-2 text-left">KRITERIA</th>
                        <th class="border border-slate-500 py-2 text-left">INDIKATOR PENILAIAN</th>
                        <th class="border border-slate-500 py-2 text-left">BOBOT</th>
                        <th class="border border-slate-500 py-2 text-left">SKOR</th>
                        <th class="border border-slate-500 py-2 text-left">NILAI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-slate-500 py-2">1</td>
                        <td class="border border-slate-500 py-2">Oritentasi Permasalahan dan Pustaka</td>
                        <td class="border border-slate-500 py-2">
                            <p>a. Latar Belakang</p>
                            <p>b. Perumusan Masalah</p>
                            <p>c. Batasan Masalah</p>
                            <p>d. Tinjauan dan Manfaat</p>
                            <p>e. Tinjauan Pustaka</p>
                        </td>
                        <td class="border border-slate-500 py-2 text-center">25</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria1 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria1 * 25 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">2</td>
                        <td class="border border-slate-500 py-2">Pola Penyelesaian Masalah</td>
                        <td class="border border-slate-500 py-2">Metode Pelaksanaan Skripsi</td>
                        <td class="border border-slate-500 py-2 text-center">25</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria2 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria2 * 25 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">3</td>
                        <td class="border border-slate-500 py-2">Manfaat Hasil</td>
                        <td class="border border-slate-500 py-2">Manfaat</td>
                        <td class="border border-slate-500 py-2 text-center">25</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria3 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria3 * 25 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">4</td>
                        <td class="border border-slate-500 py-2">Fisibilitas Sumber Daya</td>
                        <td class="border border-slate-500 py-2">
                            <p>a. Jadwal Pelaksanaan</p>
                            <p>b. Personalia Skripsi</p>
                            <p>c. Perkiraan Biaya</p>
                        </td>
                        <td class="border border-slate-500 py-2 text-center">15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria4 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria4 * 15 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">4</td>
                        <td class="border border-slate-500 py-2">Fisibilitas Sumber Daya</td>
                        <td class="border border-slate-500 py-2">
                            <p>a. Jadwal Pelaksanaan</p>
                            <p>b. Personalia Skripsi</p>
                            <p>c. Perkiraan Biaya</p>
                        </td>
                        <td class="border border-slate-500 py-2 text-center">10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria5 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSempro->kriteria5 * 10 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center" colspan="5">NILAI TOTAL</td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSempro->nilai }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p>1. Masing-masing kriteria diberi skor 1,2,4, dan 5 (1=sangat kurang, 2=kurang, 4=baik, 5=sangat baik) yang
                mencerminkan skor seluruh butir yang dinilai dalam masing-masing kriteria.</p>
            <P>2. Nilai = Skor x Bobot; Nilai Total = N1+N2+N3+N4+N5</P>
            <P>3. Hasil Penilaian : Nilai Total ≥ 400 ( Diterima ) ; Nilai Total < 400 ( Ditolak )</P>
        </div>
        <div class="mt-3 flex justify-between">
            <div>
                <p>Depok, {{ $pengajuanSempro->tanggal }}</p>
                <p>Ketua Sidang</p>
                <img class="max-w-32 max-h-24"
                    src="/storage/{{ $pengajuanSempro->pengajuanSemproPenguji1->dosen->tanda_tangan }}">
                <p>{{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}</p>
                <p>NIP.{{ $pengajuanSempro->pengajuanSemproPenguji1->dosen->nip }}</p>
            </div>
            <div>
                <textarea cols="50" rows="5" readonly>{{ $pengajuanSempro->keterangan }}</textarea>
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
