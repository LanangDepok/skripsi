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
            <div class="container mx-auto flex justify-between">
                <div class="flex items-center">
                    <div>
                        <img src="/storage/assets/logo_pnj.png" class="w-20 h-20">
                    </div>
                    <div class="ml-3">
                        <h3 class="text-4xl font-bold text-white">Politeknik Negeri Jakarta</h3>
                    </div>
                </div>
                @can('komite')
                    <div class="flex items-center">
                        <label for="program_studi" class="mr-3 text-white font-semibold">Role Saat ini:</label>
                        <select name="program_studi" id="program_studi" class="w-30 rounded-md"
                            onchange="redirectToPage(this)">
                            <option value="/dosen/index" selected>Dosen</option>
                            <option value="/admin/index">Komite</option>
                        </select>
                    </div>
                @endcan
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between items-center">
                <div class="w-4/5">
                    <ul class="flex justify-between">
                        <li>
                            <a href="/dosen/index"
                                class="hover:bg-slate-300 {{ $title == 'index' ? 'bg-red-200' : '' }}">
                                Home
                                <span>
                                    <img src="/storage/icons/home.png" class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        @can('dosen_pembimbing')
                            <li class="relative">
                                <button id="bimbinganDropdownButton"
                                    class="hover:bg-slate-300 {{ $title == 'bimbingan' ? 'bg-red-200' : '' }}">
                                    Bimbingan
                                    <span>
                                        <img src="/storage/icons/presentation.png"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </button>
                                <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                    id="bimbinganDropdownContent">
                                    <a href="/dosen/bimbingan/logbook" class="block px-4 py-2 hover:bg-slate-300">Pengajuan
                                        Logbook</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="/dosen/bimbingan/persetujuanSidang"
                                        class="block px-4 py-2 hover:bg-slate-300">Persetujuan
                                        Sidang</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="/dosen/bimbingan/listMahasiswa" class="block px-4 py-2 hover:bg-slate-300">List
                                        Mahasiswa</a>
                                </div>
                            </li>
                        @endcan
                        <li class="relative">
                            <button id="pengujianDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'pengujian' ? 'bg-red-200' : '' }}">
                                Pengujian
                                <span>
                                    <img src="/storage/icons/contract.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="pengujianDropdownContent">
                                <a href="/dosen/pengujian/sempro" class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    Proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/dosen/pengujian/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                            </div>
                        </li>
                        @can('ketua_penguji')
                            <li>
                                <a href="/dosen/rekapitulasi"
                                    class="hover:bg-slate-300 {{ $title == 'rekapitulasi' ? 'bg-red-200' : '' }}">
                                    Rekapitulasi Nilai
                                    <span>
                                        <img src="/storage/icons/open-book.png"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="/dosen/kelulusan"
                                    class="hover:bg-slate-300 {{ $title == 'kelulusan' ? 'bg-red-200' : '' }}">
                                    Kelulusan
                                    <span>
                                        <img src="/storage/icons/mortarboard.png"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="/dosen/revisi"
                                class="hover:bg-slate-300 {{ $title == 'revisi' ? 'bg-red-200' : '' }}">
                                Pengajuan Revisi
                                <span>
                                    <img src="/storage/icons/logbook.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button type="button" id="sidangDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'history' ? 'bg-red-200' : '' }}">
                                History
                                <span>
                                    <img src="/storage/icons/history.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="sidangDropdownContent">
                                <a href="/dosen/history/sempro" class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    Proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/dosen/history/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/dosen/history/logbook" class="block px-4 py-2 hover:bg-slate-300">Logbook</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <button class="flex items-center hover:bg-slate-300 {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">{{ Auth::user()->nama }}</p>
                        <span class="ml-3">
                            <img src="/storage/{{ isset(Auth::user()->dosen->photo_profil) ? Auth::user()->dosen->photo_profil : 'icons/user.png' }}"
                                class="w-7 h-7 rounded-full">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        <a href="/dosen/profile" class="block px-4 py-2 hover:bg-slate-300 text-center">Profile</a>
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
</script>
<script>
    const pengujianDropdownButton = document.getElementById('pengujianDropdownButton');
    const pengujianDropdownContent = document.getElementById('pengujianDropdownContent');
    pengujianDropdownButton.addEventListener('click', function() {
        pengujianDropdownContent.classList.toggle('hidden');
    });
</script>
<script>
    const pengajuanDropdownButton = document.getElementById('pengajuanDropdownButton');
    const pengajuanDropdownContent = document.getElementById('pengajuanDropdownContent');
    pengajuanDropdownButton.addEventListener('click', function() {
        pengajuanDropdownContent.classList.toggle('hidden');
    });
</script>
<script>
    const sidangDropdownButton = document.getElementById('sidangDropdownButton');
    const sidangDropdownContent = document.getElementById('sidangDropdownContent');
    sidangDropdownButton.addEventListener('click', function() {
        sidangDropdownContent.classList.toggle('hidden');
    });
</script>
<script>
    //pindah role
    function redirectToPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var url = selectedOption.value;
        window.location.href = url;
    }
</script>
<script>
    const bimbinganDropdownButton = document.getElementById('bimbinganDropdownButton');
    const bimbinganDropdownContent = document.getElementById('bimbinganDropdownContent');
    bimbinganDropdownButton.addEventListener('click', function() {
        bimbinganDropdownContent.classList.toggle('hidden');
    });
</script>

</html>
