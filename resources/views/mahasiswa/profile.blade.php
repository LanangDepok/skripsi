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
                            <a href="/logbook" class="hover:bg-slate-300 ">
                                Logbook
                                <span>
                                    <img src="/storage/icons/logbook.png"
                                        class="w-4 h-4 inline-block -translate-y-[5%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button id="pengajuanDropdownButton" class="hover:bg-slate-300">
                                Pengajuan
                                <span>
                                    <img src="/storage/icons/contract.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="pengajuanDropdownContent">
                                <a href="/pengajuan/judul" class="block px-4 py-2 hover:bg-slate-300 ">Judul &
                                    pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/pengajuan/sempro" class="block px-4 py-2 hover:bg-slate-300 ">Sidang
                                    sempro</a>
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
                    <button class="flex items-center relative hover:bg-slate-300 bg-red-200" id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64 ">Bagas Rizkiyanto</p>
                        <span class="ml-3">
                            <img src="/storage/icons/user.png" class="w-3 h-3 translate-y-[10%]">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        <a href="/profile" class="block px-4 py-2 hover:bg-slate-300 bg-red-200">Profile</a>
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
        <div class="container mx-auto w-1/2 flex justify-end mt-8">
            <button class="rounded-lg bg-primary p-2 px-4 text-white hover:text-black hover:bg-red-300">Edit
                Biodata</button>
        </div>
        <div
            class="container mx-auto w-2/3 mt-2 flex rounded-lg border-2 border-primary p-6 shadow-slate-400 shadow-lg justify-around">
            {{-- <div class=""> --}}
            <img src="/storage/assets/4x6.jpg" class="w-40 h-40 rounded-full my-auto">
            {{-- </div> --}}
            <div>
                <p>Email : bagas.rizkiyanto.tik20@mhsw.pnj.ac.id</p>
                <p>Nama : Bagas Rizkiyanto</p>
                <p>NIM : 2007412006</p>
                <p>Kelas : TI-CCIT 8</p>
                <p>Prodi : Teknik Informatika</p>
                <p>No. Kontak : 0895365145790</p>
                <p>Nama Orang Tua/Wali : myFather</p>
                <p>No. Kontak Orang Tua/Wali : 0895365145790</p>
                <p class="flex min-w-20">Anggota Tim : Ilham, kurniawan, Kurniadi KurniadiKurniadiKurniadiKurniadi</p>
            </div>
            <img src="/storage/assets/signature.png" class="max-h-24 max-w-56 my-auto">
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
