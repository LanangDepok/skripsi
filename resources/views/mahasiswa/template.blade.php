<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Skripsi PNJ</title>
    <style>
        @media print {
            @page {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <header class="w-full print:hidden">
        <div class="bg-primary px-8">
            <div class="container mx-auto flex items-center">
                <div>
                    <img src="/storage/assets/logo_pnj.png" class="w-20 h-20">
                </div>
                <div class="ml-3">
                    <h3 class="text-4xl font-bold text-white">Politeknik Negeri Jakarta</h3>
                </div>
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between items-center">
                <div class="w-3/5">
                    <ul class="flex justify-between">
                        <li>
                            <a href="/mahasiswa/index"
                                class="hover:bg-slate-300 {{ $title == 'index' ? 'bg-red-200' : '' }}">
                                Home
                                <span>
                                    <img src="/storage/icons/home.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/mahasiswa/logbook"
                                class="hover:bg-slate-300 {{ $title == 'logbook' ? 'bg-red-200' : '' }}">
                                Logbook
                                <span>
                                    <img src="/storage/icons/logbook.png"
                                        class="w-4 h-4 inline-block -translate-y-[5%]">
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
                                <a href="/mahasiswa/pengajuan/judul/{{ Auth::user()->id }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Judul
                                    &
                                    pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/mahasiswa/pengajuan/sempro" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    sempro</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/mahasiswa/pengajuan/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/mahasiswa/pengajuan/alat" class="block px-4 py-2 hover:bg-slate-300">Serah
                                    terima alat & skripsi</a>
                            </div>
                        </li>
                        <li>
                            <a href="/mahasiswa/informasi"
                                class="hover:bg-slate-300 {{ $title == 'informasi' ? 'bg-red-200' : '' }}">
                                Informasi
                                <span>
                                    <img src="/storage/icons/information-button.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/mahasiswa/skripsi"
                                class="hover:bg-slate-300 {{ $title == 'skripsi' ? 'bg-red-200' : '' }}">
                                Skripsi
                                <span>
                                    <img src="/storage/icons/pdf.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/mahasiswa/revisi"
                                class="hover:bg-slate-300 {{ $title == 'revisi' ? 'bg-red-200' : '' }}">
                                Revisi Sidang
                                <span>
                                    <img src="/storage/icons/logbook.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <button
                        class="flex items-center relative hover:bg-slate-300 {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">{{ Auth::user()->nama }}</p>
                        <span class="ml-3">
                            <img src="/storage/{{ isset(Auth::user()->mahasiswa->photo_profil) ? Auth::user()->mahasiswa->photo_profil : 'icons/user.png' }}"
                                class="w-7 h-7 rounded-full">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        <a href="/mahasiswa/profile" class="block px-4 py-2 hover:bg-slate-300 text-center">Profile</a>
                        <div class="container h-[1px] w-full bg-slate-500"></div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="hover:bg-slate-300 w-full py-2">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary">
            <div class="container w-max h-1"></div>
        </div>
    </header>

    <main class="mt-10 mb-20">
        @yield('content')
    </main>

    <footer class="fixed bottom-0 left-0 right-0 print:hidden">
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
