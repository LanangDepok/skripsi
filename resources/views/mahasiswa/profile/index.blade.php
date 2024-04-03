@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-2/3 flex justify-end">
        <a href="/mahasiswa/profile/edit"
            class="rounded-lg bg-primary p-2 px-4 text-white hover:text-black hover:bg-red-300">Edit
            Biodata</a>
    </div>
    <div
        class="container mx-auto w-2/3 mt-2 flex rounded-lg border-2 border-primary p-6 shadow-slate-400 shadow-lg justify-around">
        {{-- <div class=""> --}}
        <img src="/storage/{{ isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png' }}"
            class="w-40 h-40 rounded-full my-auto">
        {{-- </div> --}}
        <div>
            <p>Email : {{ Auth::user()->email }}</p>
            <p>Nama : {{ Auth::user()->nama }}</p>
            <p>NIM : {{ Auth::user()->mahasiswa->nim }}</p>
            <p>Kelas : {{ Auth::user()->mahasiswa->kelas }}</p>
            <p>Prodi : {{ Auth::user()->mahasiswa->prodi }}</p>
            <p>No. Kontak : {{ Auth::user()->mahasiswa->no_kontak }}</p>
            <p>Nama Orang Tua/Wali : {{ Auth::user()->mahasiswa->nama_ortu }}</p>
            <p>No. Kontak Orang Tua/Wali : {{ Auth::user()->mahasiswa->no_kontak_ortu }}</p>
            {{-- <div class="flex flex-wrap bg-pink-300 w-96">
                    <p>Anggota Tim : Ilham, kurniawan, Kurniadi</p>
                </div> --}}
        </div>
        <img src="/storage/{{ Auth::user()->mahasiswa->tanda_tangan }}" class="max-h-24 max-w-56 my-auto">
    </div>
    <div class="container mx-auto w-2/3 mt-12">
        <p class="text-center text-xl font-semibold">Progress</p>
        <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
    </div>
    <div class="flex container mx-auto w-2/3 justify-between">
        <div class="w-36 h-36">
            <div
                class="border-2 h-20 w-20 border-slate-500 flex justify-center items-center rounded-full mx-auto bg-primary">
                <span class="text-2xl font-extrabold">1</span>
            </div>
            <p class="text-center">Mengajukan Seminar Proposal</p>
        </div>
        <div class="w-36 h-36">
            <div
                class="border-2 h-20 w-20 border-slate-500 flex justify-center items-center rounded-full mx-auto bg-primary">
                <span class="text-2xl font-extrabold">2</span>
            </div>
            <p class="text-center">Seminar Proposal</p>
        </div>
        <div class="w-36 h-36">
            <div
                class="border-2 h-20 w-20 border-slate-500 flex justify-center items-center rounded-full mx-auto bg-red-300">
                <span class="text-2xl font-extrabold">3</span>
            </div>
            <p class="text-center">Mengajukan Sidang Skripsi</p>
        </div>
        <div class="w-36 h-36">
            <div
                class="border-2 h-20 w-20 border-slate-500 flex justify-center items-center rounded-full mx-auto bg-red-300">
                <span class="text-2xl font-extrabold">4</span>
            </div>
            <p class="text-center">Sidang Skripsi</p>
        </div>
    </div>
@endsection
