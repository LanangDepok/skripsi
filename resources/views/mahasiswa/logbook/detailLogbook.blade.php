@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/mahasiswa/logbook"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 text-center rounded-md block">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->mahasiswa->user->nama }}</p>
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->mahasiswa->nim }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto mb-3"></div>
            <P>Tanggal bimbingan: {{ $logbook->tanggal }}</P>
            <P>Tempat bimbingan: {{ $logbook->tempat }}</P>
            <p>Jenis bimbingan: {{ $logbook->jenis_bimbingan }}</p>
            <p>Status: {{ $logbook->status }}</p><br>
            <p>Uraian:</p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->uraian }}</textarea><br><br>
            <p>Rencana Pencapaian:</p>
            <textarea readonly rows="5" class="w-full">{{ $logbook->rencana_pencapaian }}</textarea>
            <div class="h-1 bg-primary mt-3"></div>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <p>Judul Skripsi: {{ $logbook->bimbingan->mahasiswa->user->skripsi->judul }}</p>
            <p>Sub judul (jika ada): {{ $logbook->bimbingan->mahasiswa->user->skripsi->sub_judul }}</p>
            <p>Anggota tim(jika ada): {{ $logbook->bimbingan->mahasiswa->user->skripsi->anggota }}</p><br>
            @if ($logbook->bimbingan->mahasiswa->user->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $logbook->bimbingan->mahasiswa->user->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Anda belum <a href="/mahasiswa/skripsi"
                        class="text-blue-500 underline">upload file skripsi.</a></p>
            @endif
        </div>
    </div>
@endsection
