@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Nilai Sidang Skripsi</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <form method="POST"
                        action="{{ route('dsn.nilaiskripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
                        @csrf
                        <div class="w-10 ml-auto border-4 border-black">
                            <p class="text-2xl font-semibold text-center">F6</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Nama: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>NIM: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Judul: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <p class="font-bold text-lg">A. TATA TULIS LAPORAN</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Kesesuaian dengan sistematika penulisan <span class="text-red-700 font-semibold">(Nilai:
                                    4,5 - 10)</span></p>
                            <input type="number" step="0.1" id="a1" name="a1" value="{{ old('a1') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('a1')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Kesesuaian dengan isi laporan <span class="text-red-700 font-semibold">(Nilai: 4,5 -
                                    15)</span>
                            </p>
                            <input type="number" step="0.1" id="a2" name="a2" value="{{ old('a2') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('a2')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Sesuai dengan format penulisan <span class="text-red-700 font-semibold">(Nilai: 4,5 -
                                    10)</span>
                            </p>
                            <input type="number" step="0.1" id="a3" name="a3" value="{{ old('a3') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('a3')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p class="text-red-700 font-bold">Nilai Total poin A (A1 + A2 + A3)</p>
                            <input type="number" step="0.1" id="total_a" name="total_a" value="{{ old('total_a') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                readonly>
                        </div>
                        <div class="text-left mb-4">
                            <p class="font-bold text-lg">B. KETERAMPILAN</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Perancangan alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 4,5 -
                                    15)</span></p>
                            <input type="number" step="0.1" id="b1" name="b1" value="{{ old('b1') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('b1')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Pembangunan alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 4,5 -
                                    10)</span></p>
                            <input type="number" step="0.1" id="b2" name="b2" value="{{ old('b2') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('b2')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Pengsidang alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 4,5 -
                                    10)</span></p>
                            <input type="number" step="0.1" id="b3" name="b3" value="{{ old('b3') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('b3')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Pengoperasian alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 4,5
                                    - 15)</span></p>
                            <input type="number" step="0.1" id="b4" name="b4" value="{{ old('b4') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('b4')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p class="text-red-700 font-bold">Nilai Total poin B (B1 + B2 + B3 + B4)</p>
                            <input type="number" step="0.1" id="total_b" name="total_b"
                                value="{{ old('total_b') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                readonly>
                        </div>
                        <div class="text-left mb-4">
                            <p class="font-bold text-lg">C. ETIKA KERJA</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Konsistensi terhadap jadwal bimbingan <span class="text-red-700 font-semibold">(Nilai: 1,5
                                    - 4,0)</span></p>
                            <input type="number" step="0.1" id="c1" name="c1"
                                value="{{ old('c1') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('c1')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Tanggung jawab <span class="text-red-700 font-semibold">(Nilai: 1,5
                                    - 4,0)</span></p>
                            <input type="number" step="0.1" id="c2" name="c2"
                                value="{{ old('c2') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('c2')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Kemampuan bekerjasama <span class="text-red-700 font-semibold">(Nilai: 1,0
                                    - 3,0)</span></p>
                            <input type="number" step="0.1" id="c3" name="c3"
                                value="{{ old('c3') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('c3')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p>Kepatuhan terhadap instruksi kerja/standar operasi kerja <span
                                    class="text-red-700 font-semibold">(Nilai: 1,0
                                    - 4,0)</span></p>
                            <input type="number" step="0.1" id="c4" name="c4"
                                value="{{ old('c4') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                            @error('c4')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <p class="text-red-700 font-bold">Nilai Total poin C (C1 + C2 + C3 + C4)</p>
                            <input type="number" step="0.1" id="total_c" name="total_c"
                                value="{{ old('total_c') }}"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                readonly>
                        </div>
                        <div class="text-left mb-4">
                            <p class="font-bold text-lg">Nilai Total <span class="text-red-700 font-semibold">(NA + NB +
                                    NC)</span></p>
                            <input type="text" id="total_nilai" name="total_nilai"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                readonly>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <a href="{{ route('dsn.getAllPengujianSkripsi') }}"
                                    class="bg-primary w-24 block rounded-2xl hover:bg-red-300 text-white">Back</a>
                            </div>
                            <div class="text-center mt-12">
                                <button class="bg-primary w-24 rounded-2xl hover:bg-red-300 text-white"
                                    onclick="return confirm('Nilai sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Nilai</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //hitung total A
        function hitungNilaiTotal_A() {
            var a1 = parseFloat(document.getElementById('a1').value) || 0;
            var a2 = parseFloat(document.getElementById('a2').value) || 0;
            var a3 = parseFloat(document.getElementById('a3').value) || 0;
            var nilaiTotal_A = a1 + a2 + a3;
            document.getElementById('total_a').value = nilaiTotal_A.toFixed(1);
            hitungNilaiTotal();
        }

        document.getElementById('a1').addEventListener('input', hitungNilaiTotal_A);
        document.getElementById('a2').addEventListener('input', hitungNilaiTotal_A);
        document.getElementById('a3').addEventListener('input', hitungNilaiTotal_A);

        //hitung total B
        function hitungNilaiTotal_B() {
            var b1 = parseFloat(document.getElementById('b1').value) || 0;
            var b2 = parseFloat(document.getElementById('b2').value) || 0;
            var b3 = parseFloat(document.getElementById('b3').value) || 0;
            var b4 = parseFloat(document.getElementById('b4').value) || 0;
            var nilaiTotal_B = b1 + b2 + b3 + b4;
            document.getElementById('total_b').value = nilaiTotal_B.toFixed(1);
            hitungNilaiTotal();
        }

        document.getElementById('b1').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b2').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b3').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b4').addEventListener('input', hitungNilaiTotal_B);

        //hitung total C
        function hitungNilaiTotal_C() {
            var c1 = parseFloat(document.getElementById('c1').value) || 0;
            var c2 = parseFloat(document.getElementById('c2').value) || 0;
            var c3 = parseFloat(document.getElementById('c3').value) || 0;
            var c4 = parseFloat(document.getElementById('c4').value) || 0;
            var nilaiTotal_C = c1 + c2 + c3 + c4;
            document.getElementById('total_c').value = nilaiTotal_C.toFixed(1);
            hitungNilaiTotal();
        }

        document.getElementById('c1').addEventListener('input', hitungNilaiTotal_C);
        document.getElementById('c2').addEventListener('input', hitungNilaiTotal_C);
        document.getElementById('c3').addEventListener('input', hitungNilaiTotal_C);
        document.getElementById('c4').addEventListener('input', hitungNilaiTotal_C);

        //hitung total A+B+C
        function hitungNilaiTotal() {
            var a = parseFloat(document.getElementById('total_a').value) || 0;
            var b = parseFloat(document.getElementById('total_b').value) || 0;
            var c = parseFloat(document.getElementById('total_c').value) || 0;
            var nilaiTotal = a + b + c;
            document.getElementById('total_nilai').value = nilaiTotal.toFixed(1);
        }
    </script>
@endsection
