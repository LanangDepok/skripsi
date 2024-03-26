@extends('mahasiswa.template')

@section('content')
    <p class="text-center font-semibold text-2xl text-primary">Daftar Revisi</p>
    <div class="container mx-auto mt-6">
        <table class="table-fixed mx-auto border-2 border-collapse border-slate-500 w-full">
            <thead class="bg-primary">
                <tr>
                    <th class="border-b border-slate-500 py-2">Judul</th>
                    {{-- <th class="border-b border-slate-500 py-2">Dosen Pembimbing</th> --}}
                    {{-- <th class="border-b border-slate-500 py-2">Prodi</th> --}}
                    <th class="border-b border-slate-500 py-2">Dosen Penguji</th>
                    <th class="border-b border-slate-500 py-2">Revisi</th>
                    <th class="border-b border-slate-500 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-slate-300">
                    <td class="border-b border-slate-500 py-2 text-center">Lorem, ipsum dolor sit amet consectetur
                        adipisicing elit. Animi ex temporibus odit quos omnis cum molestias in, tempora eius sit expedita
                        quaerat ullam hic soluta, repellendus sed. At laborum repellat fuga esse consequatur rem, minima
                        ipsam eius ad, quisquam beatae quaerat. Asperiores eos tempore unde corporis hic voluptate,
                        voluptatem nesciunt!</td>
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Pak Anggi</td> --}}
                    {{-- <td class="border-b border-slate-500 py-2 text-center">Teknik Informatika</td> --}}
                    <td class="border-b border-slate-500 py-2 text-center">Pak penguji 1, pak penguji 2, pak penguji 3</td>
                    <td id="nilaiPembimbing" type="number" step="0.1"
                        class="border-b border-slate-500 py-2 text-center">Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Voluptates unde voluptate ducimus iste eligendi at sint nobis blanditiis saepe.
                        Aliquid libero, modi ea quia cupiditate enim corrupti necessitatibus odio exercitationem tenetur qui
                        laborum. Qui consequuntur maiores minus sit similique enim debitis illo repellat velit quia odit a
                        quis, omnis amet!</td>
                    <td class="border-b border-slate-500 text-center">
                        {{-- <button class="bg-primary border rounded-md w-20 text-white hover:text-black hover:bg-red-300"><a
                                href="/mahasiswa/revisi/1">Detail</a></button> --}}
                        <button id="revisiButton"
                            class="bg-primary border rounded-md w-32 text-white hover:text-black hover:bg-red-300">Konfirmasi
                            Revisi</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    {{-- <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto my-10">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Tuliskan hasil revisi</p>
                    <textarea rows="5" class="w-full border-primary rounded-md border"></textarea>
                    <div class="w-24 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Kirim</button>
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
    </script> --}}
@endsection
