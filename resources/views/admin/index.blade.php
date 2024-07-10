@extends('admin.template')

@section('content')
    @error('timeline_skripsi')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
            role="alert">
            <span class="font-medium">Error!</span>Timeline skripsi harus memiliki format antara jpg, jpeg, png.
        </div>
    @enderror
    @error('alur_skripsi')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
            role="alert">
            <span class="font-medium">Error!</span>Alur skripsi harus memiliki format antara jpg, jpeg, png.
        </div>
    @enderror
    <div class="container text-center mx-auto w-3/4">
        <button id="editButton"
            class="bg-primary text-white w-40 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
            type="submit">Edit Konten</button>
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Timeline Skripsi</h2>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        @isset($konten)
        @endisset
        <img src="/storage/{{ $konten[0]->gambar }}" class="w-full">
    </div>
    <div class="container text-center mx-auto w-3/4 mt-24">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Alur Skripsi</h2>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/{{ $konten[1]->gambar }}" class="w-full">
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <form method="POST" action="{{ route('adm.updateKonten') }}" enctype="multipart/form-data">
                @csrf
                <div class="container w-1/2 mx-auto">
                    <p class="text-center mb-5 font-semibold text-xl">Edit Konten</p>
                    <div>
                        <label>Timeline Skripsi (jpg,jpeg,png)</label>
                        <input name="timeline_skripsi" type="file" class="w-full rounded-md border border-primary">
                    </div>
                    <div class="mt-4">
                        <label>Alur Skripsi (jpg,jpeg,png)</label>
                        <input name="alur_skripsi" type="file" class="w-full rounded-md border border-primary">
                    </div>
                    <div class="w-24 h-8 mx-auto mt-10">
                        <button type="submit"
                            class="bg-primary w-full h-full rounded-md text-white hover:text-black hover:bg-red-300">Simpan</button>
                    </div>
                </div>
            </form>
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
