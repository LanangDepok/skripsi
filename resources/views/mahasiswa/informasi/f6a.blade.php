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
                <p class="text-4xl font-semibold">F6</p>
            </div>
        </div>
    </div>
    <hr class="border-2 border-black w-3/4 mx-auto mb-10">
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">LEMBAR PENILAIAN PEMBIMBING</p>
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
            <table class="table-auto mx-auto w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-500 py-2 text-left">PARAMETER UJI</th>
                        <th class="border border-slate-500 py-2 text-left">RENTANG NILAI</th>
                        <th class="border border-slate-500 py-2 text-left">PEROLEHAN NILAI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold" colspan="2">A. TATA TULIS LAPORAN</td>
                        <td class="border border-slate-500 py-2 font-semibold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Kesesuaian dengan Sistematika Penulisan (A1)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4a1'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Kesesuaian dengan isi laporan (A2)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4a2'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Sesuai dengan format penulisan (A3)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4a3'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            Nilai Pengetahuan,NA = ( A1+A2+A3 )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'4a1'} + $pengajuanSkripsi->{'4a2'} + $pengajuanSkripsi->{'4a3'} }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold" colspan="2">B. KETERAMPILAN</td>
                        <td class="border border-slate-500 py-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Perancangan Alat/Program Aplikasi (B1)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4b1'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Pembangunan Alat/Program Aplikasi(B2)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4b2'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">PengsidangAlat/Program Aplikasi(B3)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4b3'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">PengoperasianAlat/Program Aplikasi(B4)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4b4'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            Nilai Keterampilan,NB = ( B1+B2+B3+B4 )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'4b1'} + $pengajuanSkripsi->{'4b2'} + $pengajuanSkripsi->{'4b3'} + $pengajuanSkripsi->{'4b4'} }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold" colspan="2">C. ETIKA KERJA</td>
                        <td class="border border-slate-500 py-2 font-semibold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Konsistensi terhadap jadwal bimbingan (C1)</td>
                        <td class="border border-slate-500 py-2 text-center">1,5 - 4,0</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4c1'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Tanggung jawab (C2)</td>
                        <td class="border border-slate-500 py-2 text-center">1,5 - 4,0</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4c2'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Kemampuan bekerjasama(C3)</td>
                        <td class="border border-slate-500 py-2 text-center">1,0 - 3,0</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4c3'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">
                            Kepatuhan terhadap Instruksi Kerja / Standar Operasi Kerja (C4)</td>
                        <td class="border border-slate-500 py-2 text-center">1,0 - 4,0</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'4c4'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            Nilai Etika Kerja,NC = ( C1+C2+C3+C4 )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'4c1'} + $pengajuanSkripsi->{'4c2'} + $pengajuanSkripsi->{'4c3'} + $pengajuanSkripsi->{'4c4'} }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            NILAI TOTAL ( NA+NB+NC )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->nilai_pembimbing }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p>Pembimbing 1</p>
            <img class="max-w-36 max-h-28"
                src="{{ asset('storage/' . $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan) }}">
            <p>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiDospem->dosen->nip }}</p>
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
