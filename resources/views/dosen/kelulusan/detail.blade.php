@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        @error('revisi_alat')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/kelulusan"
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
            <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Dosen Pembimbing 1: {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p><br>
            <p>Dosen Pembimbing 2:
                {{ isset($pengajuanSkripsi->pengajuanSkripsiDospem2->nama) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
            </p><br>
            <p>Penguji:
                <br>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P>Tanggal sidang: {{ $pengajuanSkripsi->tanggal }}</P><br>
            <P>Status: {{ $pengajuanSkripsi->status }}</P><br>
            <p class="font-bold text-lg">Nilai akhir: {{ $pengajuanSkripsi->nilai_total }}</p>
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
        <div class="flex mt-10 w-1/2 mx-auto justify-evenly">
            <button id="lulusButton"
                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300">Luluskan</button>
            <form method="POST" action="/dosen/kelulusan/tolak/{{ $pengajuanSkripsi->id }}">
                @csrf
                <button type="submit"
                    class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Tolak sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Tolak</button>
            </form>
            <button id="revisiButton"
                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300">Revisi</button>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-7 bottom-7 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="w-12 font-semibold text-2xl border-4 text-center border-black ml-auto mr-20">F10</div>
            <div class="container w-3/4 mx-auto">
                <form method="POST" action="/dosen/kelulusan/revisi/{{ $pengajuanSkripsi->id }}">
                    @csrf
                    <p>Nama (NIM): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}
                        ({{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})</p>
                    <p>Program Studi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p>
                    <p>Judul: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p>
                    <p>Tanggal sidang: {{ $pengajuanSkripsi->tanggal }}</p>
                    <label for="pointA" class="font-bold">A. Revisi Alat/Program Aplikasi Skripsi</label>
                    <textarea id="pointA" name="revisi_alat" rows="5" class="w-full border-primary rounded-md border"></textarea>
                    <label for="pointB" class="font-bold">B. Revisi Laporan Skripsi</label>
                    <textarea id="pointB" name="revisi_laporan" rows="5" class="w-full border-primary rounded-md border"></textarea>
                    <div class="w-24 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md text-white hover:text-black hover:bg-red-300"
                            onclick="return confirm('Revisi sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal2" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-10 bottom-10 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal2" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="border-4 border-black w-10 ml-auto mr-20">
                <p class="font-semibold text-2xl text-center">F9</p>
            </div>
            <div class="container w-3/4 mx-auto">
                <form method="POST" action="/dosen/kelulusan/lulus/{{ $pengajuanSkripsi->id }}">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Apakah anda yakin untuk meluluskan?</p>
                    <p>Nama : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p><br>
                    <p>NIM : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p><br>
                    <p>Program studi : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</p><br>
                    <p>Judul : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</p><br>
                    <p>Nilai akhir : {{ $pengajuanSkripsi->nilai_total }}</p>
                    <div class="w-full h-8 mx-auto mt-10 flex justify-evenly">
                        <button type="submit"
                            class="bg-primary w-1/4 h-full rounded-md text-white hover:text-black hover:bg-red-300"
                            onclick="return confirm('Terima sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Luluskan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const revisiButton = document.getElementById('revisiButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        revisiButton.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });
        exitModal.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });

        const lulusButton = document.getElementById('lulusButton');
        const exitModal2 = document.getElementById('exitModal2');
        const modal2 = document.getElementById('modal2');

        lulusButton.addEventListener('click', function() {
            modal2.classList.toggle('hidden');
        });
        exitModal2.addEventListener('click', function() {
            modal2.classList.toggle('hidden');
        });

        // Ubah penanganan klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
            if (event.target == modal2) {
                modal2.classList.add('hidden');
            }
        });
    </script>
@endsection
