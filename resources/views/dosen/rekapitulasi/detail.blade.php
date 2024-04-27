@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/rekapitulasi"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil) ? $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas }}</P><br>
            <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun_ajaran }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Dosen Pembimbing: {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p><br>
            {{-- <p>Apakah skripsi membuat alat? {{ $pengajuanSkripsi->membuat_alat }}</p><br> --}}
            <p>Penguji:
                <br>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P>Tanggal sidang: {{ $pengajuanSkripsi->tanggal }}</P><br>
            <P>Status: {{ $pengajuanSkripsi->status }}</P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            @if ($pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi)
                <iframe src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
            @endif
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <p class="text-center text-lg font-bold mt-3 underline">Penilaian</p>
            <p>1. Nilai pembimbing ({{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}):
                <span
                    class="font-bold">{{ isset($pengajuanSkripsi->nilai_pembimbing) ? $pengajuanSkripsi->nilai_pembimbing : 'Belum melakukan penilaian' }}</span>
            </p>
            <p>2. Nilai penguji 1 ({{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}):
                <span
                    class="font-bold">{{ isset($pengajuanSkripsi->nilai1) ? $pengajuanSkripsi->nilai1 : 'Belum melakukan penilaian' }}</span>
            </p>
            <p>3. Nilai penguji 2 ({{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}):
                <span
                    class="font-bold">{{ isset($pengajuanSkripsi->nilai2) ? $pengajuanSkripsi->nilai2 : 'Belum melakukan penilaian' }}</span>
            </p>
            <p>4. Nilai penguji 3 ({{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}):
                <span
                    class="font-bold">{{ isset($pengajuanSkripsi->nilai3) ? $pengajuanSkripsi->nilai3 : 'Belum melakukan penilaian' }}</span>
            </p>
            <div class="text-center mt-5">
                <button id="terimaButton" type="button"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Nilai</button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-10 bottom-10 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="w-10 ml-auto mr-16 border-4 border-black">
                <p class="text-2xl font-semibold text-center">F8</p>
            </div>
            <div class="container w-3/4 mx-auto">
                <form method="POST" action="/dosen/rekapitulasi/{{ $pengajuanSkripsi->id }}">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Nilai Akhir</p>
                    <p>1. Nilai pembimbing ({{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }})</p>
                    <input type="number" id="nilaiPembimbing" name="nilai_pembimbing"
                        value="{{ isset($pengajuanSkripsi->nilai_pembimbing) ? $pengajuanSkripsi->nilai_pembimbing : 0 }}"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 mb-2">
                    <p>2. Nilai penguji 1 ({{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }})</p>
                    <input type="number" id="nilaiPenguji1" name="nilai1"
                        value="{{ isset($pengajuanSkripsi->nilai1) ? $pengajuanSkripsi->nilai1 : 0 }}"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 mb-2">
                    <p>3. Nilai penguji 2 ({{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }})</p>
                    <input type="number" id="nilaiPenguji2" name="nilai2"
                        value="{{ isset($pengajuanSkripsi->nilai2) ? $pengajuanSkripsi->nilai2 : 0 }}"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 mb-2">
                    <p>4. Nilai penguji 3 ({{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }})</p>
                    <input type="number" id="nilaiPenguji3" name="nilai3"
                        value="{{ isset($pengajuanSkripsi->nilai3) ? $pengajuanSkripsi->nilai3 : 0 }}"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                    <p class="mt-5 text-center mb-1 font-semibold text-sm underline underline-offset-8">(Nilai rata-rata
                        penguji
                        &times; 2) + Nilai
                        pembimbing</p>
                    <p class="text-sm text-center font-semibold">3</p>
                    <input id="nilaiTotal" name="nilai_total" type="text" readonly
                        class="border border-primary w-full rounded-md mt-5">
                    <div class="w-24 h-8 mx-auto mt-5">
                        <button type="submit"
                            class="bg-primary text-white w-full h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const terimaButton = document.getElementById('terimaButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        terimaButton.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });
        exitModal.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.toggle('hidden');
            }
        }

        function hitungNilaiTotal() {
            var nilaiPenguji1 = parseFloat(document.getElementById('nilaiPenguji1').value);
            var nilaiPenguji2 = parseFloat(document.getElementById('nilaiPenguji2').value);
            var nilaiPenguji3 = parseFloat(document.getElementById('nilaiPenguji3').value);
            var nilaiPembimbing = parseFloat(document.getElementById('nilaiPembimbing').value);
            var nilaiTotal = (((nilaiPenguji1 + nilaiPenguji2 + nilaiPenguji3) / 3 * 2) + nilaiPembimbing) / 3;
            document.getElementById('nilaiTotal').value = nilaiTotal.toFixed(1);
        }
        hitungNilaiTotal();

        document.getElementById('nilaiPembimbing').addEventListener('input', hitungNilaiTotal);
        document.getElementById('nilaiPenguji1').addEventListener('input', hitungNilaiTotal);
        document.getElementById('nilaiPenguji2').addEventListener('input', hitungNilaiTotal);
        document.getElementById('nilaiPenguji3').addEventListener('input', hitungNilaiTotal);
    </script>
@endsection
