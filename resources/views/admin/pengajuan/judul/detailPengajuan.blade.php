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
            <a href="{{ route('adm.pengajuanJudul') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 p-[1px] rounded-md block text-center">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset($pengajuanJudul->user->mahasiswa->photo_profil) ? $pengajuanJudul->user->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanJudul->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanJudul->user->email }}</P><br>
            <P><span class="font-bold">NIM: </span>{{ $pengajuanJudul->user->mahasiswa->nim }}</P><br>
            <P><span class="font-bold">Kelas: </span>{{ $pengajuanJudul->user->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi: </span>{{ $pengajuanJudul->user->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran: </span>{{ $pengajuanJudul->user->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanJudul->user->mahasiswa->status }}</P><br>
            <P><span class="font-bold">No. Kontak Mahasiswa: </span>{{ $pengajuanJudul->user->mahasiswa->no_kontak }}
            </P>
            <br>
            <P><span class="font-bold">Nama Orang Tua/Wali: </span>{{ $pengajuanJudul->user->mahasiswa->nama_ortu }}
            </P>
            <br>
            <P><span class="font-bold">No. Kontak Orang
                    Tua/Wali: </span>{{ $pengajuanJudul->user->mahasiswa->no_kontak_ortu }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ isset($pengajuanJudul->anggota) ? $pengajuanJudul->anggota : '' }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi: </span>{{ $pengajuanJudul->judul }}</P><br>
            <p><span class="font-bold">Apakah judul dari dosen? </span>{{ $pengajuanJudul->judul_dosen }}</p><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ isset($pengajuanJudul->sub_judul) ? $pengajuanJudul->sub_judul : '' }}
            </P>
            <br>
            <p><span class="font-bold">Abstrak/Ringkasan Skripsi: </span>{{ $pengajuanJudul->abstrak }}</p><br>
            <p><span class="font-bold">Studi Kasus: </span>{{ $pengajuanJudul->studi_kasus }}</p><br>
            <p><span class="font-bold">Sumber Referensi: </span>{{ $pengajuanJudul->sumber_referensi }}</p><br>
            <p><span class="font-bold">Dosen Pilihan: </span>
                @php
                    $no = 1;
                    $dosen_pilihan = explode('- ', $pengajuanJudul->dosen_pilihan);
                @endphp
                @foreach ($dosen_pilihan as $dospil)
                    <br>{{ $no++ }}. {{ $dospil }}
                @endforeach
            </p><br>
            <p><span class="font-bold">Status: </span>{{ $pengajuanJudul->status }}</p>
            <div class="mt-7 flex justify-evenly">
                <button id="terimaButton" type="button"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Terima</button>
                <button id="tolakButton" type="button"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
            </div>
            {{-- Modal Terima --}}
            <form method="POST"
                action="{{ route('adm.terimaPengajuanJudul', ['pengajuanJudul' => $pengajuanJudul->id]) }}">
                @csrf
                <div id="modalTerima" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                    <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                        <div class="w-7 ml-auto">
                            <button type="button" id="exitModalTerima"
                                class="text-3xl font-extrabold text-slate-800">X</button>
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
                            <div class="w-24 h-8 mx-auto mt-7">
                                <button type="submit" name="action" value="terima"
                                    class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300 text-white">Terima</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- Modal Tolak --}}
            <form method="POST"
                action="{{ route('adm.terimaPengajuanJudul', ['pengajuanJudul' => $pengajuanJudul->id]) }}">
                @csrf
                <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                    <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                        <div class="w-7 ml-auto">
                            <button type="button" id="exitModalTolak"
                                class="text-3xl font-extrabold text-slate-800">X</button>
                        </div>
                        <div class="container w-1/2 mx-auto">
                            <div>
                                <p class="font-bold text-lg text-center mb-3">Penolakan Pengajuan Judul & Pembimbing</p>
                                <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                                <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                            </div>
                            <div class="w-24 h-8 mx-auto mt-5">
                                <button type="submit" name="action" value="tolak"
                                    onclick="return confirm('Apakah yakin ingin menolak pengajuan?')"
                                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const terimaButton = document.getElementById('terimaButton');
        const exitModalTerima = document.getElementById('exitModalTerima');
        const modalTerima = document.getElementById('modalTerima');

        terimaButton.addEventListener('click', function() {
            modalTerima.classList.toggle('hidden');
        });
        exitModalTerima.addEventListener('click', function() {
            modalTerima.classList.toggle('hidden');
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
        window.onclick = function(event) {
            if (event.target == modalTerima) {
                modalTerima.classList.toggle('hidden');
            }
            if (event.target == modalTolak) {
                modalTolak.classList.toggle('hidden');
            }
        }
    </script>
@endsection
