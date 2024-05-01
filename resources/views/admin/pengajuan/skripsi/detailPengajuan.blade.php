@extends('admin.template')

@section('content')
    <div class="container mx-auto">
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
        <form method="POST" action="/admin/pengajuan/skripsi/{{ $pengajuanSkripsi->id }}">
            @csrf
            <div class="flex w-1/2 mx-auto">
                <a href="/admin/pengajuan/skripsi"
                    class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 rounded-md text-center">Back</a></button>
            </div>
            <div class="flex justify-center">
                <img src="/storage/{{ isset($pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil) ? $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                    class="w-36 h-36 rounded-full">
            </div>
            <div class="text-center mt-6">
                <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->nama }}</p>
                <p class="font-semibold text-lg">{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->nim }}</p>
            </div>
            <div class="container w-1/2 mx-auto mt-6">
                <div class="h-1 bg-primary mx-auto"></div>
                <P>Email: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->email }}</P>
                <br>
                <P>Kelas: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->kelas }}</P>
                <br>
                <P>Prodi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->prodi }}</P>
                <br>
                <P>Tahun Ajaran: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->tahun_ajaran }}</P>
                <br>
                <P>Nama Anggota Tim (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->anggota }}</P>
                <br>
                <P>Judul Skripsi: {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->judul }}</P>
                <br>
                <P>Sub Judul Skripsi (Jika ada): {{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->sub_judul }}</P>
                <br>
                <p>Tanggal pengajuan: {{ $pengajuanSkripsi->created_at->format('d F Y') }}</p>
                <br>
                {{-- <p>Apakah skripsinya membuat alat? {{ $pengajuanSkripsi->membuat_alat }}</p>
                <br> --}}
                <p>Dosen Pembimbing: {{ $pengajuanSkripsi->pengajuanSkripsiDospem->nama }}</p>
                <br>
                <P>
                    Link presentasi:
                    <a class="italic text-blue-400" href="{{ $pengajuanSkripsi->link_presentasi }}">
                        {{ $pengajuanSkripsi->link_presentasi }}
                    </a>
                </P><br>
                <P>
                    Sertifikat lomba:
                    <a class="italic text-blue-400" href="{{ $pengajuanSkripsi->sertifikat_lomba }}">
                        {{ $pengajuanSkripsi->sertifikat_lomba }}
                    </a>
                </P><br>
                <div class="h-1 bg-primary"></div>
            </div>
            <div class="container mx-auto w-1/2 mt-6">
                @if ($pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi != null)
                    <iframe src="/storage/{{ $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->file_skripsi }}"
                        class="w-full h-[600px]"></iframe>
                @else
                    <p class="text-center text-xl font-semibold">Mahasiswa belum mengupload file skripsi</p>
                @endif
            </div>
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="button" id="terimaButton"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Terima</button>
                <button type="submit" name="tolak" onclick="confirmDelete(event)"
                    class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Tolak</button>
            </div>

            {{-- Modal --}}
            <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
                <div class="fixed bg-white top-28 bottom-28 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <p class="text-center mb-5 font-semibold text-xl">Pilih Dosen Penguji</p>
                        <div>
                            <label for="penguji1_id">Dosen Pilihan 1 (Ketua Penguji)</label>
                            <select name="penguji1_id" id="dosen_pembimbing"
                                class="w-full rounded-md border border-primary">
                                @foreach ($role_ketua->users as $ketuaPenguji)
                                    @if ($ketuaPenguji->id != $pengajuanSkripsi->dospem_id)
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
                                    @if ($dosenPenguji->id != $pengajuanSkripsi->dospem_id)
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
                                    @if ($dosenPenguji->id != $pengajuanSkripsi->dospem_id)
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
                        <div class="w-24 h-8 mx-auto mt-10">
                            <button type="submit" name="terima" value="terima"
                                class="bg-primary text-white w-full h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <script>
        function confirmDelete(event) {
            if (!confirm('Apakah yakin ingin menolak pengajuan?')) {
                event.preventDefault();
            }
        }
    </script>
@endsection
