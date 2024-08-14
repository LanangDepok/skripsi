@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.getLogbooks') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 text-center rounded-md block">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset($logbook->bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil) ? $logbook->bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil : 'icons/user.png')) }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->bimbinganMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->bimbinganMahasiswa->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto mb-3"></div>
            <P><span class="font-bold">Tanggal Bimbingan: </span>{{ $logbook->tanggal }}</P>
            <P><span class="font-bold">Tempat Bimbingan: </span>{{ $logbook->tempat }}</P>
            <p><span class="font-bold">Jenis Bimbingan: </span>{{ $logbook->jenis_bimbingan }}</p>
            <p><span class="font-bold">Status: </span>{{ $logbook->status }}</p>
            <p><span class="font-bold">Link file atau dokumen bimbingan: </span>
                <a class="italic text-blue-400" href="{{ $logbook->bukti }}" target="_blank">
                    {{ $logbook->bukti }}
                </a>
            </p><br>
            <p><span class="font-bold">Uraian: </span></p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->uraian }}</textarea><br><br>
            <p><span class="font-bold">Rencana Pencapaian: </span></p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->rencana_pencapaian }}</textarea>
            <div class="h-1 bg-primary mt-3"></div>
        </div>
        <form method="POST" action="{{ route('dsn.acceptLogbook', ['logbook' => $logbook->id]) }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    onclick="return confirm('Terima pengajuan logbook atas nama {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}?')"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Terima</button>
                <button id="tolakButton" type="button"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
            </div>
        </form>
        <form method="POST" action="{{ route('dsn.acceptLogbook', ['logbook' => $logbook->id]) }}">
            @csrf
            {{-- Modal Tolak --}}
            <div id="modalTolak" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 hidden z-[1]">
                <div class="fixed bg-white top-40 bottom-40 left-96 right-96 z-10 rounded-lg">
                    <div class="w-7 ml-auto">
                        <button type="button" id="exitModalTolak" class="text-3xl font-extrabold text-slate-800">X</button>
                    </div>
                    <div class="container w-1/2 mx-auto">
                        <div>
                            <p class="font-bold text-lg text-center mb-3">Penolakan Logbook</p>
                            <label for="keterangan_ditolak">Masukkan keterangan ditolak</label>
                            <textarea name="keterangan_ditolak" id="keterangan_ditolak" rows="3" class="w-full" required></textarea>
                        </div>
                        <div class="w-24 h-8 mx-auto mt-5">
                            <button type="submit" name="action" value="tolak"
                                onclick="return confirm('Tolak pengajuan logbook atas nama {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}?')"
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
