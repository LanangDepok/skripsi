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
                            <a href="/informasi" class="hover:bg-slate-300 bg-red-200">
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
        <div class="container mx-auto w-1/2 mt-6">
            <p class=" text-2xl font-semibold">Pengajuan Judul & Dosen Pembimbing</p>
            <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
            <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
                <thead>
                    <tr>
                        <th class="border-b border-slate-500 py-2">Calon Dosen Pembimbing</th>
                        <th class="border-b border-slate-500 py-2">Judul</th>
                        <th class="border-b border-slate-500 py-2">Status</th>
                        <th class="border-b border-slate-500 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b border-slate-500 py-2 text-center">
                            <ul>
                                <li>1. Pak anggi</li>
                                <li>2. Pak asep</li>
                                <li>3. Pak mauldy</li>
                            </ul>
                        </td>
                        <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                            consectetur,
                            adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                            architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                            similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                        <td class="border-b border-slate-500 py-2 text-center">Menunggu</td>
                        <td class="text-center  border-b border-slate-500"><button
                                class="bg-primary border rounded-md w-16 text-white">Detail</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container mx-auto w-1/2 mt-6">
            <p class=" text-2xl font-semibold">Hasil Sidang Seminar atau Skripsi</p>
            <div class="bg-primary h-1 mb-5 mt-2 mx-auto"></div>
            <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
                <thead>
                    <tr>
                        <th class="border-b border-slate-500 py-2">Tanggal</th>
                        <th class="border-b border-slate-500 py-2">Judul</th>
                        <th class="border-b border-slate-500 py-2">Status</th>
                        <th class="border-b border-slate-500 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b border-slate-500 py-2 text-center">2 Agustus 2024</td>
                        <td class="border-b border-slate-500 py-2 text-justify">Lorem ipsum dolor sit amet
                            consectetur,
                            adipisicing elit. Necessitatibus beatae amet explicabo iure atque repellat odio suscipit
                            architecto rem nemo, perferendis dolore nam voluptatem dolorem accusamus deleniti ut
                            similique, sapiente velit quod dicta qui. Assumenda officia eos nobis placeat id.</td>
                        <td class="border-b border-slate-500 py-2 text-center">Lulus dengan revisi</td>
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
