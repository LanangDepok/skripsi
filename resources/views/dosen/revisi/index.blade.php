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
            <div class="border-4 border-black w-12 ml-auto mr-16">
                <p class="font-semibold text-2xl text-center">F10</p>
            </div>
            <div class="container w-1/2 mx-auto">
                <form method="POST" action="/admin/pengajuan/judul/store">
                    @csrf
                    <p class="text-center mb-5 font-semibold text-xl">Hasil revisi</p>
                    <textarea rows="5" class="w-full border-primary rounded-md border" disabled> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi consectetur laborum ducimus repudiandae, perferendis suscipit maxime earum voluptatem iste? Sequi iste ducimus, neque asperiores aperiam ut perspiciatis enim reiciendis quo ab, nostrum ipsum expedita maxime beatae temporibus laboriosam deleniti odio rerum rem sapiente eius. Voluptatum molestias ut repellat qui earum magni suscipit quibusdam provident eius unde facilis velit maiores aut quae nihil enim, iusto cumque sint laborum consectetur? Quasi cum distinctio sunt, in, velit architecto deleniti ab veniam quo excepturi enim repellat nobis dignissimos assumenda! Molestias placeat illum eveniet possimus distinctio esse, ducimus eum, voluptatem dolores eius vero fuga totam!</textarea>
                    <div class="w-24 h-8 mx-auto mt-4">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Terima</button>
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
