@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Daftar Pengajuan Revisi</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama (NIM)</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Program Studi</th>
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Nilai Akhir</th>
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
                    <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td>
                    <td class="border-b border-slate-500 py-2 text-center">Dosen 1</td>
                    <td id="nilaiPembimbing" type="number" step="0.1"
                        class="border-b border-slate-500 py-2 text-center">83.3</td>
                    <td class="border-b border-slate-500 text-center">
                        <button class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/revisi/1">Detail</a></button>
                        <button id="revisiButton"
                            class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300">Terima</button>
                        <button id="revisiButton"
                            class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300">Tolak</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-10 bottom-10 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-3/4 mx-auto mt-10">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p>Nama (NIM): Bagas Rizkiyanto (2007412006)</p>
                    <p>Program Studi: Teknik Informatika</p>
                    <p>Program Studi: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nesciunt nostrum dolorem
                        laudantium assumenda non, consectetur vero ea quibusdam ut numquam atque, autem et obcaecati odit
                        recusandae impedit, velit dolores!</p>
                    <p>Tanggal sidang: {{ now()->translatedFormat('l, d F Y') }}</p>
                    <label for="pointA" class="font-bold">A. Revisi Alat/Program Aplikasi Skripsi</label>
                    <textarea id="pointA" rows="5" class="w-full border-primary rounded-md border" disabled>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum doloribus consequuntur atque debitis hic? Numquam iure libero, porro fuga mollitia ut tenetur ipsa earum deleniti repellat assumenda et corporis adipisci.</textarea>
                    <label for="pointB" class="font-bold">A. Revisi Laporan Skripsi</label>
                    <textarea id="pointB" rows="5" class="w-full border-primary rounded-md border" disabled>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas amet sunt, vero recusandae eligendi omnis sint possimus minus nemo, totam sit necessitatibus? Nisi architecto animi voluptates labore id asperiores nam!</textarea>
                    <div class="w-32 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md text-white hover:text-black hover:bg-red-300">Terima
                            Revisi</button>
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
    </script>
@endsection
