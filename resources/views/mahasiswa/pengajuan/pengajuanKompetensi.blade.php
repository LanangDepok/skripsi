@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Kompetensi</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <form method="POST" action="{{ route('mhs.ajukanKompetensi', ['user' => Auth::user()->id]) }}">
                    @csrf
                    <div class="text-left mb-4">
                        <label for="judul_skripsi_inggris">Judul Skripsi (Bahasa Inggris)</label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="judul_skripsi_inggris" id="judul_skripsi_inggris">
                    </div>
                    @error('judul_skripsi_inggris')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="kompetensi">Tuliskan kompetensi apa saja yg dimilki dan penghargaan juara lomba yang
                            pernah diraih (jika ada), nantinya isian ini dituliskan di Surat Keterangan Pendamping
                            Ijazah/SKPI (dibuktikan dengan lampiran file pdf sertifikatnya)</label>
                        <textarea id="kompetensi" name="kompetensi" rows="5"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                    </div>
                    @error('kompetensi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-left mb-4">
                        <label for="bukti_kompetensi">Masukkan link bukti sertikat kompetensi yang dimiliki dan
                            sertifikat penghargaan/juara lomba, (semua file sertifikat dijadikan satu file PDF).<span
                                class="text-red-700">*</span></label>
                        <input type="text"
                            class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="bukti_kompetensi" id="bukti_kompetensi">
                    </div>
                    @error('bukti_kompetensi')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-12">
                        <button type="submit"
                            class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 hover:text-black text-white"
                            onclick="return confirm('Ajukan pengajuan sidang skripsi?')">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
