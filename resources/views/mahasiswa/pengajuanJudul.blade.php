<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Skripsi PNJ</title>
    <style>
        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>

    <header class="w-full">
        <div class="bg-primary px-8">
            <div class="container mx-auto flex items-center">
                <div>
                    <img src="/storage/assets/logo_pnj.png" class="w-20 h-20">
                </div>
                <div class="ml-3">
                    <h3 class="text-4xl font-semibold text-white">Politeknik Negeri Jakarta</h3>
                </div>
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between">
                <div class="w-5/12">
                    <ul class="flex justify-between">
                        <li>
                            <a href="/" class="hover:bg-slate-300 ">
                                Home
                                <span>
                                    <img src="/storage/icons/home.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/logbook" class="hover:bg-slate-300">
                                Logbook
                                <span>
                                    <img src="/storage/icons/logbook.png"
                                        class="w-4 h-4 inline-block -translate-y-[5%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button id="pengajuanDropdownButton" class="hover:bg-slate-300 bg-red-200">
                                Pengajuan
                                <span>
                                    <img src="/storage/icons/contract.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="pengajuanDropdownContent">
                                <a href="/pengajuan/judul" class="block px-4 py-2 hover:bg-slate-300 bg-red-200">Judul &
                                    pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/pengajuan/sempro" class="block px-4 py-2 hover:bg-slate-300">Sidang sempro</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/pengajuan/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    skripsi</a>
                            </div>
                        </li>
                        <li>
                            <a href="/informasi" class="hover:bg-slate-300">
                                Informasi
                                <span>
                                    <img src="/storage/icons/information-button.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/skripsi" class="hover:bg-slate-300">
                                Skripsi
                                <span>
                                    <img src="/storage/icons/pdf.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <button class="flex items-center relative hover:bg-slate-300" id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">Bagas Rizkiyanto</p>
                        <span class="ml-3">
                            <img src="/storage/icons/user.png" class="w-3 h-3 translate-y-[10%]">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        <a href="/profile" class="block px-4 py-2 hover:bg-slate-300">Profile</a>
                        <div class="container h-[1px] w-full bg-slate-500"></div>
                        <a href="#" class="block px-4 py-2 hover:bg-slate-300">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary">
            <div class="container w-max h-1"></div>
        </div>
    </header>

    <main>
        <div class="flex justify-center">
            <div class="container w-2/5 py-20">
                <h2 class="text-primary text-2xl font-semibold text-center">Pengajuan Judul & Dosen Pembimbing</h2>
                <div class="bg-primary container h-1 mb-5 mt-2"></div>
                <div class="container border-2 border-primary p-12 rounded-lg shadow-slate-400 shadow-lg">
                    {{-- <div class="bg-blue-400 text-left">
                        <label for="email">Email<span class="text-red-700">*</span></label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="text-left">
                        <label for="name">Nama Lengkap<span class="text-red-700">*</span></label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="text-left">
                        <label for="nim">NIM<span class="text-red-700">*</span></label>
                        <input type="text" name="nim" id="nim">
                    </div> --}}
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
                    {{-- <div class="text-left">
                        <label for="prodi">Nama Prodi<span class="text-red-700">*</span></label>
                        <select name="prodi" id="prodi">
                            <option value="Teknik Informatika">Teknik Informatika</option>
                        </select>
                    </div>
                    <div class="text-left">
                        <label for="kelas">Kelas<span class="text-red-700">*</span></label>
                        <select name="kelas" id="kelas">
                            <option value="TI CCIT">TI CCIT</option>
                        </select>
                    </div> --}}
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
                            class="w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                            name="signature" id="signature">
                    </div>
                    <div class="text-center mt-12">
                        <button class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-8">
        <div class="bg-slate-400 container text-center">
            <p class="text-sm">Copyright &copy; - Designed & Developed by Politeknik Negeri Jakarta</p>
        </div>
    </footer>

</body>

<script>
    const userDropdownButton = document.getElementById('userDropdownButton');
    const userDropdownContent = document.getElementById('userDropdownContent');
    userDropdownButton.addEventListener('click', function() {
        userDropdownContent.classList.toggle('hidden');
    });

    const pengajuanDropdownButton = document.getElementById('pengajuanDropdownButton');
    const pengajuanDropdownContent = document.getElementById('pengajuanDropdownContent');
    pengajuanDropdownButton.addEventListener('click', function() {
        pengajuanDropdownContent.classList.toggle('hidden');
    });
</script>

</html>
