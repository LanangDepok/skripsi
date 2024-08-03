<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo_pnj.png') }}">
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
                        <img src="{{ asset('storage/assets/logo_pnj.png') }}" class="w-20 h-20">
                    </div>
                    <div class="ml-3">
                        <h3 class="text-4xl font-bold text-white">Politeknik Negeri Jakarta</h3>
                    </div>
                </div>
                @canany(['dosen_penguji', 'dosen_pembimbing'])
                    <div class="flex items-center">
                        <label for="program_studi" class="mr-3 text-white font-semibold">Role Saat ini:</label>
                        <select name="program_studi" id="program_studi" class="w-30 rounded-md"
                            onchange="redirectToPage(this)">
                            @if (Auth::user()->can('dosen_pembimbing') || Auth::user()->can('dosen_penguji') || Auth::user()->can('ketua_penguji'))
                                <option value="{{ route('dsn.index') }}">Dosen</option>
                            @endif
                            <option value="{{ route('adm.index') }}" selected>Komite</option>
                        </select>
                    </div>
                @endcanany
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between items-center">
                <div class="w-4/5">
                    <ul class="flex justify-between">
                        <li>
                            <a href="{{ route('adm.index') }}"
                                class="hover:bg-slate-300 {{ $title == 'index' ? 'bg-red-200' : '' }}">
                                Home
                                <span>
                                    <img src="{{ asset('storage/icons/home.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.getStudents') }}"
                                class="hover:bg-slate-300 {{ $title == 'mahasiswa' ? 'bg-red-200' : '' }}">
                                Mahasiswa
                                <span>
                                    <img src="{{ asset('storage/icons/group.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.getLecturers') }}"
                                class="hover:bg-slate-300  {{ $title == 'dosen' ? 'bg-red-200' : '' }}">
                                Dosen
                                <span>
                                    <img src="{{ asset('storage/icons/presentation.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button type="button" id="pengajuanDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'pengajuan' ? 'bg-red-200' : '' }}">
                                Pengajuan
                                <span>
                                    <img src="{{ asset('storage/icons/contract.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                id="pengajuanDropdownContent">
                                <a href="{{ route('adm.pengajuanJudul') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Judul &
                                    pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.pengajuanSempro') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.pengajuanSkripsi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.pengajuanAlat') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Serah
                                    terima alat & skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.pengajuanKompetensi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Kompetensi</a>
                            </div>
                        </li>
                        <li class="relative">
                            <button type="button" id="sidangDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'sidang' ? 'bg-red-200' : '' }}">
                                Monitoring Pengajuan
                                <span>
                                    <img src="{{ asset('storage/icons/meeting.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                id="sidangDropdownContent">
                                <a href="{{ route('adm.getAllJudul') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Judul & Pembimbing</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.getAllSempro') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Seminar
                                    Proposal</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.getAllSkripsi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.getAllAlat') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Serah
                                    terima alat & skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.getAllKompetensi') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Kompetensi</a>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('adm.getAllRevisi') }}"
                                class="hover:bg-slate-300  {{ $title == 'revisi' ? 'bg-red-200' : '' }}">
                                Penerimaan Revisi
                                <span>
                                    <img src="{{ asset('storage/icons/revision.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li>
                        <li class="relative">
                            <button type="button" id="reportDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'report' ? 'bg-red-200' : '' }}">
                                Report Akhir
                                <span>
                                    <img src="{{ asset('storage/icons/excel.png') }}"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                id="reportDropdownContent">
                                <a href="{{ route('adm.reportAkhir') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Data skripsi</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="{{ route('adm.kompetensiAkhir') }}"
                                    class="block px-4 py-2 hover:bg-slate-300">Data kompetensi</a>
                            </div>
                        </li>
                        @can('admin')
                            <li class="relative">
                                <button type="button" id="databaseDropdownButton"
                                    class="hover:bg-slate-300 {{ $title == 'database' ? 'bg-red-200' : '' }}">
                                    Database
                                    <span>
                                        <img src="{{ asset('storage/icons/database.png') }}"
                                            class="w-3 h-3 inline-block -translate-y-[10%]">
                                    </span>
                                </button>
                                <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden dropdown-content"
                                    id="databaseDropdownContent">
                                    <a href="{{ route('adm.getAllTahunAjaran') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Tahun
                                        Ajaran</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('adm.getAllKelas') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Kelas</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('adm.getAllProgramStudi') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Program
                                        Studi</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('adm.getAllJabatan') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Jabatan</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('adm.getAllJabatanFungsional') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Jabatan
                                        Fungsional</a>
                                    <div class="container h-[1px] w-full bg-slate-500"></div>
                                    <a href="{{ route('adm.getAllPangkatGolongan') }}"
                                        class="block px-4 py-2 hover:bg-slate-300">Pangkat
                                        Golongan</a>
                                </div>
                            </li>
                        @endcan
                    </ul>
                </div>
                <div class="relative">
                    <button
                        class="flex items-center hover:bg-slate-300  {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">{{ Auth::user()->nama }}</p>
                        <span class="ml-3">
                            <img src="{{ asset('storage/' . (isset(Auth::user()->dosen->photo_profil) ? Auth::user()->dosen->photo_profil : 'icons/user.png')) }}"
                                class="w-7 h-7 rounded-full">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden dropdown-content"
                        id="userDropdownContent">
                        @can('komite')
                            <a href="{{ route('adm.getProfile') }}"
                                class="block px-4 py-2 hover:bg-slate-300 text-center">Profile</a>
                            <div class="container h-[1px] w-full bg-slate-500"></div>
                        @endcan
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

    <main class="mt-10">
        @yield('content')
    </main>

    <div class="mb-20"></div>
    <footer class="fixed bottom-0 left-0 right-0">
        <div class="bg-slate-400 text-center">
            <p class="text-sm">Copyright &copy; - Designed & Developed by Politeknik Negeri Jakarta</p>
        </div>
    </footer>

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

        const pengajuanDropdownButton = document.getElementById('pengajuanDropdownButton');
        const pengajuanDropdownContent = document.getElementById('pengajuanDropdownContent');
        pengajuanDropdownButton.addEventListener('click', function() {
            toggleDropdown(pengajuanDropdownButton, pengajuanDropdownContent);
        });

        const sidangDropdownButton = document.getElementById('sidangDropdownButton');
        const sidangDropdownContent = document.getElementById('sidangDropdownContent');
        sidangDropdownButton.addEventListener('click', function() {
            toggleDropdown(sidangDropdownButton, sidangDropdownContent);
        });

        const userDropdownButton = document.getElementById('userDropdownButton');
        const userDropdownContent = document.getElementById('userDropdownContent');
        userDropdownButton.addEventListener('click', function() {
            toggleDropdown(userDropdownButton, userDropdownContent);
        });

        const reportDropdownButton = document.getElementById('reportDropdownButton');
        const reportDropdownContent = document.getElementById('reportDropdownContent');
        reportDropdownButton.addEventListener('click', function() {
            toggleDropdown(reportDropdownButton, reportDropdownContent);
        });

        @can('admin')
            const databaseDropdownButton = document.getElementById('databaseDropdownButton');
            const databaseDropdownContent = document.getElementById('databaseDropdownContent');
            databaseDropdownButton.addEventListener('click', function() {
                toggleDropdown(databaseDropdownButton, databaseDropdownContent);
            });
        @endcan

        @can('komite')
            //pindah role
            function redirectToPage(select) {
                var selectedOption = select.options[select.selectedIndex];
                var url = selectedOption.value;
                window.location.href = url;
            }
        @endcan
    </script>


</body>

</html>
