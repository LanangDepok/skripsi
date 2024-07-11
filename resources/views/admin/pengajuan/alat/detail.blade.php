@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        @error('penguji1_id')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror
        <form method="POST" action="{{ route('adm.terimaPengajuanAlat', ['pengajuanAlat' => $pengajuanAlat->id]) }}">
            @csrf
            <div class="flex w-1/2 mx-auto">
                <a href="route('adm.pengajuanAlat')"
                    class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . (isset($pengajuanAlat->user->mahasiswa->photo_profil) ? $pengajuanAlat->user->mahasiswa->photo_profil : 'icons/user.png')) }}"
                    class="w-36 h-36 rounded-full">
            </div>
            <div class="text-center mt-6">
                <p class="font-semibold text-lg">{{ $pengajuanAlat->user->nama }}</p>
                <p class="font-semibold text-lg">{{ $pengajuanAlat->user->mahasiswa->nim }}</p>
            </div>
            <div class="container w-1/2 mx-auto mt-6">
                <div class="h-1 bg-primary mx-auto"></div>
                <P><span class="font-bold">Email: </span>{{ $pengajuanAlat->user->email }}</P>
                <br>
                <P><span class="font-bold">Kelas: </span>{{ $pengajuanAlat->user->mahasiswa->kelas->nama }}</P>
                <br>
                <P><span class="font-bold">Program Studi: </span>{{ $pengajuanAlat->user->mahasiswa->prodi->nama }}</P>
                <br>
                <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanAlat->user->mahasiswa->tahun->nama }}</P>
                <br>
                <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                    </span>{{ $pengajuanAlat->user->skripsi->anggota }}
                </P>
                <br>
                <P><span class="font-bold">Judul Skripsi: </span>{{ $pengajuanAlat->user->skripsi->judul }}</P>
                <br>
                <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                    </span>{{ $pengajuanAlat->user->skripsi->sub_judul }}</P>
                <br>
                <p><span class="font-bold">Dosen Pembimbing 1:
                    </span>{{ $pengajuanAlat->user->bimbinganMahasiswa->bimbinganDosen->nama }}</p>
                <br>
                <p><span class="font-bold">Dosen Pembimbing 2: </span>
                    {{ isset($pengajuanAlat->user->bimbinganMahasiswa->dosen2_id) ? $pengajuanAlat->user->bimbinganMahasiswa->bimbinganDosen2->nama : '-' }}
                </p>
                <br>
                <P>
                    <span class="font-bold">Form F12: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->f12 }}">
                        {{ $pengajuanAlat->f12 }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Form F13: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->f13 }}">
                        {{ $pengajuanAlat->f13 }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Form F14: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->f14 }}">
                        {{ $pengajuanAlat->f14 }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Sertifikat kompetensi Bahasa Inggris TOEIC yang masih berlaku: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->sertifikat_toeic }}">
                        {{ $pengajuanAlat->sertifikat_toeic }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Sertifikat Aktivitas Prestasi dan Penghargaan: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->sertifikat_prestasi }}">
                        {{ $pengajuanAlat->sertifikat_prestasi }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Sertifikat Pendidikan Karakter (ESQ,PKKP,DLL): </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->sertifikat_pkkp }}">
                        {{ $pengajuanAlat->sertifikat_pkkp }}
                    </a>
                </P><br>
                <P>
                    <span class="font-bold">Sertifikat Pengalaman Berorganisasi: </span>
                    <a class="italic text-blue-400" href="{{ $pengajuanAlat->sertifikat_organisasi }}">
                        {{ $pengajuanAlat->sertifikat_organisasi }}
                    </a>
                </P><br>
                <div class="h-1 bg-primary"></div>
            </div>
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima pengajuan skripsi dan alat atas nama {{ $pengajuanAlat->user->nama }}?')">Terima</button>
                <button type="button" id="tolakButton"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
            </div>

            {{-- Modal --}}
            <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                <div class="fixed bg-white top-52 bottom-52 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <div>
                            <p class="font-bold text-lg text-center mb-3">Penolakan Revisi</p>
                            <label for="keterangan">Masukkan keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="w-full"></textarea>
                        </div>
                        <div class="w-24 h-8 mx-auto mt-5">
                            <button type="submit" name="tolak" value="tolak"
                                class="bg-primary text-white w-full h-full rounded-md hover:text-black hover:bg-red-300"
                                onclick="return confirm('Tolak pengajuan skripsi dan alat atas nama {{ $pengajuanAlat->user->nama }}?')">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const tolakButton = document.getElementById('tolakButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        tolakButton.addEventListener('click', function() {
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
    </script>
@endsection
