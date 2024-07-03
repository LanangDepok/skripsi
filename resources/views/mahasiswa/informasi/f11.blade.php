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
                <p class="text-4xl font-semibold">F11</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
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
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p>
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
                        <th class="border border-slate-500 py-2 text-center">TANDA TANGAN</th>
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
                                class="max-w-32 max-h-24 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_pembimbing }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PEMBIMBING 2</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            @if ($pengajuanSkripsi->dospem2_id != null)
                                <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiDospem2->dosen->tanda_tangan }}"
                                    class="max-w-32 max-h-24 mx-auto">
                            @else
                                -
                            @endif
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ isset($pengajuanSkripsi->dospem2_id) ? $pengajuanSkripsi->pengajuanRevisi->keterangan_pembimbing2 : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold text-center">PENGUJI 1</td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            <img src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan }}"
                                class="max-w-32 max-h-24 mx-auto">
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
                                class="max-w-32 max-h-24 mx-auto">
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
                                class="max-w-32 max-h-24 mx-auto">
                        </td>
                        <td class="border border-slate-500 py-2 font-semibold text-center">
                            {{ $pengajuanSkripsi->pengajuanRevisi->keterangan_penguji3 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3 ml-auto w-1/4">
            <p>Depok, {{ $pengajuanSkripsi->pengajuanRevisi->tanggal_revisi }}</p>
            <p>Ketua Komite Skripsi,</p>
            <img class="max-w-32 max-h-24" src="/storage/{{ $ttd->dosen->tanda_tangan }}">
            <p>{{ $ttd->nama }}</p>
            <p>NIP.{{ $ttd->dosen->nip }}</p>
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
