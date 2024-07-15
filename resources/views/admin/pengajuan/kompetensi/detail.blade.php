@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        @error('penguji1_id')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror
        <form method="POST"
            action="{{ route('adm.terimaPengajuanKompetensi', ['pengajuanKompetensi' => $pengajuanKompetensi->id]) }}">
            @csrf
            <div class="flex w-1/2 mx-auto">
                <a href="{{ route('adm.pengajuanKompetensi') }}"
                    class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . (isset($pengajuanKompetensi->user->mahasiswa->photo_profil) ? $pengajuanKompetensi->user->mahasiswa->photo_profil : 'icons/user.png')) }}"
                    class="w-36 h-36 rounded-full">
            </div>
            <div class="text-center mt-6">
                <p class="font-semibold text-lg">{{ $pengajuanKompetensi->user->nama }}</p>
                <p class="font-semibold text-lg">{{ $pengajuanKompetensi->user->mahasiswa->nim }}</p>
            </div>
            <div class="container w-1/2 mx-auto mt-6">
                <div class="h-1 bg-primary mx-auto"></div>
                <P><span class="font-bold">Email: </span>{{ $pengajuanKompetensi->user->email }}</P>
                <br>
                <P><span class="font-bold">Kelas: </span>{{ $pengajuanKompetensi->user->mahasiswa->kelas->nama }}</P>
                <br>
                <P><span class="font-bold">Program Studi: </span>{{ $pengajuanKompetensi->user->mahasiswa->prodi->nama }}
                </P>
                <br>
                <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanKompetensi->user->mahasiswa->tahun->nama }}</P>
                <br>
                <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                    </span>{{ $pengajuanKompetensi->user->skripsi->anggota }}
                </P>
                <br>
                <P><span class="font-bold">Judul Skripsi: </span>{{ $pengajuanKompetensi->user->skripsi->judul }}</P>
                <br>
                <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                    </span>{{ $pengajuanKompetensi->user->skripsi->sub_judul }}</P>
                <br>
                <p><span class="font-bold">Dosen Pembimbing 1:
                    </span>{{ $pengajuanKompetensi->user->bimbinganMahasiswa->bimbinganDosen->nama }}</p>
                <br>
                <p><span class="font-bold">Dosen Pembimbing 2: </span>
                    {{ isset($pengajuanKompetensi->user->bimbinganMahasiswa->dosen2_id) ? $pengajuanKompetensi->user->bimbinganMahasiswa->bimbinganDosen2->nama : '-' }}
                </p>
                <br>
                <p><span class="font-bold">Status Pengajuan: </span>{{ $pengajuanKompetensi->status }}</p><br>
                <p><span class="font-bold">kompetensi: </span></p>
                <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->kompetensi }}</textarea><br>
                <p><span class="font-bold">Bukti Kompetensi: </span>{{ $pengajuanKompetensi->bukti_kompetensi }}</p><br>
                <p><span class="font-bold">Keterangan: </span></p>
                <textarea class="w-full" rows="5" readonly>{{ $pengajuanKompetensi->keterangan }}</textarea><br>
                <div class="h-1 bg-primary"></div>
            </div>
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima pengajuan kompetensi atas nama {{ $pengajuanKompetensi->user->nama }}?')">Terima</button>
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
                                onclick="return confirm('Tolak pengajuan kompetensi atas nama {{ $pengajuanKompetensi->user->nama }}?')">Tolak</button>
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
