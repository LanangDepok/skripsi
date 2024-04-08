@extends('mahasiswa.template')

@section('content')
    <div>
        <h2 class="text-primary text-2xl font-semibold text-center">Logbook Bimbingan</h2>
        <div class="bg-primary h-1 mb-5 mt-2 w-2/5 mx-auto"></div>
    </div>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between px-20">
            <div class="border-2 border-slate-400 shadow-lg shadow-slate-200 p-4 rounded-md">
                <p class="text-center">Dosen Pembimbing</p>
                <img src="/storage/{{ isset(Auth::user()->mahasiswa->bimbingan->dosen->photo_profil) ? Auth::user()->mahasiswa->bimbingan->dosen->photo_profil : 'icons/user.png' }}"
                    class="w-28 h-28 rounded-full mt-2 mx-auto">
                <p class="text-center">{{ $bimbingan->dosen->user->nama }}</p>
                <p class="text-center">{{ $bimbingan->dosen->nip }}</p>
            </div>
            <div class="border-2 border-slate-400 shadow-lg shadow-slate-200 p-4 rounded-md h-48">
                <p class="text-red-600 font-bold underline text-xl mb-3">Perhatian!!</p>
                <ul>
                    <li>1. Setiap perubahan skripsi, pastikan upload di page <span
                            class="text-blue-500 underline font-semibold"><a href="/mahasiswa/skripsi">Skripsi</a></span>
                        yang
                        tertera pada navbar</li>
                    <li>2. Untuk mengajukan seminar proposal, minimal melakukan <span class="text-red-600">3x
                            bimbingan</span></li>
                    <li>3. Untuk mengajukan sidang skripsi, minimal melakukan <span class="text-red-600">10x
                            bimbingan</span></li>
                    <li>4. Bimbingan dihitung berdasarkan jumlah logbook yang diterima oleh dosen pembimbing</li>
                </ul>
            </div>
            <a href="/mahasiswa/logbook/create"
                class="bg-primary rounded-md p-1 px-3 text-white h-1/6 mt-auto hover:text-black hover:bg-red-300">+Tambah
                Logbook</a>
        </div>
    </div>
    <div class="container mx-auto mt-6">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center"
                role="alert">
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-2/3">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Tanggal bimbingan</th>
                    <th class="border-b border-slate-500 py-2">Tempat</th>
                    <th class="border-b border-slate-500 py-2">Jenis Bimbingan</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bimbingan->logbooks as $logbook)
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tanggal }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tempat }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->jenis_bimbingan }}</td>
                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->status }}</td>
                        <td class="text-center  border-b border-slate-500"><a href="/mahasiswa/logbook/{{ $logbook->id }}"
                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
