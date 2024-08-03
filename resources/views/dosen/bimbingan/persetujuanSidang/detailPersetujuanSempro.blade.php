@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.getAllPersetujuanSidang') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset($pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil) ? $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P>
            <br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas->nama }}</P>
            <br>
            <P><span class="font-bold">Prodi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</P>
            <br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->anggota }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</P>
            <br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Metode: </span>{{ $pengajuanSempro->metode }}</p>
            <br>
            <p><span class="font-bold">Tanggal Pengajuan: </span>{{ $pengajuanSempro->created_at->format('d F Y') }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ Auth::user()->nama }}</p>
            <br>
            <P>
                <span class="font-bold">Bukti Registrasi: </span>
                <a class="italic text-blue-400" target="_blank" href="{{ $pengajuanSempro->bukti_registrasi }}">
                    {{ $pengajuanSempro->bukti_registrasi }}
                </a>
            </P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima persetujuan seminar proposal atas nama {{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}?')">Terima</button>
                <button id="tolakButton" type="button"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
            </div>
        </form>
        {{-- Modal Tolak --}}
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}">
            @csrf
            <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTolak" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <div>
                            <p class="font-bold text-lg text-center mb-3">Penolakan Mengikuti Seminar Proposal</p>
                            <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                            <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                        </div>
                        <div class="w-24 h-8 mx-auto mt-5">
                            <button type="submit" name="tolak"
                                onclick="return confirm('Tolak persetujuan seminar proposal atas nama {{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}?')"
                                class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
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
            if (event.target == modalTolak) {
                modalTolak.classList.toggle('hidden');
            }
        }
    </script>
@endsection
