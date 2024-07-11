@extends('admin.template')

@section('content')
    <div class="container mx-auto">
        <div class="flex w-1/2 mx-auto">
            <a href="{{ route('adm.getLecturers') }}"
                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 inline-block text-center">Back</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . (isset($dosen->photo_profil) ? $dosen->photo_profil : 'icons/user.png')) }}"
                alt="Foto_profil" class="w-36 h-36 rounded-full">
        </div>
        <div class="text-center mt-6">
            <p class="font-semibold text-lg">{{ $dosen->user->nama }}</p>
        </div>
        <div class="container w-1/2 mx-auto mt-6">
            <div class="h-1 bg-primary mx-auto"></div>
            <P><span class="font-bold">Email: </span>{{ $dosen->user->email }}</P><br>
            <P><span class="font-bold">NIP: </span>{{ $dosen->nip }}</P><br>
            <P><span class="font-bold">Jabatan: </span>{{ $dosen->jabatan->nama }}</P><br>
            <P><span class="font-bold">Fungsional: </span>{{ $dosen->fungsional->nama }}</P><br>
            <P><span class="font-bold">Gol & Pangkat: </span>{{ $dosen->gol_pangkat->nama }}</P><br>
            <P>
                @php
                    $roles = $dosen->user->roles->pluck('nama')->implode(', ');
                @endphp
                <span class="font-bold">Role: </span>{{ $roles }}
            </P><br>
            <P><span class="font-bold">Mahasiswa Bimbingan: </span>
                @php
                    $i = 1;
                @endphp
                @foreach ($dosen->user->bimbinganDosen as $bimbingan)
                    <p>{{ $i++ }}. {{ $bimbingan->bimbinganMahasiswa->nama }}</p>
                @endforeach
            </P>
            <div class="h-1 bg-primary"></div>
        </div>
    </div>
@endsection
