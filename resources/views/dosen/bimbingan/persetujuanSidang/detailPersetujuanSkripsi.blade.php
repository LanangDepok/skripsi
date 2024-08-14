@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.getAllPersetujuanSidang') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a>
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
            <P><span class="font-bold">Email: </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P>
            <br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas->nama }}</P>
            <br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi->nama }}</P>
            <br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun->nama }}</P>
            <br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P>
            <br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P>
            <br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Tanggal Pengajuan: </span>{{ $pengajuanSkripsi->created_at->format('d F Y') }}</p>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
            <br>
            <P>
                <span class="font-bold">Link Presentasi: </span>
                <a class="italic text-blue-400" target="_blank" href="{{ $pengajuanSkripsi->link_presentasi }}">
                    {{ $pengajuanSkripsi->link_presentasi }}
                </a>
            </P><br>
            <P>
                <span class="font-bold">Sertifikat Lomba: </span>
                <a class="italic text-blue-400" target="_blank" href="{{ $pengajuanSkripsi->sertifikat_lomba }}">
                    {{ $pengajuanSkripsi->sertifikat_lomba }}
                </a>
            </P><br>
            <P>
                <span class="font-bold">Bukti pengecekan plagiarisme: </span>
                <a class="italic text-blue-400" target="_blank" href="{{ $pengajuanSkripsi->turnitin }}">
                    {{ $pengajuanSkripsi->turnitin }}
                </a>
            </P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"
                    onclick="return confirm('Terima persetujuan sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')">Terima</button>
                <button id="tolakButton" type="button"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
            </div>
        </form>
        {{-- Modal Tolak --}}
        <form method="POST"
            action="{{ route('dsn.acceptPersetujuanSidangSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id]) }}">
            @csrf
            <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTolak" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <div>
                            <p class="font-bold text-lg text-center mb-3">Penolakan Mengikuti Sidang Skripsi</p>
                            <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                            <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                        </div>
                        <div class="w-24 h-8 mx-auto mt-5">
                            <button type="submit" name="tolak"
                                onclick="return confirm('Tolak persetujuan sidang skripsi atas nama {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}?')"
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
