@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center mt-6">
            <div class="container w-2/5">
                <h2 class="text-primary text-2xl font-semibold text-center">Nilai Seminar Proposal</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 pt-5 rounded-lg shadow-slate-400 shadow-lg">
                    <form method="POST" action="/dosen/pengujian/sempro/{{ $pengajuanSempro->id }}">
                        @csrf
                        <div class="container w-1/12 ml-auto border-4 text-center text-2xl border-black font-semibold">F2
                        </div>
                        <div class="text-left mb-4">
                            <p>Nama: {{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>NIM: {{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <p>Judul: {{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</p>
                        </div>
                        <div class="text-left mb-4">
                            <label for="kriteria1">Orientasi Permasalahan dan Pustaka (Latar Belakang, Perumusan Masalah,
                                Batasan Masalah, Tujuan dan Manfaat); <span class="text-red-700 font-semibold">Bobot: 25
                                    *</span></label>
                            <input type="number" step="0.1"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="kriteria1" id="kriteria1" value="{{ old('kriteria1') }}">
                            @error('kriteria1')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <label for="kriteria2">Pola Penyelesaian Masalah (Metode Pelaksanaan Skripsi); <span
                                    class="text-red-700 font-semibold">Bobot: 25 *</span></label>
                            <input type="number" step="0.1"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="kriteria2" id="kriteria2" value="{{ old('kriteria2') }}">
                            @error('kriteria2')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <label for="kriteria3">Manfaat Hasil (Manfaat); <span class="text-red-700 font-semibold">Bobot:
                                    25
                                    *</span></label>
                            <input type="number" step="0.1"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="kriteria3" id="kriteria3" value="{{ old('kriteria3') }}">
                            @error('kriteria3')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <label for="kriteria4">Fisibilitas Sumber Daya (Jadwal Pelaksanaan, Personalia Skripsi,
                                Perkiraan
                                Biaya); <span class="text-red-700 font-semibold">Bobot: 15 *</span></label>
                            <input type="number" step="0.1"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="kriteria4" id="kriteria4" value="{{ old('kriteria4') }}">
                            @error('kriteria4')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <label for="kriteria5">Kebahasanaan (Bahasa Proposal, Daftar Pustaka); <span
                                    class="text-red-700 font-semibold">Bobot: 10 *</span></label>
                            <input type="number" step="0.1"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="kriteria5" id="kriteria5" value="{{ old('kriteria5') }}">
                            @error('kriteria5')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">Error!</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-left mb-4">
                            <label for="nilai_total" class="text-red-700 font-bold">Nilai Total</label>
                            <input type="text"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                                name="nilai" id="nilai_total" readonly>
                        </div>
                        <div class="text-left mb-4">
                            <li>Masing-masing kriteria diberi <span class="text-red-700 font-bold">skor 1,2,4, dan 5</span>
                                (1=sangat
                                kurang, 2=kurang, 4=baik, 5=sangat
                                baik) yang mencerminkan skor seluruh butir yang dinilai dalam masing-masing kriteria.</li>
                            <li>Nilai = Skor x Bobot; Nilai Total = N1+N2+N3+N4+N5</li>
                            <li>Hasil Penilaian : Nilai <span class="text-red-700 font-bold">Total ≥ 400 ( Diterima )</span>
                                ;
                                Nilai <span class="text-red-700 font-bold">Total < 400 ( Ditolak )</span>
                            </li>
                        </div>
                        <div class="text-left mb-4">
                            <label for="keterangan">Keterangan Tambahan</label>
                            <textarea id="keterangan" name="keterangan"
                                class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100" rows="5"></textarea>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="text-center mt-12">
                                <a href="/dosen/pengujian/sempro"
                                    class="bg-primary w-24 rounded-md hover:bg-red-300 text-white block">Back</a>
                            </div>
                            <div class="text-center mt-12">
                                <button class="bg-primary w-24 rounded-md hover:bg-red-300 text-white">Nilai</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menghitung nilai total
        function hitungNilaiTotal() {
            // Ambil nilai dari setiap input kriteria
            var kriteria1 = parseFloat(document.getElementById('kriteria1').value) || 0;
            var kriteria2 = parseFloat(document.getElementById('kriteria2').value) || 0;
            var kriteria3 = parseFloat(document.getElementById('kriteria3').value) || 0;
            var kriteria4 = parseFloat(document.getElementById('kriteria4').value) || 0;
            var kriteria5 = parseFloat(document.getElementById('kriteria5').value) || 0;

            // Hitung nilai total
            var nilaiTotal = (kriteria1 * 25) + (kriteria2 * 25) + (kriteria3 * 25) + (kriteria4 * 15) + (kriteria5 * 10);

            // Masukkan nilai total ke dalam input nilai_total
            document.getElementById('nilai_total').value = nilaiTotal;
        }

        // Panggil fungsi hitungNilaiTotal setiap kali nilai pada input kriteria berubah
        document.getElementById('kriteria1').addEventListener('input', hitungNilaiTotal);
        document.getElementById('kriteria2').addEventListener('input', hitungNilaiTotal);
        document.getElementById('kriteria3').addEventListener('input', hitungNilaiTotal);
        document.getElementById('kriteria4').addEventListener('input', hitungNilaiTotal);
        document.getElementById('kriteria5').addEventListener('input', hitungNilaiTotal);
    </script>
@endsection
