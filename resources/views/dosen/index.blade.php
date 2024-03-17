@extends('dosen.template')

@section('content')
    <div class="container text-center mx-auto w-3/4">
        {{-- <button id="editButton"
            class="bg-primary text-white w-40 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
            type="submit">Edit Konten</button> --}}
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Timeline Skripsi</h2>
            {{-- <button class="bg-primary text-white w-24 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
                type="submit">Edit</button> --}}
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/assets/timeline_skripsi.jpg" class="w-full">
    </div>
    <div class="container text-center mx-auto w-3/4 mt-24">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Alur Skripsi</h2>
            {{-- <button class="bg-primary text-white w-24 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
                type="submit">Edit</button> --}}
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/assets/alur_skripsi.jpg" class="w-full">
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <div class="container w-1/2 mx-auto">
                <p class="text-center mb-5 font-semibold text-xl">Edit Konten</p>
                <div>
                    <label for="dosen_pembimbing1">Timeline Skripsi</label>
                    <input type="file" class="w-full rounded-md border border-primary">
                </div>
                <div class="mt-4">
                    <label for="dosen_pembimbing1">Alur Skripsi</label>
                    <input type="file" class="w-full rounded-md border border-primary">
                </div>
                <div class="w-24 h-8 mx-auto mt-10">
                    <button type="submit"
                        class="bg-primary w-full h-full rounded-md hover:text-black hover:bg-red-300">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editButton = document.getElementById('editButton');
        const exitModal = document.getElementById('exitModal');
        const modal = document.getElementById('modal');

        editButton.addEventListener('click', function() {
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
