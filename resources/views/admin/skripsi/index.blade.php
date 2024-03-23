@extends('admin.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Pelaksanaan Sidang</p>
    <div class="container mx-auto px-10 bg-slate-200 mt-2">
        <p class="font-semibold text-lg">Filter by:</p>
        <div class="flex justify-evenly items-center">
            <div>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" class="w-56">
            </div>
            <div>
                <label for="program_studi">Program Studi:</label>
                <select name="program_studi" id="program_studi" class="w-56">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Multimedia Digital">Teknik Multimedia dan Digital</option>
                    <option value="Teknik Multimedia Digital">Teknik Multimedia dan Jaringan</option>
                </select>
            </div>
            <div>
                <label for="program_studi">Status:</label>
                <select name="program_studi" id="program_studi" class="w-56">
                    <option value="Teknik Informatika">Selesai</option>
                    <option value="Teknik Multimedia Digital">Belum Selesai</option>
                </select>
            </div>
            <button class="bg-primary rounded-lg w-20 h-7 text-white hover:text-black hover:bg-red-300">Cari</button>
        </div>
    </div>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama</th>
                    <th class="border-b border-slate-500 py-2">NIM</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Jenis</th>
                    <th class="border-b border-slate-500 py-2">Pelaksanaan</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto</td>
                    <td class="border-b border-slate-500 py-2 text-center">2007412006</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem, ipsum dolor sit amet consectetur
                        adipisicing elit. Animi ex temporibus odit quos omnis cum molestias in, tempora eius sit expedita
                        quaerat ullam hic soluta, repellendus sed. At laborum repellat fuga esse consequatur rem, minima
                        ipsam eius ad, quisquam beatae quaerat. Asperiores eos tempore unde corporis hic voluptate,
                        voluptatem nesciunt!</td>
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                    <td class="border-b border-slate-500 py-2 text-center">Dosen 1</td>
                    <td class="border-b border-slate-500 py-2 text-center">Sidang Skripsi</td>
                    <td class="border-b border-slate-500 py-2 text-center">7 August 2024</td>
                    <td class="border-b border-slate-500 py-2 text-center">Belum Selesai</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-36 bottom-36 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto">
                <p class="text-center mb-5 font-semibold text-xl">Pilih Dosen Penguji</p>
                <div>
                    <label for="dosen_pembimbing1">Dosen Pilihan 1 (Ketua Penguji)</label>
                    <select name="dosen_pembimbing1" id="dosen_pembimbing" class="w-full rounded-md border border-primary">
                        <option value="volvo">Dosen 1</option>
                        <option value="saab">Dosen 2</option>
                        <option value="mercedes">Dosen 3</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="dosen_pembimbing2">Dosen Pilihan 2</label>
                    <select name="dosen_pembimbing2" id="dosen_pembimbing" class="w-full rounded-md border border-primary">
                        <option value="saab">Dosen 2</option>
                        <option value="volvo">Dosen 1</option>
                        <option value="mercedes">Dosen 3</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="dosen_pembimbing3">Dosen Pilihan 3</label>
                    <select name="dosen_pembimbing3" id="dosen_pembimbing" class="w-full rounded-md border border-primary">
                        <option value="mercedes">Dosen 3</option>
                        <option value="volvo">Dosen 1</option>
                        <option value="saab">Dosen 2</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="tanggal">Pilih Tanggal Sidang</label>
                    <input id="tanggal" type="date" class="w-full rounded-md border border-primary">
                </div>
                <div class="w-24 h-8 mx-auto mt-10">
                    <button type="submit"
                        class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const terimaButton = document.getElementById('terimaButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        terimaButton.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });
        exitModal.addEventListener('click', function() {
            modal.classList.toggle('hidden');
        });
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.toggle('hidden');
            }
        }
    </script>
@endsection
