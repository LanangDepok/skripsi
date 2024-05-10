@extends('admin.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pelaksanaan Sidang</p>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <div class="flex justify-evenly items-center">
            <div>
                <label for="cari_nama">Nama:</label>
                <input type="text" id="cari_nama" name="cari_nama" class="w-56" value="{{ request()->input('cari_nama') }}">
            </div>
            <div>
                <label for="program_studi">Program Studi:</label>
                <select name="cari_prodi" id="cari_prodi" class="w-72">
                    <option value="">(Tanpa filter)</option>
                    <option value="Teknik Informatika"
                        {{ request()->input('cari_prodi') === 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                        Informatika</option>
                    <option value="Teknik Multimedia Digital"
                        {{ request()->input('cari_prodi') === 'Teknik Multimedia Digital' ? 'selected' : '' }}>Teknik
                        Multimedia Digital</option>
                    <option value="Teknik Multimedia dan Jaringan"
                        {{ request()->input('cari_prodi') === 'Teknik Multimedia dan Jaringan' ? 'selected' : '' }}>
                        Teknik
                        Multimedia dan Jaringan</option>
                </select>
            </div>
            <div>
                <label for="cari_jenis_sidang">Jenis Sidang:</label>
                <select name="cari_jenis_sidang" id="cari_jenis_sidang" class="w-56">
                    <option value="Sidang Sempro"
                        {{ request()->input('cari_jenis_sidang') === 'Sidang Sempro' ? 'selected' : '' }}>Sidang
                        Sempro
                    </option>
                    <option value="Sidang Skripsi"
                        {{ request()->input('cari_jenis_sidang') === 'Sidang Skripsi' ? 'selected' : '' }}>Sidang Skripsi
                    </option>
                </select>
            </div>
            {{-- <div>
                <label for="program_studi">Status:</label>
                <select name="program_studi" id="program_studi" class="w-56">
                    <option value="Teknik Informatika">Lulus</option>
                    <option value="Teknik Multimedia Digital">Tidak Lulus</option>
                    <option value="Teknik Multimedia Digital">Menunggu persetujuan pembimbing</option>
                    <option value="Teknik Multimedia Digital">Menunggu pembagian jadwal</option>
                </select>
            </div> --}}
            <button class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
        </div>
    </div>
    <div class="container mx-auto mt-6">
        <table class="table-auto mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">N0.</th>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Prodi</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Dosen Penguji</th>
                    <th class="border-b border-slate-500 py-2">Jenis</th>
                    <th class="border-b border-slate-500 py-2">Pelaksanaan</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($sempro as $sempro)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $sempro->pengajuanSemproMahasiswa->nama }} <br>
                            ({{ $sempro->pengajuanSemproMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $sempro->pengajuanSemproMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $sempro->pengajuanSemproMahasiswa->skripsi->judul }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $sempro->pengajuanSemproDospem->nama }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1.
                                {{ $sempro->pengajuanSemproPenguji1->nama ?? '-' }}
                            </p>
                            <p>2.
                                {{ $sempro->pengajuanSemproPenguji2->nama ?? '-' }}
                            </p>
                            <p>3.
                                {{ $sempro->pengajuanSemproPenguji3->nama ?? '-' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">Sidang Sempro</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ isset($sempro->tanggal) ? $sempro->tanggal : '-' }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $sempro->status }}</td>
                    </tr>
                @endforeach

                @foreach ($skripsi as $skripsi)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>

                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $skripsi->pengajuanSkripsiMahasiswa->nama }} <br>
                            ({{ $skripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $skripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ isset($skripsi->pengajuanSkripsiMahasiswa->skripsi->judul) ? $skripsi->pengajuanSkripsiMahasiswa->skripsi->judul : 'Mahasiswa belum mengajukan judul.' }}
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ $skripsi->pengajuanSkripsiDospem->nama }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <p>1. {{ $skripsi->pengajuanSkripsiPenguji1->nama ?? '-' }}</p>
                            <p>2. {{ $skripsi->pengajuanSkripsiPenguji2->nama ?? '-' }}</p>
                            <p>3. {{ $skripsi->pengajuanSkripsiPenguji3->nama ?? '-' }}</p>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-center">Sidang Skripsi</td>
                        <td class="border-b border-slate-500 py-2 text-center">
                            {{ isset($skripsi->tanggal) ? $skripsi->tanggal : '-' }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $skripsi->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
