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
            <a href="{{ route('adm.getAllSempro') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md block text-center">Back</a>
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
            <P><span class="font-bold">Metode:
                </span>{{ $pengajuanSempro->metode }}</P>
            <br>
            <P><span class="font-bold">Bukti Registrasi:
                </span>{{ $pengajuanSempro->bukti_registrasi }}</P>
            <br>
            <p><span class="font-bold">Dosen Pembimbing: </span>{{ $pengajuanSempro->pengajuanSemproDospem->nama }}</p><br>
            <p><span class="font-bold">Penguji 1</span>
                <br>1. {{ $pengajuanSempro->pengajuanSemproPenguji1->nama }}
                <br>2. {{ $pengajuanSempro->pengajuanSemproPenguji2->nama }}
                <br>3. {{ $pengajuanSempro->pengajuanSemproPenguji3->nama }}
            </p><br>
            <P><span class="font-bold">Tanggal Sidang: </span>{{ $pengajuanSempro->tanggal }}</P><br>
            <P><span class="font-bold">Status: </span>{{ $pengajuanSempro->status }}</P><br>
            <P><span class="font-bold">Nilai: </span>{{ $pengajuanSempro->nilai }}</P><br>
            <P><span class="font-bold">Keterangan: </span></P><br>
            <textarea cols="50" rows="5" readonly>{{ $pengajuanSempro->keterangan }}</textarea>
            <div class="h-1 bg-primary"></div>
        </div>
        {{-- @if ($pengajuanSempro->status == 'Menunggu sidang') --}}
        <div class="container mx-auto w-1/2 mt-6 flex justify-around">
            <button type="button" id="terimaButton"
                class="bg-primary border rounded-md w-64 text-white hover:text-black hover:bg-red-300">Ganti jadwal
                & dosen penguji</button>
        </div>
        {{-- @endif --}}

        {{-- Modal --}}
        <form method="POST"
            action="{{ route('adm.terimaPengajuanSempro', ['pengajuanSempro' => $pengajuanSempro->id]) }}}}">
            @csrf
            <div id="modalTerima" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                <div class="fixed bg-white top-16 bottom-16 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTerima"
                            class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <p class="text-center mb-5 font-semibold text-xl">Pilih Dosen Penguji</p>
                        <div class="mt-3">
                            <label for="penguji1_id">Dosen Pilihan 1 (Ketua Penguji)</label>
                            <select name="penguji1_id" id="dosen_pembimbing"
                                class="w-full rounded-md border border-primary">
                                @foreach ($role_ketua->users as $ketuaPenguji)
                                    @if ($ketuaPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $ketuaPenguji->id }}">{{ $ketuaPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="penguji2_id">Dosen Pilihan 2</label>
                            <select name="penguji2_id" id="dosen_pembimbing"
                                class="w-full rounded-md border border-primary">
                                @foreach ($role_penguji->users as $dosenPenguji)
                                    @if ($dosenPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $dosenPenguji->id }}">{{ $dosenPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="penguji3_id">Dosen Pilihan 3</label>
                            <select name="penguji3_id" id="dosen_pembimbing"
                                class="w-full rounded-md border border-primary">
                                @foreach ($role_penguji->users as $dosenPenguji)
                                    @if ($dosenPenguji->id != $pengajuanSempro->dospem_id)
                                        <option value="{{ $dosenPenguji->id }}">{{ $dosenPenguji->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="tanggal">Pilih Tanggal Sidang</label>
                            <input id="tanggal" name="tanggal" type="date"
                                class="w-full rounded-md border border-primary">
                        </div>
                        <div class="w-64 h-8 mx-auto mt-5">
                            <button type="submit" name="terima" value="terima"
                                class="bg-primary text-white w-full h-full rounded-md hover:text-black hover:bg-red-300"
                                onclick="return confirm('Apakah yakin ingin mengubah jadwal & penguji?')">Ganti jadwal
                                & dosen penguji</button>
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
        window.onclick = function(event) {
            if (event.target == modalTerima) {
                modalTerima.classList.toggle('hidden');
            }
        }
    </script>
@endsection
