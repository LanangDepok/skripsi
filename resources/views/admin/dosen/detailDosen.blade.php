@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="/admin/dosen"
                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="/storage/{{ isset($dosen->photo_profil) ? $dosen->photo_profil : 'icons/user.png' }}" alt="Foto_profil"
                class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $dosen->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P>Email: {{ $dosen->user->email }}</P><br>
            <P>NIP: {{ $dosen->nip }}</P><br>
            <P>Jabatan: {{ $dosen->jabatan }}</P><br>
            <P>Fungsional: {{ $dosen->fungsional }}</P><br>
            <P>Gol & Pangkat: {{ $dosen->gol_pangkat }}</P><br>
            <P>
                @php
                    $roles = $dosen->user->roles->pluck('nama')->implode(', ');
                @endphp
                Role: {{ $roles }}
            </P><br>
            <P>Mahasiswa Bimbingan: </P>
            <div class="h-1 bg-primary"></div>
        </div>
    </div>
@endsection
