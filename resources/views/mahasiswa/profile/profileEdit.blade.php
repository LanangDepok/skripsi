@extends('mahasiswa.template')

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
            <div class="mt-4">
                <label for="telp">No. Kontak</label>
                <input type="text" id="telp" name="telp" class="border-primary border block w-full rounded-md"
                    value="0895365145790">
            </div>
            <div class=" mt-4">
                <label for="ortu">Nama Orang Tua/Wali</label>
                <input type="text" id="ortu" name="ortu" class="border-primary border block w-full rounded-md"
                    value="myMother">
            </div>
            <div class=" mt-4">
                <label for="telp_ortu">No. Kontak Orang Tua/Wali</label>
                <input type="text" id="telp_ortu" name="telp_ortu" class="border-primary border block w-full rounded-md"
                    value="081380288665">
            </div>
            {{-- <div class=" mt-4">
                    <label for="tim">Anggota Tim</label>
                    <input type="text" id="tim" name="tim"
                        class="border-primary border block w-full rounded-md" value="Ilham, Kurniawan, Kurniadi">
                </div> --}}
            <div class="mt-8 flex justify-around">
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black"><a
                        href="/mahasiswa/profile">Kembali</a></button>
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black">Simpan</button>
            </div>
        </form>
    </div>
@endsection
