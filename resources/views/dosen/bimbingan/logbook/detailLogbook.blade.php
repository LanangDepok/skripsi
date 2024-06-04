@extends('dosen.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/dosen/bimbingan/logbook"
                class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 text-center rounded-md block">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($logbook->bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil) ? $logbook->bimbingan->bimbinganMahasiswa->mahasiswa->photo_profil : 'icons/user.png' }}"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->bimbinganMahasiswa->nama }}</p>
            <p class="font-semibold text-lg">{{ $logbook->bimbingan->bimbinganMahasiswa->mahasiswa->nim }}</p>
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
            <p>Judul Skripsi: {{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->judul }}</p>
            <p>Sub judul (jika ada): {{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->sub_judul }}</p>
            <p>Anggota tim(jika ada): {{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->anggota }}</p><br>
            @if ($logbook->bimbingan->bimbinganMahasiswa->skripsi->file_skripsi != null)
                <iframe src="/storage/{{ $logbook->bimbingan->bimbinganMahasiswa->skripsi->file_skripsi }}"
                    class="w-full h-[600px]"></iframe>
            @else
                <p class="text-center text-xl font-semibold">Mahasiswa belum upload file skripsi</p>
            @endif
        </div>
        <form method="POST" action="/dosen/bimbingan/logbook/{{ $logbook->id }}">
            @csrf
            <div class="container mx-auto w-1/2 mt-6 flex justify-around">
                <button type="submit" name="terima" value="terima"
                    onclick="return confirm('Terima pengajuan logbook atas nama {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}?')"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Terima</button>
                <button type="submit"
                    onclick="return confirm('Tolak pengajuan logbook atas nama {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}?')"
                    class="bg-primary border rounded-md w-24 text-white hover:text-black hover:bg-red-300 inline-block">Tolak</button>
            </div>
        </form>
    </div>
@endsection
