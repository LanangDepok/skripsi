@extends('dosen.template')

@section('content')
    @if (session('messages'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center"
            role="alert">
            <span class="font-medium">Error!</span> {{ session('messages') }}
        </div>
    @endif
    <div class="container mx-auto w-2/3 flex justify-end">
        <button id="editButton" class="rounded-lg bg-primary p-2 px-4 text-white hover:text-black hover:bg-red-300">
            Edit Biodata
        </button>
    </div>
    <div
        class="container mx-auto w-2/3 mt-2 flex rounded-lg border-2 border-primary p-6 shadow-slate-400 shadow-lg justify-around">
        <img src="/storage/{{ isset(Auth::user()->dosen->photo_profil) ? Auth::user()->dosen->photo_profil : 'icons/user.png' }}"
            class="w-40 h-40 rounded-full my-auto">
        <div>
            <p>Email : {{ Auth::user()->email }}</p>
            <p>Nama : {{ Auth::user()->nama }}</p>
            <p>NIP : {{ Auth::user()->dosen->nip }}</p>
            <p>Jabatan : {{ Auth::user()->dosen->jabatan }}</p>
            <p>Fungsional: {{ Auth::user()->dosen->fungsional }}</p>
            <p>Fungsioanl: {{ Auth::user()->dosen->gol_pangkat }}</p>
            <p>Role: {{ Auth::user()->roles->pluck('nama')->implode(', ') }}</p>
        </div>
        <img src="/storage/{{ Auth::user()->dosen->tanda_tangan }}" class="max-h-24 max-w-56 my-auto"
            alt="(Belum ada tanda tangan)">
    </div>


    {{-- Modal --}}
    <div id="modal" class="fixed bg-slate-800 top-0 bottom-0 right-0 left-0 bg-opacity-75 z-[1] hidden">
        <div class="fixed bg-white top-48 bottom-48 left-96 right-96 z-10 rounded-lg">
            <div class="w-7 ml-auto">
                <button type="button" id="exitModal" class="text-3xl font-extrabold text-slate-800">X</button>
            </div>
            <form method="POST" action="/dosen/profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
                @csrf
                <div class="container w-1/2 mx-auto">
                    <p class="text-center mb-5 font-semibold text-xl">Edit Profil</p>
                    <div>
                        <label>Photo Profil (PNG, JPG, JPEG)</label>
                        <input name="photo_profil" type="file" class="w-full rounded-md border border-primary">
                    </div>
                    <div class="mt-4">
                        <label>Tanda Tangan (PNG, JPG, JPEG)</label>
                        <input name="tanda_tangan" type="file" class="w-full rounded-md border border-primary">
                    </div>
                    <div class="w-24 h-8 mx-auto mt-10">
                        @method('PUT')
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
