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
            <a href="{{ route('dsn.getAllKelulusan') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset($pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil) ? $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P><span class="font-bold">kelas:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1: </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($pengajuanSkripsi->pengajuanSkripsiDospem2->nama) ? $pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
            </p><br>
            <p><span class="font-bold">Penguji: </span>
                <br>1. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSkripsi->tanggal }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSkripsi->status }}</P><br>
            <p class="font-bold text-lg"><span class="font-bold">Nilai Akhir: </span>{{ $pengajuanSkripsi->nilai_total }}
            </p>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="flex mt-10 w-1/2 mx-auto justify-evenly">
            {{-- <button id="lulusButton"
                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300">Luluskan</button> --}}
            <button type="button" id="tolakButton"
                class="bg-primary border rounded-md w-40 text-white hover:text-black hover:bg-red-300">Tidak
                lulus</button>
            <button id="revisiButton"
                class="bg-primary border rounded-md w-40 text-white hover:text-black hover:bg-red-300">Lulus dengan
                revisi</button>
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
                <form method="POST"
                    action="{{ route('dsn.revisiSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
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

    {{-- <div id="modal2" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-10 bottom-10 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal2" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="border-4 border-black w-10 ml-auto mr-20">
                <p class="font-semibold text-2xl text-center">F9</p>
            </div>
            <div class="container w-3/4 mx-auto">
                <form method="POST"
                    action="{{ route('dsn.luluskanSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Apakah anda yakin untuk meluluskan?</p>
                    <p>Nama : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p><br>
                    <p>NIM : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p><br>
                    <p>Program studi : {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p><br>
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
    </div> --}}

    {{-- Modal Tidak lulus --}}
    <form method="POST" action="{{ route('dsn.tolakSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
        @csrf
        <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
            <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                <div class="w-7 ml-auto">
                    <button type="button" id="exitModalTolak" class="text-3xl font-extrabold text-slate-800">X</button>
                </div>
                <div class="container w-1/2 mx-auto">
                    <div>
                        <p class="font-bold text-lg text-center mb-3">Penolakan Pengajuan Sidang Skripsi</p>
                        <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                        <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                    </div>
                    <div class="w-24 h-8 mx-auto mt-5">
                        <button type="submit"
                            onclick="return confirm('Tolak sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')"
                            class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
        const tolakButton = document.getElementById('tolakButton');
        const exitModalTolak = document.getElementById('exitModalTolak');
        const modalTolak = document.getElementById('modalTolak');

        tolakButton.addEventListener('click', function() {
            modalTolak.classList.toggle('hidden');
        });
        exitModalTolak.addEventListener('click', function() {
            modalTolak.classList.toggle('hidden');
        });

        // Ubah penanganan klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
            if (event.target == modalTolak) {
                modalTolak.classList.add('hidden');
            }
        });
    </script>
    {{-- <script>
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
    </script> --}}
@endsection
