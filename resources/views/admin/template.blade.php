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
            <div class="container mx-auto flex justify-between">
                <div class="flex items-center">
                    <div>
                        <img src="/storage/assets/logo_pnj.png" class="w-20 h-20">
                    </div>
                    <div class="ml-3">
                        <h3 class="text-4xl font-bold text-white">Politeknik Negeri Jakarta</h3>
                    </div>
                </div>
                <div class="flex items-center">
                    <label for="program_studi" class="mr-3 text-white font-semibold">Role Saat ini:</label>
                    <select name="program_studi" id="program_studi" class="w-24 rounded-md"
                        onchange="redirectToPage(this)">
                        <option value="/dosen/index">Dosen</option>
                        <option value="/admin/index" selected>Komite</option>
                    </select>
                    {{-- <a href="/dosen/index"
                        class="h-7 w-36 bg-red-300 text-center rounded-md font-semibold hover:text-white">
                        Ganti Role Dosen
                    </a> --}}
                </div>
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between">
                <div class="w-2/3">
                    <ul class="flex justify-between">
                        <li>
                            <a href="/admin/index"
                                class="hover:bg-slate-300 {{ $title == 'index' ? 'bg-red-200' : '' }}">
                                Home
                                <span>
                                    <img src="/storage/icons/home.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/mahasiswa"
                                class="hover:bg-slate-300 {{ $title == 'mahasiswa' ? 'bg-red-200' : '' }}">
                                Mahasiswa
                                <span>
                                    <img src="/storage/icons/group.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/dosen"
                                class="hover:bg-slate-300  {{ $title == 'dosen' ? 'bg-red-200' : '' }}">
                                Dosen
                                <span>
                                    <img src="/storage/icons/presentation.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button id="pengajuanDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'pengajuan' ? 'bg-red-200' : '' }}">
                                Pengajuan
                                <span>
                                    <img src="/storage/icons/contract.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="pengajuanDropdownContent">
                                <a href="/admin/pengajuan/judul" class="block px-4 py-2 hover:bg-slate-300">Judul &
                                    pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/pengajuan/sempro" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    sempro</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/pengajuan/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/pengajuan/alat" class="block px-4 py-2 hover:bg-slate-300">Serah
                                    terima alat & skripsi</a>
                            </div>
                        </li>
                        <li>
                            <a href="/admin/skripsi"
                                class="hover:bg-slate-300  {{ $title == 'skripsi' ? 'bg-red-200' : '' }}">
                                Pelaksanaan Sidang
                                <span>
                                    <img src="/storage/icons/meeting.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/revisi"
                                class="hover:bg-slate-300  {{ $title == 'revisi' ? 'bg-red-200' : '' }}">
                                Penerimaan Revisi
                                <span>
                                    <img src="/storage/icons/revision.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        {{-- <li class="relative">
                            <button id="dataDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'data' ? 'bg-red-200' : '' }}">
                                Data
                                <span>
                                    <img src="/storage/icons/contract.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="dataDropdownContent">
                                <a href="/admin/data/kelas" class="block px-4 py-2 hover:bg-slate-300">Kelas</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/data/prodi" class="block px-4 py-2 hover:bg-slate-300">Program
                                    Studi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/data/tahun" class="block px-4 py-2 hover:bg-slate-300">Tahun
                                    Ajaran</a>
                            </div>
                        </li> --}}
                    </ul>
                </div>
                <div class="relative">
                    <button
                        class="flex items-center relative hover:bg-slate-300  {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">Admin</p>
                        <span class="ml-3">
                            <img src="/storage/icons/user.png" class="w-3 h-3 translate-y-[10%]">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        <a href="#" class="block px-4 py-2 hover:bg-slate-300">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary">
            <div class="container w-max h-1"></div>
        </div>
    </header>

    <main class="mt-10">
        @yield('content')
    </main>

    <div class="mb-20"></div>
    <footer class="fixed bottom-0 left-0 right-0">
        <div class="bg-slate-400 container text-center">
            <p class="text-sm">Copyright &copy; - Designed & Developed by Politeknik Negeri Jakarta</p>
        </div>
    </footer>

    <script>
        const pengajuanDropdownButton = document.getElementById('pengajuanDropdownButton');
        const pengajuanDropdownContent = document.getElementById('pengajuanDropdownContent');
        pengajuanDropdownButton.addEventListener('click', function() {
            pengajuanDropdownContent.classList.toggle('hidden');
        });

        const userDropdownButton = document.getElementById('userDropdownButton');
        const userDropdownContent = document.getElementById('userDropdownContent');
        userDropdownButton.addEventListener('click', function() {
            userDropdownContent.classList.toggle('hidden');
        });

        //pindah role
        function redirectToPage(select) {
            var selectedOption = select.options[select.selectedIndex];
            var url = selectedOption.value;
            window.location.href = url;
        }
    </script>

</body>

</html>
