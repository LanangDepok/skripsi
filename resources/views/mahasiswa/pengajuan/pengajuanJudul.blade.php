@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Judul & Dosen Pembimbing</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <form method="POST" action="/mahasiswa/pengajuan/judul/{{ Auth::user()->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="text-left mb-4">
                        <label for="no_kontak">No. Kontak Mahasiswa (ex: 6281380227845)<span
                                class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="no_kontak" id="no_kontak" value="{{ old('no_kontak') }}">
                    </div>
                    @error('no_kontak')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="nama_ortu">Nama Orang Tua/Wali<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="nama_ortu" id="nama_ortu">
                    </div>
                    @error('nama_ortu')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="no_kontak_ortu">No. Kontak Orang Tua/Wali (ex: 6281380227845)<span
                                class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="no_kontak_ortu" id="no_kontak_ortu">
                    </div>
                    @error('no_kontak_ortu')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="anggota">Nama Anggota tim (Jika ada, contoh penulisan: ilham, budi, dst.)</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="anggota" id="anggota" placeholder="ilham, kurniawan, kurniadi">
                    </div>
                    @error('anggota')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <p>Apakah judul dari dosen?<span class="text-red-700">*</span></p>
                        <label for="judul_dosen">Ya</label>
                        <input type="radio" name="judul_dosen" id="judul_dosen" value="Ya">
                        <label for="judul_dosen">Tidak</label>
                        <input type="radio" name="judul_dosen" id="judul_dosen" value="Tidak">
                    </div>
                    @error('judul_dosen')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="judul">Topik/Judul Skripsi<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="judul" id="judul">
                    </div>
                    @error('judul')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sub_judul">Sub Judul Skripsi (Jika ada)</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="sub_judul" id="sub_judul">
                    </div>
                    @error('sub_judul')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="abstrak">Abstrak/Ringkasan Skripsi<span class="text-red-700">*</span></label>
                        <textarea id="abstrak" name="abstrak"
                            placeholder="ringkasan yang akan dikerjakan (latar belakang, batasan, metode/model/algoritma/teknologi)"
                            rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('abstrak')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="studi_kasus">Studi Kasus<span class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="studi_kasus" id="studi_kasus">
                    </div>
                    @error('studi_kasus')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="sumber_referensi">Sumber Referensi<span class="text-red-700">*</span></label>
                        <textarea id="sumber_referensi" name="sumber_referensi"
                            placeholder="Sumber Referensi Skripsi (minimal 3 artikel dari jurnal nasional dan 2 artikel dari publikasi internasional terindeks scopus, contoh: IEEEXplore, Elsevier )"
                            rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('sumber_referensi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="pilihan1_dospem">Dosen Pembimbing yang Dipilih (1)<span
                                class="text-red-700">*</span></label>
                        <select name="pilihan1_dospem" id="pilihan1_dospem"
                            class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 w-full">
                            @foreach ($roles as $role)
                                <option value="volvo">{{ $role->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-left mb-4">
                        <label for="pilihan2_dospem">Dosen Pembimbing yang Dipilih (2)<span
                                class="text-red-700">*</span></label>
                        <select name="pilihan2_dospem" id="pilihan2_dospem"
                            class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 w-full">
                            @foreach ($roles as $role)
                                <option value="volvo">{{ $role->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-left mb-4">
                        <label for="pilihan3_dospem">Dosen Pembimbing yang Dipilih (3)<span
                                class="text-red-700">*</span></label>
                        <select name="pilihan3_dospem" id="pilihan3_dospem"
                            class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100 w-full">
                            @foreach ($roles as $role)
                                <option value="volvo">{{ $role->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('pilihan3_dospem')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="tanda_tangan">Tanda Tangan (JPG, JPEG, PNG)<span class="text-red-700">*</span></label>
                        <input type="file"
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="tanda_tangan" id="tanda_tangan">
                    </div>
                    @error('tanda_tangan')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-12">
                        <button type="submit"
                            class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
