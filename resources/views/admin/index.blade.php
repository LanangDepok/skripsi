@extends('admin.template')

@section('content')
    <div class="container text-center mx-auto w-3/4">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Timeline Skripsi</h2>
            <button class="bg-primary text-white w-24 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
                type="submit">Edit</button>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/assets/timeline_skripsi.jpg" class="w-full">
    </div>
    <div class="container text-center mx-auto w-3/4 mt-24">
        <div class="flex justify-between">
            <h2 class="text-2xl text-primary text-left font-semibold">Alur Skripsi</h2>
            <button class="bg-primary text-white w-24 h-8 my-auto rounded-2xl text-2xl hover:text-black hover:bg-red-300"
                type="submit">Edit</button>
        </div>
        <div class="bg-primary container h-1 mb-5 mt-2"></div>
        <img src="/storage/assets/alur_skripsi.jpg" class="w-full">
    </div>
@endsection
