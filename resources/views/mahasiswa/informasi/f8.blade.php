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
                <p class="text-4xl font-semibold">F8</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">REKAPITULASI NILAI SIDANG SKRIPSI</p>
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
            <p><span class="font-semibold">Pembimbing 1:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <p><span class="font-semibold">Pembimbing 2:
                </span>{{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
            </p>
        </div>
        <div class="mt-3">
            <table class="table-auto mx-auto w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-500 py-2 text-left text-center" colspan="4">NILAI PENGUJI</th>
                        <th class="border border-slate-500 py-2 text-left text-center" colspan="4">NILAI PEMBIMBING</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">1</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">2</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">3</td>
                        <td class="border border-slate-500 py-2 font-semibold">Nilai Rata-rata, NRP</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">1</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">2</td>
                        <td class="border border-slate-500 py-2 font-semibold" colspan="2">Nilai Rata-rata, NRB</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->nilai1 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->nilai2 }}</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->nilai3 }}</td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ number_format(($pengajuanSkripsi->nilai1 + $pengajuanSkripsi->nilai2 + $pengajuanSkripsi->nilai3) / 3, 1) }}
                        </td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->nilai_pembimbing }}</td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->nilai_pembimbing2 : '' }}
                        </td>
                        <td class="border border-slate-500 py-2 text-center" colspan="2">
                            @if ($pengajuanSkripsi->dospem2_id != null)
                                {{ ($pengajuanSkripsi->nilai_pembimbing + $pengajuanSkripsi->nilai_pembimbing2) / 2 }}
                            @else
                                {{ $pengajuanSkripsi->nilai_pembimbing }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center" rowspan="2" colspan="6">
                            NILAI SKRIPSI, NS = ( NRB + 2 NRP ) / 3
                        </td>
                        <td class="border border-slate-500 py-2 text-center">Angka Mutu</td>
                        <td class="border border-slate-500 py-2 text-center">Huruf Mutu</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai_total }}
                        </td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->nilai_mutu }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p>Ketua Sidang,</p>
            <img class="max-w-32 max-h-24"
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
