@extends('admin.template')

@section('content')
    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
            role="alert">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/admin/pengajuan/judul"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 p-[1px] rounded-md block text-center">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($pengajuanJudul->user->mahasiswa->photo_profil) ? $pengajuanJudul->user->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanJudul->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <form method="POST" action="/admin/pengajuan/judul/{{ $pengajuanJudul->id }}">
                @csrf
                <div class="h-1 bg-primary mx-auto"></div>
                <P>Email: {{ $pengajuanJudul->user->email }}</P><br>
                <P>NIM: {{ $pengajuanJudul->user->mahasiswa->nim }}</P><br>
                <P>Kelas: {{ $pengajuanJudul->user->mahasiswa->kelas->nama }}</P><br>
                <P>Prodi: {{ $pengajuanJudul->user->mahasiswa->prodi->nama }}</P><br>
                <P>Tahun Ajaran: {{ $pengajuanJudul->user->mahasiswa->tahun->nama }}</P><br>
                <P>Status: {{ $pengajuanJudul->user->mahasiswa->status }}</P><br>
                <P>No. Kontak Mahasiswa: {{ $pengajuanJudul->user->mahasiswa->no_kontak }}</P><br>
                <P>Nama Orang Tua/Wali: {{ $pengajuanJudul->user->mahasiswa->nama_ortu }}</P><br>
                <P>No. Kontak Orang Tua/Wali: {{ $pengajuanJudul->user->mahasiswa->no_kontak_ortu }}</P><br>
                <P>Nama Anggota Tim (Jika ada): {{ isset($pengajuanJudul->anggota) ? $pengajuanJudul->anggota : '' }}</P>
                <br>
                <P>Judul Skripsi: {{ $pengajuanJudul->judul }}</P><br>
                <p>Apakah judul dari dosen? {{ $pengajuanJudul->judul_dosen }}</p><br>
                <P>Sub Judul Skripsi (Jika ada): {{ isset($pengajuanJudul->sub_judul) ? $pengajuanJudul->sub_judul : '' }}
                </P>
                <br>
                <p>Abstrak/Ringkasan Skripsi: {{ $pengajuanJudul->abstrak }}</p><br>
                <p>Studi kasus: {{ $pengajuanJudul->studi_kasus }}</p><br>
                <p>Sumber referensi: {{ $pengajuanJudul->sumber_referensi }}</p><br>
                <p>Status: {{ $pengajuanJudul->status }}</p>
                <div class="mt-7 flex justify-evenly">
                    <button id="terimaButton" type="button"
                        class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Terima</button>
                    <button type="submit" name="action" value="tolak" onclick="confirmDelete(event)"
                        class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
                </div>
                {{-- Modal --}}
                <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                    <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                        <div class="w-7 ml-auto">
                            <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
                        </div>
                        <div class="container w-3/4 mx-auto my-3">
                            <p class="text-center mb-5 font-semibold text-xl">Pilih Dosen Pembimbing</p>
                            <p class="mb-3">Dosen Pilihan:
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($dosen_pilihan as $dospil)
                                    <br>{{ $i++ }}. {{ $dospil }}
                                @endforeach
                            </p>
                            <label for="dosen_pembimbing">Tentunkan Dosen Pembimbing</label>
                            <select name="dosen_pembimbing" id="dosen_pembimbing"
                                class="w-full rounded-md border border-primary mb-5">
                                @foreach ($dosenPembimbing as $dospem)
                                    <option value="{{ $dospem->nama }}">{{ $dospem->nama }}</option>
                                @endforeach
                            </select>
                            {{-- <label for="dosen_pembimbing2">Tentunkan Pembimbing 2
                                <span class="text-red-600">(opsional)</span>
                            </label>
                            <select name="dosen_pembimbing2" id="dosen_pembimbing2"
                                class="w-full rounded-md border border-primary">
                                <option value="">(Tidak memilih)</option>
                                @foreach ($dosenPembimbing as $dospem)
                                    <option value="{{ $dospem->nama }}">{{ $dospem->nama }}</option>
                                @endforeach
                            </select> --}}
                            <div class="w-24 h-8 mx-auto mt-7">
                                <button type="submit" name="action" value="terima"
                                    class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300 text-white">Terima</button>
                            </div>
                        </div>
                    </div>
            </form>
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

        function confirmDelete(event) {
            if (!confirm('Apakah yakin ingin menolak pengajuan?')) {
                event.preventDefault();
            }
        }
    </script>
@endsection
