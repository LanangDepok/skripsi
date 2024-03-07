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
                            <a href="/logbook" class="hover:bg-slate-300 bg-red-200">
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
        <div>
            <h2 class="text-primary text-2xl font-semibold text-center mt-20">Logbook Bimbingan</h2>
            <div class="bg-primary h-1 mb-5 mt-2 w-2/5 mx-auto"></div>
        </div>
        <div class="container mx-auto mt-4">
            <div class="flex justify-between px-20">
                <div class="border-2 border-slate-400 shadow-lg shadow-slate-200 p-4 rounded-md">
                    <p class="text-center">Dosen Pembimbing</p>
                    <img src="/storage/assets/4x6.jpg" class="w-28 h-28 rounded-full mt-2 mx-auto">
                    <p class="text-center">Bagas Rizkiyanto</p>
                    <p class="text-center">NIP. 12345678901234567890</p>
                </div>
                <div class="border-2 border-slate-400 shadow-lg shadow-slate-200 p-4 rounded-md h-48">
                    <p class="text-red-600 font-bold underline text-xl mb-3">Perhatian!!</p>
                    <ul>
                        <li>1. Setiap perubahan skripsi, pastikan upload di page <span
                                class="text-red-600 underline font-semibold"><a href="/skripsi">Skripsi</a></span> yang
                            tertera pada navbar</li>
                        <li>2. Untuk mengajukan seminar proposal, minimal melakukan 3x bimbingan</li>
                        <li>3. Untuk mengajukan sidang skripsi, minimal melakukan 10x bimbingan</li>
                        <li>4. Bimbingan dihitung berdasarkan jumlah logbook yang diterima oleh dosen pembimbing</li>
                    </ul>
                </div>
                <a href="#" class="bg-primary rounded-md p-1 px-3 text-white h-1/6 mt-auto">+Tambah Logbook</a>
            </div>
        </div>
        <div class="container mx-auto mt-6">
            <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-2/3">
                <thead class="bg-primary">
                    <tr>
                        <th class="border-b border-slate-500 py-2">Tanggal</th>
                        <th class="border-b border-slate-500 py-2">Tempat</th>
                        <th class="border-b border-slate-500 py-2">Jenis Bimbingan</th>
                        <th class="border-b border-slate-500 py-2">Status</th>
                        <th class="border-b border-slate-500 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">20 september 2023</td>
                        <td class="border-b border-slate-500 py-2 text-center">Zoom meeting</td>
                        <td class="border-b border-slate-500 py-2 text-center">seminar proposal</td>
                        <td class="border-b border-slate-500 py-2 text-center">Diterima</td>
                        <td class="text-center  border-b border-slate-500"><button
                                class="bg-primary border rounded-md w-16 text-white">Detail</button></td>
                    </tr>
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">20 september 2023</td>
                        <td class="border-b border-slate-500 py-2 text-center">Zoom meeting</td>
                        <td class="border-b border-slate-500 py-2 text-center">seminar proposal</td>
                        <td class="border-b border-slate-500 py-2 text-center">Diterima</td>
                        <td class="text-center  border-b border-slate-500"><button
                                class="bg-primary border rounded-md w-16 text-white">Detail</button></td>
                    </tr>
                    <tr class="even:bg-slate-300">
                        <td class="border-b border-slate-500 py-2 text-center">20 september 2023</td>
                        <td class="border-b border-slate-500 py-2 text-center">Zoom meeting</td>
                        <td class="border-b border-slate-500 py-2 text-center">seminar proposal</td>
                        <td class="border-b border-slate-500 py-2 text-center">Diterima</td>
                        <td class="text-center  border-b border-slate-500"><button
                                class="bg-primary border rounded-md w-16 text-white">Detail</button></td>
                    </tr>
                </tbody>
            </table>
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
