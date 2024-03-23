@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Nilai Sidang Skripsi</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    <div class="w-10 ml-auto border-4 border-black">
                        <p class="text-2xl font-semibold text-center">F7</p>
                    </div>
                    <div class="text-left mb-4">
                        <p>Nama: Bagas Rizkiyanto</p>
                    </div>
                    <div class="text-left mb-4">
                        <p>NIM: 2007412006</p>
                    </div>
                    <div class="text-left mb-4">
                        <p>Judul: Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque amet fuga, ducimus
                            doloribus assumenda asperiores, cupiditate, reiciendis accusantium unde obcaecati ipsa minima id
                            vero suscipit provident. Rem cupiditate neque quidem dolores. Expedita ea soluta qui.</p>
                    </div>
                    <div class="text-left mb-4">
                        <p class="font-bold text-lg">A. TATA TULIS LAPORAN</p>
                    </div>
                    <div class="text-left mb-4">
                        <p>Kesesuaian dengan sistematika penulisan <span class="text-red-700 font-semibold">(Nilai:
                                4,5 - 10)</span></p>
                        <input type="number" step="0.1" id="a1"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Kesesuaian dengan isi laporan <span class="text-red-700 font-semibold">(Nilai: 4,5 - 15)</span>
                        </p>
                        <input type="number" step="0.1" id="a2"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Sesuai dengan format penulisan <span class="text-red-700 font-semibold">(Nilai: 4,5 - 10)</span>
                        </p>
                        <input type="number" step="0.1" id="a3"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p class="text-red-700 font-bold">Nilai Total poin A (A1 + A2 + A3)</p>
                        <input type="number" step="0.1" id="total_a"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            disabled>
                    </div>
                    <div class="text-left mb-4">
                        <p class="font-bold text-lg">B. KETERAMPILAN</p>
                    </div>
                    <div class="text-left mb-4">
                        <p>Perancangan alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 5,5 -
                                15)</span></p>
                        <input type="number" step="0.1" id="b1"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Pembangunan alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 5,5 -
                                15)</span></p>
                        <input type="number" step="0.1" id="b2"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Pengsidang alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 5,5 -
                                10)</span></p>
                        <input type="number" step="0.1" id="b3"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Pengoperasian alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 5,5
                                - 10)</span></p>
                        <input type="number" step="0.1" id="b4"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p>Penyajian alat/program aplikasi <span class="text-red-700 font-semibold">(Nilai: 5,5 -
                                15)</span></p>
                        <input type="number" step="0.1" id="b5"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    </div>
                    <div class="text-left mb-4">
                        <p class="text-red-700 font-bold">Nilai Total poin B (B1 + B2 + B3 + B4 + B5)</p>
                        <input type="number" step="0.1" id="total_b"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            disabled>
                    </div>
                    <div class="text-left mb-4">
                        <p class="font-bold text-lg">Nilai Total</p>
                        <input type="text" id="total_nilai"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            disabled>
                    </div>
                    <div class="flex justify-evenly">
                        <div class="text-center mt-12">
                            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white"><a
                                    href="/dosen/pengujian/skripsi">Back</a></button>
                        </div>
                        <div class="text-center mt-12">
                            <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Nilai</button>
                        </div>
                    </div>
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
            var b5 = parseFloat(document.getElementById('b5').value) || 0;
            var nilaiTotal_B = b1 + b2 + b3 + b4 + b5;
            document.getElementById('total_b').value = nilaiTotal_B.toFixed(1);
            hitungNilaiTotal();
        }

        document.getElementById('b1').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b2').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b3').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b4').addEventListener('input', hitungNilaiTotal_B);
        document.getElementById('b5').addEventListener('input', hitungNilaiTotal_B);

        //hitung total A+B
        function hitungNilaiTotal() {
            var a = parseFloat(document.getElementById('total_a').value) || 0;
            var b = parseFloat(document.getElementById('total_b').value) || 0;
            var nilaiTotal = a + b;
            document.getElementById('total_nilai').value = nilaiTotal.toFixed(1);
        }
    </script>
@endsection
