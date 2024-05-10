@extends('mahasiswa.template')

@section('content')
    <div class="print:hidden">
        <a href="{{ url()->previous() }}"
            class="bg-primary border rounded-md w-16 mx-auto text-white hover:text-black hover:bg-red-300 block text-center">
            Back
        </a>
    </div>
    <div class="container ml-auto mr-10">
        <div class="border-4 border-black w-20 ml-auto">
            <p class="text-4xl font-semibold text-center">F7b</p>
        </div>
    </div>
    <div class="container mx-auto">
        <p class="text-center font-bold text-2xl underline">LEMBAR PENILAIAN PENGUJI</p>
    </div>
    <div class="container w-full mx-auto mt-10 mb-20">
        <p>Yang bertanda tangan di bawah ini adalah Pembimbing skripsi :</p>
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
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2a1'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Kesesuaian dengan isi laporan (A2)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2a2'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Sesuai dengan format penulisan (A3)</td>
                        <td class="border border-slate-500 py-2 text-center">4,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2a3'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            Nilai Pengetahuan,NA = ( A1+A2+A3 )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'2a1'} + $pengajuanSkripsi->{'2a2'} + $pengajuanSkripsi->{'2a3'} }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 font-semibold" colspan="2">B. KETERAMPILAN</td>
                        <td class="border border-slate-500 py-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Perancangan Alat/Program Aplikasi (B1)</td>
                        <td class="border border-slate-500 py-2 text-center">5,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2b1'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Pembangunan Alat/Program Aplikasi(B2)</td>
                        <td class="border border-slate-500 py-2 text-center">5,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2b2'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">PengsidangAlat/Program Aplikasi(B3)</td>
                        <td class="border border-slate-500 py-2 text-center">5,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2b3'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">PengoperasianAlat/Program Aplikasi(B4)</td>
                        <td class="border border-slate-500 py-2 text-center">5,5 - 10</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2b4'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2">Penyajian Alat/Program Aplikasi (B5)</td>
                        <td class="border border-slate-500 py-2 text-center">5,5 - 15</td>
                        <td class="border border-slate-500 py-2 text-center">{{ $pengajuanSkripsi->{'2b5'} }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            Nilai Keterampilan,NB = ( B1+B2+B3+B4+B5 )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'2b1'} + $pengajuanSkripsi->{'2b2'} + $pengajuanSkripsi->{'2b3'} + $pengajuanSkripsi->{'2b4'} + $pengajuanSkripsi->{'2b5'} }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-500 py-2 text-center font-semibold" colspan="2">
                            NILAI TOTAL ( NA+NB )
                        </td>
                        <td class="border border-slate-500 py-2 text-center">
                            {{ $pengajuanSkripsi->{'2a1'} +
                                $pengajuanSkripsi->{'2a2'} +
                                $pengajuanSkripsi->{'2a3'} +
                                $pengajuanSkripsi->{'2b1'} +
                                $pengajuanSkripsi->{'2b2'} +
                                $pengajuanSkripsi->{'2b3'} +
                                $pengajuanSkripsi->{'2b4'} +
                                $pengajuanSkripsi->{'2b5'} }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p>Depok, {{ $pengajuanSkripsi->tanggal }}</p>
            <p>Penguji 2,</p>
            <img class="max-w-32 max-h-24"
                src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->dosen->tanda_tangan }}">
            <p>{{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
            <p>NIP.{{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->dosen->nip }}2342424234223424</p>
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
