@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('mhs.getLogbooks') }}"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 text-center rounded-md block">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png')) }}"
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
            @if ($logbook->status == 'Diterima')
                <p>Diterima oleh: {{ $penerima->nama }}</p><br>
            @elseif ($logbook->status == 'Ditolak')
                <p>Ditolak oleh: {{ $penerima->nama }}</p><br>
            @endif
            <p><span class="font-bold">Uraian: </span></p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->uraian }}</textarea><br><br>
            <p><span class="font-bold">Rencana Pencapaian: </span></p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->rencana_pencapaian }}</textarea>
            <div class="h-1 bg-primary mt-3"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <p><span class="font-bold">Judul Skripsi: </span>{{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->judul }}
            </p>
            <p><span class="font-bold">Sub Judul (Jika ada):
                </span>{{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->sub_judul }}</p>
            <p><span class="font-bold">Anggota Tim (Jika ada):
                </span>{{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->anggota }}</p><br>
            @if ($logbook->bimbingan->bimbinganMahasiswa->skripsi->file_skripsi != null)
                <iframe src="{{ asset('storage/' . $logbook->bimbingan->bimbinganMahasiswa->skripsi->file_skripsi) }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Anda belum <a href="{{ route('mhs.getSkripsi') }}"
                        class="text-blue-500 underline">upload file skripsi.</a></p>
            @endif
        </div>
    </div>
@endsection
