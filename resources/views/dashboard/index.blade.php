@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="antialiased bg-gray-50 dark:bg-gray-900">
    <div class="row-gap-8 grid grid-cols-2 md:grid-cols-4">
        
        <!-- Data 1 -->
        <div class="mb-12 text-center md:mb-0 md:border-r-2 dark:bg-gray-900 bg-slate-400 dark:md:border-slate-500">
            <div class="font-heading text-[2.6rem] font-bold dark:text-white lg:text-5xl xl:text-6xl">
                {{ count($data) }} <!-- Menampilkan jumlah data -->
            </div>
            <p class="text-sm font-medium uppercase tracking-widest text-gray-800 dark:text-slate-400 lg:text-base">
                Data1
            </p>
        </div>
        
        <!-- Data 2 -->
        <div class="mb-12 text-center md:mb-0 md:border-r-2 dark:bg-gray-900 bg-orange-400 dark:md:border-slate-500">
            <div class="font-heading text-[2.6rem] font-bold dark:text-white lg:text-5xl xl:text-6xl">
                {{ $data->count() }} <!-- Menampilkan jumlah data -->
            </div>
            <p class="text-sm font-medium uppercase tracking-widest text-gray-800 dark:text-slate-400 lg:text-base">
                Data2
            </p>
        </div>

        <!-- Data 3 -->
        <div class="mb-12 text-center md:mb-0 md:border-r-2 dark:bg-gray-900 bg-yellow-400 dark:md:border-slate-500">
            <div class="font-heading text-[2.6rem] font-bold dark:text-white lg:text-5xl xl:text-6xl">
                {{ $data->sum('id') }} <!-- Menggunakan kolom numerik -->
            </div>
            <p class="text-sm font-medium uppercase tracking-widest text-gray-800 dark:text-slate-400 lg:text-base">
                Data3
            </p>
        </div>

        <!-- Users -->
        <div class="mb-12 text-center md:mb-0 md:border-r-2 dark:bg-gray-900 bg-emerald-400 dark:md:border-slate-500">
            <div class="font-heading text-[2.6rem] font-bold dark:text-white lg:text-5xl xl:text-6xl">
                {{ count($data) }} <!-- Menampilkan jumlah data Users -->
            </div>
            <p class="text-sm font-medium uppercase tracking-widest text-gray-800 dark:text-slate-400 lg:text-base">
                Users
            </p>
        </div>
    </div>

    <!-- Menampilkan Data dalam tabel -->
    {{-- <div class="mt-10">
        <h2 class="text-2xl font-bold">Data Table</h2>
        <table class="w-full border-collapse border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Alamat</th>
                    <th class="border border-gray-300 px-4 py-2">Foto</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->address }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto" class="w-16 h-16 object-cover rounded">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center border border-gray-300 px-4 py-2">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> --}}
</div>
@endsection
