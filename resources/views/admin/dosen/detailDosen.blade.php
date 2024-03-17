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
            <P>Email: mauldy.laya@tik.pnj.ac.id</P><br>
            <P>NIP: 2007412006</P><br>
            <P>Jabatan: Dosen</P><br>
            <P>Fungsional: </P><br>
            <P>Gol & Pangkat: </P><br>
            <P>Role: </P><br>
            <P>Mahasiswa Bimbingan: </P>
            <div class="h-1 bg-primary"></div>
        </div>
    </div>
@endsection
