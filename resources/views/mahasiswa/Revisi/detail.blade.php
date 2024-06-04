@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/mahasiswa/revisi"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-xl block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil ? $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">
                ({{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})
            </p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <p class="text-lg font-bold mt-5">A. Revisi Alat/Program Aplikasi Skripsi</p>
            <textarea readonly class="w-full border border-primary rounded-md" rows="7">
            {{ $pengajuanRevisi->revisi_alat }}
            </textarea>
            <p class="text-lg font-bold mt-5">B. Revisi Laporan Skripsi</p>
            <textarea readonly class="w-full border border-primary rounded-md" rows="7">
                {{ $pengajuanRevisi->revisi_laporan }}
                </textarea>
            <div class="h-1 bg-primary"></div>
        </div>

        @if (
            $pengajuanRevisi->keterangan_pembimbing &&
                $pengajuanRevisi->keterangan_penguji1 &&
                $pengajuanRevisi->keterangan_penguji2 &&
                $pengajuanRevisi->keterangan_penguji3)
            <div class="container w-1/2 mx-auto mt-6">
                <p class="font-bold text-xl text-center mt-5">Hasil Evaluasi Pembimbing & Penguji</p>
                <p class="font-semibold text-lg mt-5">1.
                    {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }} (Penguji 1)</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="3">
                {{ $pengajuanRevisi->keterangan_penguji1 }}
                </textarea>
                <p class="font-semibold text-lg mt-5">2.
                    {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }} (Penguji 2)</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="3">
                {{ $pengajuanRevisi->keterangan_penguji2 }}
                </textarea>
                <p class="font-semibold text-lg mt-5">3.
                    {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }} (Penguji 3)</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="3">
                {{ $pengajuanRevisi->keterangan_penguji3 }}
                 </textarea>
                <p class="font-semibold text-lg mt-5">4.
                    {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }} (Pembimbing)</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="3">
                {{ $pengajuanRevisi->keterangan_pembimbing }}
                </textarea>
                @if ($pengajuanRevisi->pengajuanSkripsi->dospem2_id)
                    <p class="font-semibold text-lg mt-5">5.
                        {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem2->nama }} (Pembimbing 2)</p>
                    <textarea readonly class="w-full border border-primary rounded-md" rows="3">
                    {{ $pengajuanRevisi->keterangan_pembimbing2 }}
                    </textarea>
                @endif
                <div class="h-1 bg-primary"></div>
            </div>
        @endif


        <div class="container mx-auto w-1/2 mt-6">
            <iframe
                src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                class="w-full h-[600px]"></iframe>
        </div>
        <div class="container mx-auto w-1/2 mt-10 flex">
            <button type="button" id="revisiButton"
                class="bg-primary text-white w-36 h-full rounded-md hover:text-black hover:bg-red-300 mx-auto">Konfirmasi
                revisi</button>
        </div>
    </div>


    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-52 bottom-52 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto">
                <form method="POST" action="/mahasiswa/revisi/{{ $pengajuanRevisi->id }}">
                    @csrf
                    <p class="text-center font-bold text-lg mb-5">Konfirmasi revisi</p>
                    <p class="mb-5">1. Pastikan skripsi sudah benar <a href="/mahasiswa/skripsi"
                            class="text-blue-500 underline">di sini</a>
                    </p>
                    <p class="mb-2">2. Masukkan link bukti revisi alat (Jika revisi)</p>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="link_revisi_alat" id="link_revisi_alat">
                    <div class="w-24 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300 text-white"
                            onclick="return confirm('Apakah revisi sudah diperbaiki dengan benar?')">Kirim</button>
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
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.toggle('hidden');
            }
        }
    </script>
@endsection
