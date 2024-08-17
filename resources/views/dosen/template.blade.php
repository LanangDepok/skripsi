<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo_pnj.png') }}">
    <title>scriptSI</title>
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
                        <img src="{{ asset('storage/assets/logo_pnj.png') }}" class="w-20 h-20">
                    </div>
                    <div class="ml-3">
                        <h3 class="text-4xl font-bold text-white">scriptSI</h3>
                    </div>
                </div>
                @can('komite')
                    <div class="flex items-center">
                        <label for="program_studi" class="mr-3 text-white font-semibold">Role Saat ini:</label>
                        <select name="program_studi" id="program_studi" class="w-30 rounded-md"
                            onchange="redirectToPage(this)">
                            <option value="{{ route('dsn.index') }}" selected>Dosen</option>
                            <option value="{{ route('adm.index') }}">Komite</option>
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
                            <a href="{{ route('dsn.index') }}"
                                class="hover:bg-slate-300 {{ $title == 'index' ? 'bg-red-200' : '' }}">
                                Home
                                <span>
                                    <img src="{{ asset('storage/icons/home.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        @can('dosen_pembimbing')
                            <li class="relative">
                                <button id="bimbinganDropdownButton"
                                    class="hover:bg-slate-300 {{ $title == 'bimbingan' ? 'bg-red-200' : '' }}">
                                    Bimbingan
                                    <span>
                                        <img src="{{ asset('storage/icons/presentation.png') }}"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </button>
                                <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                    id="bimbinganDropdownContent">
                                    <a href="{{ route('dsn.getLogbooks') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Pengajuan
                                        Logbook</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('dsn.getAllPersetujuanSidang') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Persetujuan
                                        Sidang</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('dsn.getAllListMahasiswa') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">List
                                        Mahasiswa</a>
                                </div>
                            </li>
                        @endcan
                        <li class="relative">
                            <button id="pengujianDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'pengujian' ? 'bg-red-200' : '' }}">
                                Pengujian
                                <span>
                                    <img src="{{ asset('storage/icons/contract.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                id="pengujianDropdownContent">
                                <a href="{{ route('dsn.getAllPengujianSempro') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    Proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('dsn.getAllPengujianSkripsi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                            </div>
                        </li>
                        @can('ketua_penguji')
                            <li>
                                <a href="{{ route('dsn.getAllRekapitulasi') }}"
                                    class="hover:bg-slate-300 {{ $title == 'rekapitulasi' ? 'bg-red-200' : '' }}">
                                    Rekapitulasi Nilai
                                    <span>
                                        <img src="{{ asset('storage/icons/open-book.png') }}"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dsn.getAllKelulusan') }}"
                                    class="hover:bg-slate-300 {{ $title == 'kelulusan' ? 'bg-red-200' : '' }}">
                                    Kelulusan
                                    <span>
                                        <img src="{{ asset('storage/icons/mortarboard.png') }}"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('dsn.getAllRevisi') }}"
                                class="hover:bg-slate-300 {{ $title == 'revisi' ? 'bg-red-200' : '' }}">
                                Pengajuan Revisi
                                <span>
                                    <img src="{{ asset('storage/icons/logbook.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button id="sidangDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'history' ? 'bg-red-200' : '' }}">
                                History
                                <span>
                                    <img src="{{ asset('storage/icons/history.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                id="sidangDropdownContent">
                                <a href="{{ route('dsn.historySempro') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    Proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('dsn.historySkripsi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                                @can('dosen_pembimbing')
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('dsn.historyLogbook') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Logbook</a>
                                @endcan
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <button class="flex items-center hover:bg-slate-300 {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">{{ Auth::user()->nama }}</p>
                        <span class="ml-3">
                            <img src="{{ asset('storage/' . (isset(Auth::user()->dosen->photo_profil) ? Auth::user()->dosen->photo_profil : 'icons/user.png')) }}"
                                class="w-7 h-7 rounded-full">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden dropdown-content"
                        id="userDropdownContent">
                        <a href="{{ route('dsn.getProfile') }}"
                            class="block px-4 py-2 hover:bg-slate-300 text-center">Profile</a>
                        <div class="container h-[1px] w-full bg-slate-500"></div>
                        <form method="POST" action="{{ route('keluar') }}">
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
        <div class="bg-slate-400 text-center">
            <p class="text-sm">Copyright &copy; - Designed & Developed by Politeknik Negeri Jakarta</p>
        </div>
    </footer>

</body>

<script>
    function closeAllDropdowns(except = null) {
        const dropdownContents = document.querySelectorAll('.dropdown-content');
        dropdownContents.forEach(content => {
            if (content !== except) {
                content.classList.add('hidden');
            }
        });
    }

    function toggleDropdown(button, content) {
        closeAllDropdowns(content);
        content.classList.toggle('hidden');
    }

    const userDropdownButton = document.getElementById('userDropdownButton');
    const userDropdownContent = document.getElementById('userDropdownContent');
    userDropdownButton.addEventListener('click', function() {
        toggleDropdown(userDropdownButton, userDropdownContent);
    });

    const pengujianDropdownButton = document.getElementById('pengujianDropdownButton');
    const pengujianDropdownContent = document.getElementById('pengujianDropdownContent');
    pengujianDropdownButton.addEventListener('click', function() {
        toggleDropdown(pengujianDropdownButton, pengujianDropdownContent);
    });

    const sidangDropdownButton = document.getElementById('sidangDropdownButton');
    const sidangDropdownContent = document.getElementById('sidangDropdownContent');
    sidangDropdownButton.addEventListener('click', function() {
        toggleDropdown(sidangDropdownButton, sidangDropdownContent);
    });

    const bimbinganDropdownButton = document.getElementById('bimbinganDropdownButton');
    const bimbinganDropdownContent = document.getElementById('bimbinganDropdownContent');
    bimbinganDropdownButton.addEventListener('click', function() {
        toggleDropdown(bimbinganDropdownButton, bimbinganDropdownContent);
    });

    //pindah role
    function redirectToPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var url = selectedOption.value;
        window.location.href = url;
    }
</script>

</html>
