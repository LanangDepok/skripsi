@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <button class="bg-primary text-white hover:text-black hover:bg-red-300 w-20 h-8 rounded-xl"><a
                    href="/admin/dosen">Back</a></button>
        </div>
        <div class="flex justify-center">
            {{-- <img src="{{ isset($data) ? $data : '/storage/icons/user.png' }}" alt="Foto_profil"
                class="w-36 h-36 rounded-full"> --}}
            <img src="/storage/icons/user.png" alt="Foto_profil" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">Pak Mauldy Laya</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $dosen->user->email }}</P><br>
            <P>NIP: {{ $dosen->nip }}</P><br>
            <P>Jabatan: {{ $dosen->jabatan }}</P><br>
            <P>Fungsional: {{ $dosen->fungsional }}</P><br>
            <P>Gol & Pangkat: {{ $dosen->gol_pangkat }}</P><br>
            <P>Role: {{ implode(', ', $dosen->role) }}</P><br>
            <P>Mahasiswa Bimbingan: </P>
            <div class="h-1 bg-primary"></div>
        </div>
    </div>
@endsection
