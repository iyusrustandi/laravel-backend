@extends('layouts.app')

@section('title', 'Tambah Data')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Data Baru</h1>

    <!-- Form untuk menambah data -->
    <form action="{{ route('data.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium">Alamat</label>
            <input type="text" name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium">Foto</label>
            <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="flex justify-end space-x-2">
            <button type="button" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>
@endsection
