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
                @can('komite')
                    <div class="flex items-center">
                        <label for="program_studi" class="mr-3 text-white font-semibold">Role Saat ini:</label>
                        <select name="program_studi" id="program_studi" class="w-30 rounded-md"
                            onchange="redirectToPage(this)">
                            @if (Auth::user()->can('dosen_pembimbing') || Auth::user()->can('dosen_penguji') || Auth::user()->can('ketua_penguji'))
                                <option value="/dosen/index">Dosen</option>
                            @endif
                            <option value="/admin/index" selected>Komite</option>
                        </select>
                    </div>
                @endcan
            </div>
        </div>
        <div class="px-8">
            <div class="container mx-auto flex justify-between items-center">
                <div class="w-3/5">
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
                            <button type="button" id="pengajuanDropdownButton"
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
                        <li class="relative">
                            <button type="button" id="sidangDropdownButton"
                                class="hover:bg-slate-300 {{ $title == 'sidang' ? 'bg-red-200' : '' }}">
                                Pelaksanaan sidang
                                <span>
                                    <img src="/storage/icons/meeting.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </button>
                            <div class="absolute bg-slate-100 rounded-md shadow-md w-48 mt-2 hidden"
                                id="sidangDropdownContent">
                                <a href="/admin/pelaksanaan/sempro" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Sempro</a>
                                <div class="container h-[1px] w-full bg-slate-500"></div>
                                <a href="/admin/pelaksanaan/skripsi" class="block px-4 py-2 hover:bg-slate-300">Sidang
                                    Skripsi</a>
                            </div>
                        </li>
                        {{-- <li>
                            <a href="/admin/skripsi"
                                class="hover:bg-slate-300  {{ $title == 'skripsi' ? 'bg-red-200' : '' }}">
                                Pelaksanaan Sidang
                                <span>
                                    <img src="/storage/icons/meeting.png"
                                        class="w-3 h-3 inline-block -translate-y-[10%]">
                                </span>
                            </a>
                        </li> --}}
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
                    </ul>
                </div>
                <div class="relative">
                    <button class="flex items-center hover:bg-slate-300  {{ $title == 'profile' ? 'bg-red-200' : '' }}"
                        id="userDropdownButton">
                        <p class="truncate text-nowrap inline-block max-w-64">{{ Auth::user()->nama }}</p>
                        <span class="ml-3">
                            <img src="/storage/{{ isset(Auth::user()->dosen->photo_profil) ? Auth::user()->dosen->photo_profil : 'icons/user.png' }}"
                                class="w-7 h-7 rounded-full">
                        </span>
                    </button>
                    <div class="absolute bg-slate-100 rounded-md shadow-md w-32 mt-2 right-0 hidden"
                        id="userDropdownContent">
                        @can('komite')
                            <a href="/admin/profile" class="block px-4 py-2 hover:bg-slate-300 text-center">Profile</a>
                            <div class="container h-[1px] w-full bg-slate-500"></div>
                        @endcan
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

        const sidangDropdownButton = document.getElementById('sidangDropdownButton');
        const sidangDropdownContent = document.getElementById('sidangDropdownContent');
        sidangDropdownButton.addEventListener('click', function() {
            sidangDropdownContent.classList.toggle('hidden');
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
