@extends('dosen.template')

@section('content')
    <div class="container mx-auto w-2/3 flex justify-end">
        <a href="/dosen/profile/1/edit"
            class="rounded-lg bg-primary p-2 px-4 text-white hover:text-black hover:bg-red-300">Edit
            Biodata</a>
    </div>
    <div
        class="container mx-auto w-2/3 mt-2 flex rounded-lg border-2 border-primary p-6 shadow-slate-400 shadow-lg justify-around">
        {{-- <div class=""> --}}
        <img src="/storage/icons/user.png" class="w-40 h-40 rounded-full my-auto">
        {{-- </div> --}}
        <div>
            <p>Email : bagas.rizkiyanto.tik20@mhsw.pnj.ac.id</p>
            <p>Nama : Bagas Rizkiyanto</p>
            <p>NIP : 2007412006</p>
            <p>Jabatan : TI-CCIT 8</p>
            <p>Fungsional: </p>
            <p>Fungsioanl: Gol & Pangkat</p>
            <p>Role: Ketua penguji, Dosen Pembimbing</p>
        </div>
        <img src="/storage/assets/signature.png" class="max-h-24 max-w-56 my-auto">
    </div>
@endsection
