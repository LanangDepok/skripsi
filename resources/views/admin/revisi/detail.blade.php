@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        @error('link_revisi_alat')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror
        <div class="flex w-1/2 mx-auto">
            <a href="/admin/revisi"
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
            <P>Email: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P><br>
            <P>Kelas: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P>Prodi: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P>Tahun Ajaran: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}
            </P><br>
            <P>Nama Anggota Tim (Jika ada):
                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P><br>
            <P>Judul Skripsi: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P><br>
            <P>Sub Judul Skripsi (Jika ada):
                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p>Dosen Pembimbing: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p><br>
            <p>Penguji:
                <br>1. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}
                <br>2. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}
                <br>3. {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}
            </p><br>
            <P>Tanggal sidang: {{ $pengajuanRevisi->pengajuanSkripsi->tanggal }}</P><br>
            <P>Status: {{ $pengajuanRevisi->pengajuanSkripsi->status }}</P><br>
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
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary"></div>
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
                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }} (Pembimbing 1)</p>
            <textarea readonly class="w-full border border-primary rounded-md" rows="3">
            {{ $pengajuanRevisi->keterangan_pembimbing }}
            </textarea>
            @if ($pengajuanRevisi->pengajuanSkripsi->dospem2_id)
                <p class="font-semibold text-lg mt-5">5.
                    {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem2->nama }} (Pembimbing 2)</p>
                <textarea readonly class="w-full border border-primary rounded-md" rows="3">
            {{ isset($pengajuanRevisi->pengajuanSkripsi->dospem2_id) ? $pengajuanRevisi->keterangan_pembimbing2 : '(Tidak ada pembimbing 2)' }}
            </textarea>
            @endif
        </div>

        @can('komite')
            <form method="POST" action="/admin/revisi/{{ $pengajuanRevisi->id }}">
                @csrf
                <div class="container w-1/2 mx-auto mt-10 flex justify-around">
                    <button type="button" id="terimaButton"
                        class="bg-primary text-white w-32 h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
                    @if (
                        $pengajuanRevisi->terima_pembimbing != 'Ya' ||
                            ($pengajuanRevisi->pengajuanSkripsi->dospem2_id != null && $pengajuanRevisi->terima_pembimbing2 != 'Ya') ||
                            $pengajuanRevisi->terima_penguji1 != 'Ya' ||
                            $pengajuanRevisi->terima_penguji2 != 'Ya' ||
                            $pengajuanRevisi->terima_penguji3 != 'Ya')
                        <button type="submit" name="revisi" value="revisi"
                            class="bg-primary text-white w-32 h-full rounded-md hover:text-black hover:bg-red-300"
                            onclick="return confirm('Yakin ingin merevisi ulang skripsi atas nama {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Revisi
                            ulang</button>
                        <button type="button" name="tolak" value="tolak"
                            class="bg-primary text-white w-32 h-full rounded-md hover:text-black hover:bg-red-300"
                            onclick="return confirm('Yakin ingin menolak skripsi atas nama {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Tolak</button>
                    @endif
                </div>

                {{-- Modal --}}
                <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                    <div class="fixed bg-white top-7 bottom-7 left-96 right-96 z-10 rounded-lg">
                        <div class="w-7 ml-auto">
                            <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
                        </div>
                        <div class="w-10 border-4 border-black text-center mr-20 ml-auto font-semibold 2xl:">F11</div>
                        <div class="container w-3/4 mx-auto">
                            <p>Nama (NIM): {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}
                                ({{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }})</p>
                            <p>Program Studi:
                                {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</p>
                            <p>Judul: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}
                            </p>
                            <p>Tanggal sidang: {{ $pengajuanRevisi->pengajuanSkripsi->tanggal }}</p>
                            <div class="flex justify-between mt-5 items-center">
                                <p>Penguji 1 : {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->nama }}</p>
                                @if ($pengajuanRevisi->terima_penguji1 == 'Ya')
                                    <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji1->dosen->tanda_tangan }}"
                                        class="max-w-16 max-h-12">
                                @else
                                    <p>(Revisi lagi)</p>
                                @endif
                            </div>
                            <div class="flex justify-between mt-5 items-center">
                                <p>Penguji 2 : {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->nama }}</p>
                                @if ($pengajuanRevisi->terima_penguji2 == 'Ya')
                                    <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji2->dosen->tanda_tangan }}"
                                        class="max-w-16 max-h-12">
                                @else
                                    <p>(Revisi lagi)</p>
                                @endif
                            </div>
                            <div class="flex justify-between mt-5 items-center">
                                <p>Penguji 3: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->nama }}</p>
                                @if ($pengajuanRevisi->terima_penguji3 == 'Ya')
                                    <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiPenguji3->dosen->tanda_tangan }}"
                                        class="max-w-16 max-h-12">
                                @else
                                    <p>(Revisi lagi)</p>
                                @endif
                            </div>
                            <div class="flex justify-between mt-5 items-center">
                                <p>Pembimbing 1: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
                                @if ($pengajuanRevisi->terima_pembimbing == 'Ya')
                                    <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem->dosen->tanda_tangan }}"
                                        class="max-w-16 max-h-12">
                                @else
                                    <p>(Revisi lagi)</p>
                                @endif
                            </div>
                            @if ($pengajuanRevisi->pengajuanSkripsi->dospem2_id)
                                <div class="flex justify-between mt-5 items-center">
                                    <p>Pembimbing 2: {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem2->nama }}
                                    </p>
                                    @if ($pengajuanRevisi->terima_pembimbing2 == 'Ya')
                                        <img src="/storage/{{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiDospem2->dosen->tanda_tangan }}"
                                            class="max-w-16 max-h-12">
                                    @else
                                        <p>(Revisi lagi)</p>
                                    @endif
                                </div>
                            @endif
                            <div class="w-32 h-8 mx-auto mt-7">
                                <button type="submit" name="terima" value="terima"
                                    class="bg-primary w-full h-full rounded-md text-white hover:text-black hover:bg-red-300"
                                    onclick="return confirm('Yakin ingin menerima revisi atas nama {{ $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Terima
                                    Revisi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endcan
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
    </script>
@endsection
