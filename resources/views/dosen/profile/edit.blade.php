@extends('dosen.template')

@section('content')
    <div class="container mx-auto w-1/4 border-2 p-8 border-primary rounded-xl shadow-lg shadow-slate-400 mt-8">
        <form>
            <div>
                <h2 class="text-xl font-semibold text-center underline">Edit Profil</h2>
            </div>
            <div class="mt-4">
                <label for="photo_profile">Foto Profil</label>
                <input type="file" id="photo_profile" name="photo_profile"
                    class="border-primary border block w-full rounded-md">
            </div>
            <div class="mt-4">
                <label for="signature">Tanda Tangan</label>
                <input type="file" id="signature" name="signature" class="border-primary border block w-full rounded-md">
            </div>
            <div class="mt-8 flex justify-around">
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black"><a
                        href="/dosen/profile">Kembali</a></button>
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black">Simpan</button>
            </div>
        </form>
    </div>
@endsection
