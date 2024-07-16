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
            <a href="{{ route('adm.getAllJudul') }}"
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
