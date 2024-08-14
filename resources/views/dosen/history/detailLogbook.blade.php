@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('dsn.historyLogbook') }}"
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
    </div>
@endsection
