@extends('mahasiswa.template')

@section('content')
    <div class="container mx-auto w-1/4 border-2 p-8 border-primary rounded-xl shadow-lg shadow-slate-400 mt-8">
        <form>
            <div>
                <h2 class="text-xl font-semibold text-center underline">Edit Skripsi</h2>
            </div>
            <div class="mt-4">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="ini adalah judul">
            </div>
            <div class=" mt-4">
                <label for="sub_judul">Sub Judul</label>
                <input type="text" id="sub_judul" name="sub_judul"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="ini adalah sub judul">
            </div>
            <div class=" mt-4">
                <label for="anggota_tim">Anggota Tim (pisah menggunakan tanda koma, ex: ilham, dani, budi)</label>
                <input type="text" id="anggota_tim" name="anggota_tim"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100"
                    value="kurniawan, kurniadi, ilham">
            </div>
            <div class=" mt-4">
                <label for="skripsi">Skripsi</label>
                <input type="file" id="skripsi" name="skripsi"
                    class="block w-full border border-primary rounded-md focus:bg-red-100 hover:bg-red-100">
            </div>
            <div class="mt-8 flex justify-around">
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black"><a
                        href="/mahasiswa/skripsi">Kembali</a></button>
                <button class="bg-primary text-white w-20 rounded-xl p-1 hover:bg-red-300 hover:text-black">Simpan</button>
            </div>
        </form>
    </div>
@endsection
