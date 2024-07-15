@extends('dosen.template')

@section('content')
    <div class="container mx-auto mt-6">
        <form action="{{ route('dsn.acceptAllLogbook') }}" method="POST">
            <p class="text-center text-2xl font-semibold mb-6">Pengajuan Logbook</p>
            @csrf
            <button
                class="bg-primary border rounded-md w-56 h-12 text-white hover:text-black hover:bg-red-300 block mx-auto">Terima
                Logbook</button>
            @error('logbook')
                <div class="p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
                    role="alert">
                    <span class="font-medium">Error!</span>{{ $message }}
                </div>
            @enderror
            <div class="mx-auto mt-6 overflow-x-auto">
                <table class="table-auto mx-auto border-2 border-slate-500 w-full">
                    <thead class="bg-primary">
                        <tr>
                            <th class="border-b border-slate-500 py-2"></th>
                            <th class="border-b border-slate-500 py-2">No.</th>
                            <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                            <th class="border-b border-slate-500 py-2">Tanggal</th>
                            <th class="border-b border-slate-500 py-2">Tempat</th>
                            <th class="border-b border-slate-500 py-2">Status</th>
                            <th class="border-b border-slate-500 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($bimbingan as $bimbingan)
                            @foreach ($bimbingan->logbook as $logbook)
                                @if ($logbook->status == 'Menunggu persetujuan pembimbing')
                                    <tr class="even:bg-slate-300">
                                        <td class="border-b border-slate-500 py-2 text-center">
                                            <input type="checkbox" name="logbook[]" value="{{ $logbook->id }}">
                                        </td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">
                                            {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tanggal }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tempat }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->status }}</td>
                                        <td class="text-center  border-b border-slate-500">
                                            <a href="{{ route('dsn.getLogbook', ['logbook' => $logbook->id]) }}"
                                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a></button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        @foreach ($bimbingan2 as $bimbingan2)
                            @foreach ($bimbingan2->logbook as $logbook)
                                @if ($logbook->status == 'Menunggu persetujuan pembimbing')
                                    <tr class="even:bg-slate-300">
                                        <td class="border-b border-slate-500 py-2 text-center">
                                            <input type="checkbox" name="logbook[]" value="{{ $logbook->id }}">
                                        </td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $i++ }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">
                                            {{ $logbook->bimbingan->bimbinganMahasiswa->nama }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tanggal }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->tempat }}</td>
                                        <td class="border-b border-slate-500 py-2 text-center">{{ $logbook->status }}</td>
                                        <td class="text-center  border-b border-slate-500">
                                            <a href="{{ route('dsn.getLogbook', ['logbook' => $logbook->id]) }}"
                                                class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300 block mx-auto">Detail</a></button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
