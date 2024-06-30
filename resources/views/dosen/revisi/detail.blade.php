@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        @error('link_revisi_alat')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/revisi"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 text-center rounded-md">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil) ? $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">
                ({{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}
            </P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada): </span>
                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada): </span>
                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing 1:
                </span>{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p><br>
            <p><span class="font-bold">Dosen Pembimbing 2: </span>
                {{ isset($pengajuanRevisi->pengajuanSkripsi->dospem2_id) ? $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem2->nama : '-' }}
            </p><br>
            <p><span class="font-bold">Penguji: </span>
                <br>1. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanRevisi->pengajuanSkripsi->tanggal }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanRevisi->pengajuanSkripsi->status }}</P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <p class="font-bold text-xl text-center mt-5">Hasil Revisi</p>
            <p class="font-semibold text-lg mt-5">A. Revisi Alat/Program Aplikasi Skripsi</p>
            <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                {{ $pengajuanRevisi->revisi_alat }}
           </textarea>
            <p class="font-bold mt-1">Link revisi alat:
                <a href="{{ $pengajuanRevisi->link_revisi_alat }}" target="_blank"
                    class="text-blue-600 italic">{{ $pengajuanRevisi->link_revisi_alat }}</a>
            </p>
            <p class="font-semibold text-lg mt-5">B. Revisi Laporan Skripsi</p>
            <textarea readonly class="w-full border border-primary rounded-md" rows="10">
                {{ $pengajuanRevisi->revisi_laporan }}
           </textarea>
            <iframe
                src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                class="w-full h-[600px] mt-3"></iframe>
        </div>
        <form method="POST" action="/dosen/revisi/{{ $pengajuanRevisi->id }}">
            @csrf
            <div class="container w-1/2 mx-auto mt-10 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary text-white w-32 h-full rounded-md hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima revisi mahasiswa atas nama {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Terima</button>
                <button type="button" id="revisiButton"
                    class="bg-primary text-white w-32 h-full rounded-md hover:text-black hover:bg-red-300">Revisi
                    ulang</button>
            </div>

            {{-- Modal --}}
            <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                <div class="fixed bg-white top-52 bottom-52 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <p class="text-center font-bold text-lg mb-5">Masukkan keterangan revisi</p>
                        <textarea rows="4" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="keterangan_revisi" id="link_revisi_alat"></textarea>
                        <div class="w-32 h-8 mx-auto mt-4">
                            <button type="submit"
                                class="bg-primary w-full rounded-md hover:text-black hover:bg-red-300 text-white"
                                onclick="return confirm('Revisi ulang mahasiswa atas nama {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Revisi
                                ulang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.toggle('hidden');
            }
        }
    </script>
@endsection
