@extends('mahasiswa.template')

@section('content')
    <div class="flex justify-center">
        <div class="container w-2/5">
            <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Judul & Dosen Pembimbing</h2>
            <div class="bg-primary container h-1 mb-5 mt-2"></div>
            <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                <div class="text-left mb-4">
                    <label for="telp">No. Kontak Mahasiswa<span class="text-red-700">*</span></label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="telp" id="telp">
                </div>
                <div class="text-left mb-4">
                    <label for="ortu">Nama Orang Tua/Wali<span class="text-red-700">*</span></label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="ortu" id="ortu">
                </div>
                <div class="text-left mb-4">
                    <label for="telp_ortu">No. Kontak Orang Tua/Wali<span class="text-red-700">*</span></label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="telp_ortu" id="telp_ortu">
                </div>
                <div class="text-left mb-4">
                    <label for="tim">Nama Anggota Tim (Jika ada, contoh penulisan: ilham, budi, dst.)</label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="tim" id="tim" placeholder="ilham, kurniawan, kurniadi">
                </div>
                <div class="text-left mb-4">
                    <p>Apakah judul dari dosen?<span class="text-red-700">*</span></p>
                    <label for="judul_dosen">Ya</label>
                    <input type="radio" name="judul_dosen" id="judul_dosen">
                    <label for="judul_dosen">Tidak</label>
                    <input type="radio" name="judul_dosen" id="judul_dosen">
                </div>
                <div class="text-left mb-4">
                    <label for="judul">Topik/Judul Skripsi<span class="text-red-700">*</span></label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="judul" id="judul">
                </div>
                <div class="text-left mb-4">
                    <label for="sub_judul">Sub Judul Skripsi (Jika ada)</label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="sub_judul" id="sub_judul">
                </div>
                <div class="text-left mb-4">
                    <label for="abstrak">Abstrak/Ringkasan Skripsi<span class="text-red-700">*</span></label>
                    <textarea id="abstrak" name="abstrak"
                        placeholder="ringkasan yang akan dikerjakan (latar belakang, batasan, metode/model/algoritma/teknologi)"
                        rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                </div>
                <div class="text-left mb-4">
                    <label for="studi_kasus">Studi Kasus<span class="text-red-700">*</span></label>
                    <input type="text"
                        class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                        name="studi_kasus" id="studi_kasus">
                </div>
                <div class="text-left mb-4">
                    <label for="referensi">Sumber Referensi<span class="text-red-700">*</span></label>
                    <textarea id="referensi" name="referensi"
                        placeholder="Sumber Referensi Skripsi (minimal 3 artikel dari jurnal nasional dan 2 artikel dari publikasi internasional terindeks scopus, contoh: IEEEXplore, Elsevier )"
                        rows="5" class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"></textarea>
                </div>
                <div class="text-left mb-4">
                    <label for="pilihan1_dospem">Dosen Pembimbing yang Dipilih (1)<span
                            class="text-red-700">*</span></label>
                    <select name="pilihan1_dospem" id="pilihan1_dospem"
                        class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="text-left mb-4">
                    <label for="pilihan2_dospem">Dosen Pembimbing yang Dipilih (2)<span
                            class="text-red-700">*</span></label>
                    <select name="pilihan2_dospem" id="pilihan2_dospem"
                        class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="text-left mb-4">
                    <label for="pilihan3_dospem">Dosen Pembimbing yang Dipilih (3)<span
                            class="text-red-700">*</span></label>
                    <select name="pilihan3_dospem" id="pilihan3_dospem"
                        class="block border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="text-left mb-4">
                    <label for="signature">Tanda Tangan<span class="text-red-700">*</span></label>
                    <input type="file"
                        class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100" name="signature"
                        id="signature">
                </div>
                <div class="text-center mt-12">
                    <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
