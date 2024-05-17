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
    <div class="container ml-auto mr-10">
        <div class="border-4 border-black w-20 ml-auto">
            <p class="text-4xl font-semibold text-center">F11</p>
        </div>
    </div>
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">LEMBAR TANDA BUKTI REVISI SKRIPSI</p>
        <p class="text-center font-bold text-2xl underline">(Alat/Program/Aplikasi Multimedia dan atau Laporan Skripsi)</p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <p>Yang bertanda tangan dibawah ini adalah Pembimbing dan Penguji, menyatakan bahwa mahasiswa :</p>
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
            <p class="mb-2">Telah menyelesaikan revisi Alat/Program Aplikasi dan atau laporan skripsi.</p>
            <table class="table-auto mx-auto w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-500 py-2 text-center"></th>
                        <th class="border border-slate-500 py-2 text-center">nama</th>
                        <th class="border border-slate-500 py-2 text-center">NILAI PEMBIMBING</th>
                        <th class="border border-slate-500 py-2 text-center">KETERANGAN/TANGGAL PENYERAHAN
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PEMBIMBING 1</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan }}"
                                class="max-h-28 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_pembimbing }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PEMBIMBING 2</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center"></td>
                        <td class="border border-slate-500 py-2 font-semibold text-center"></td>
                        <td class="border border-slate-500 py-2 font-semibold text-center"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PENGUJI 1</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan }}"
                                class="max-h-28 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji1 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PENGUJI 2</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->dosen->tanda_tangan }}"
                                class="max-h-28 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji2 }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PENGUJI 3</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->dosen->tanda_tangan }}"
                                class="max-h-28 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji3 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3 ml-auto w-1/4">
            <p>Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p>Ketua Komite Skripsi,</p>
            <img class="max-w-32 max-h-24"
                src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan }}">
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
