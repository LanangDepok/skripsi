@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Keputusan Kelulusan</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Nilai Akhir</th>
                    <th class="border-b border-slate-500 py-2">Status</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Bagas Rizkiyanto (2007412006)</td>
                    <td class="border-b border-slate-500 py-2 text-center">Lorem, ipsum dolor sit amet consectetur
                        adipisicing elit. Animi ex temporibus odit quos omnis cum molestias in, tempora eius sit expedita
                        quaerat ullam hic soluta, repellendus sed. At laborum repellat fuga esse consequatur rem, minima
                        ipsam eius ad, quisquam beatae quaerat. Asperiores eos tempore unde corporis hic voluptate,
                        voluptatem nesciunt!</td>
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                    <td class="border-b border-slate-500 py-2 text-center">Dosen 1</td>
                    <td id="nilaiPembimbing" type="number" step="0.1"
                        class="border-b border-slate-500 py-2 text-center">83.3</td>
                    <td class="border-b border-slate-500 py-2 text-center">Menunggu konfirmasi</td>
                    <td class="border-b border-slate-500">
                        <div>
                            <button
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto"><a
                                    href="/dosen/rekapitulasi/1">Detail</a></button>
                            <button id="revisiButton"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Revisi</button>
                        </div>
                        <div class="mt-5">
                            <button id="lulusButton"
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Luluskan</button>
                            <button
                                class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300 mx-auto">Tolak</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto my-10">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Masukkan revisi</p>
                    <textarea rows="5" class="w-full border-primary rounded-md border"></textarea>
                    <div class="w-24 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal2" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-10 bottom-10 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal2" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="border-4 border-black w-10 ml-auto mr-20">
                <p class="font-semibold text-2xl text-center">F9</p>
            </div>
            <div class="container w-1/2 mx-auto mt-4">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Apakah anda yakin untuk meluluskan?</p>
                    <p>Nama : Bagas Rizkiyanto</p><br>
                    <p>NIM : 2007412006</p><br>
                    <p>Program studi : Teknik Informatika</p><br>
                    <p>Judul : Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet adipisci commodi
                        officia quidem, est molestias asperiores iste quos saepe. Quaerat quae, sunt beatae at ut ea
                        repellendus libero dignissimos nobis, accusantium quibusdam minima optio consequatur sapiente
                        tempora, quia aut?</p><br>
                    <p>Nilai akhir : 83.3</p>
                    <div class="w-full h-8 mx-auto mt-10 flex justify-evenly">
                        <button type="submit"
                            class="bg-primary w-1/4 h-full rounded-md hover:text-black hover:bg-red-300">Luluskan</button>
                        <button type="submit"
                            class="bg-primary w-1/4 h-full rounded-md hover:text-black hover:bg-red-300">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const revisiButton = document.getElementById('revisiButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        revisiButton.addEventListener('click', function() {
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

        const lulusButton = document.getElementById('lulusButton');
        const exitModal2 = document.getElementById('exitModal2');
        const modal2 = document.getElementById('modal2');

        lulusButton.addEventListener('click', function() {
            modal2.classList.toggle('hidden');
        });
        exitModal2.addEventListener('click', function() {
            modal2.classList.toggle('hidden');
        });
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.classList.toggle('hidden');
            }
        }
    </script>
@endsection
