@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ session('error') }}
            </div>
        @endif
        @if ($errors->has('penguji1_id'))
            @error('penguji1_id')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
        @elseif ($errors->has('penguji2_id'))
            @error('penguji2_id')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
        @elseif ($errors->has('penguji3_id'))
            @error('penguji3_id')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                    role="alert">
                    <span class="font-medium">Error!</span> {{ $message }}
                </div>
            @enderror
        @endif
        @error('tanggal')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                role="alert">
                <span class="font-medium">Error!</span> {{ $message }}
            </div>
        @enderror

        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('adm.pengajuanSempro') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a></button>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil ? $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->photo_profil : 'icons/user.png') }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->email }}</P><br>
            <P><span class="font-bold">Kelas:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->kelas->nama }}</P><br>
            <P><span class="font-bold">Program Studi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->prodi->nama }}</P><br>
            <P><span class="font-bold">Tahun Ajaran:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->tahun->nama }}</P><br>
            <P><span class="font-bold">Nama Anggota Tim (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->anggota }}</P><br>
            <P><span class="font-bold">Judul Skripsi:
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->judul }}</P><br>
            <P><span class="font-bold">Sub Judul Skripsi (Jika ada):
                </span>{{ $pengajuanSempro->pengajuanSemproMahasiswa->skripsi->sub_judul }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p>
            <br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSempro->status }}</P><br>
            <P>
                <span class="font-bold">Bukti Registrasi: </span>
                <a class="italic text-blue-400" href="{{ $pengajuanSempro->bukti_registrasi }}" target="_blank">
                    {{ $pengajuanSempro->bukti_registrasi }}</a>
            </P><br>
            <div class="h-1 bg-primary"></div>
        </div>
        <div class="mt-7 flex justify-evenly">
            <button id="terimaButton" type="button"
                class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Terima</button>
            <button id="tolakButton" type="button"
                class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
        </div>

        {{-- Modal Terima --}}
        <form method="POST"
            action="{{ route('adm.terimaPengajuanSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}}}">
            @csrf
            <div id="modalTerima" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                <div class="fixed bg-white top-28 bottom-28 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTerima"
                            class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <p class="text-center mb-5 font-semibold text-xl">Pilih Dosen Penguji</p>
                        <div>
                            <label for="penguji1_id">Dosen Pilihan 1 (Ketua Penguji)</label>
                            <select name="penguji1_id" id="penguji"_id class="w-full rounded-md border border-primary">
                                @foreach ($role_ketua->users as $ketuaPenguji)
                                    @if ($ketuaPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $ketuaPenguji->id }}">{{ $ketuaPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="penguji2_id">Dosen Pilihan 2</label>
                            <select name="penguji2_id" id="penguji"_id class="w-full rounded-md border border-primary">
                                @foreach ($role_penguji->users as $dosenPenguji)
                                    @if ($dosenPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $dosenPenguji->id }}">{{ $dosenPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="penguji3_id">Dosen Pilihan 2</label>
                            <select name="penguji3_id" id="penguji"_id class="w-full rounded-md border border-primary">
                                @foreach ($role_penguji->users as $dosenPenguji)
                                    @if ($dosenPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $dosenPenguji->id }}">{{ $dosenPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="tanggal">Pilih Tanggal Sidang</label>
                            <input name="tanggal" type="date" class="w-full rounded-md border border-primary">
                        </div>
                        <div class="w-24 h-8 mx-auto mt-10">
                            <button type="submit" name="terima" value="terima"
                                class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300 text-white">Terima</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Modal Tolak --}}
        <form method="POST"
            action="{{ route('adm.terimaPengajuanSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}}}">
            @csrf
            <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTolak" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <div>
                            <p class="font-bold text-lg text-center mb-3">Penolakan Pengajuan Seminar Proposal</p>
                            <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                            <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                        </div>
                        <div class="w-24 h-8 mx-auto mt-5">
                            <button type="submit" onclick="return confirm('Apakah yakin ingin menolak pengajuan?')"
                                class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
