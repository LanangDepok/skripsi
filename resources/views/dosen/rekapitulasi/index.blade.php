@extends('dosen.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Nilai Akhir</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Nama</th>
                    <th class="border-b border-slate-500 py-2">NIM</th>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Rata-rata Nilai Penguji</th>
                    <th class="border-b border-slate-500 py-2">Nilai Pembimbing</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
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
                    <td id="nilaiPenguji" type="number" step="0.1" class="border-b border-slate-500 py-2 text-center">
                        80</td>
                    <td id="nilaiPembimbing" type="number" step="0.1"
                        class="border-b border-slate-500 py-2 text-center">90</td>
                    <td class="text-center  border-b border-slate-500">
                        <button class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300"><a
                                href="/dosen/rekapitulasi/1">Detail</a></button>
                        <button id="terimaButton"
                            class="bg-primary border rounded-md w-16 text-white hover:text-black hover:bg-red-300">Rekap</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1]">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto my-10">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Nilai Akhir</p>
                    <p class="text-center mb-1 font-semibold text-sm underline underline-offset-8">(Nilai rata-rata penguji
                        &times; 2) + Nilai
                        pembimbing</p>
                    <p class="text-sm text-center font-semibold">3</p>
                    <input id="nilaiTotal" type="text" disabled class="border border-primary w-full rounded-md mt-5">
                    <div class="w-24 h-8 mx-auto mt-10">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
                    </div>
                </form>
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

        function hitungNilaiTotal() {
            var nilaiPenguji = parseFloat(document.getElementById('nilaiPenguji').innerText) || 0;
            var nilaiPembimbing = parseFloat(document.getElementById('nilaiPembimbing').innerText) || 0;
            var nilaiTotal = ((nilaiPenguji * 2) + nilaiPembimbing) / 3;
            document.getElementById('nilaiTotal').value = nilaiTotal.toFixed(1);
        }
        hitungNilaiTotal();
    </script>
@endsection
