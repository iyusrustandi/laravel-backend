@extends('layouts.app')

@section('title', 'Data Index')

@section('content')
<section class="p-3 bg-gray-50 dark:bg-gray-900 sm:p-5">
    <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-12">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <!-- Search Form and Add Data Button -->
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <!-- Search Form -->
                <div class="w-full md:w-1/2">
               <form class="flex items-center" method="GET" action="{{ route('data.search') }}">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="query" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required>
                    </div>
                </form>
                </div>

                <!-- Add Data Button -->
                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <button type="button" id="openAddModal" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Create Data
                    </button>
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto mt-6">
                <table class="table-auto w-full border-collapse border border-gray-300 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Alamat</th>
                            <th class="border px-4 py-2">Foto</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>
                    </thead>
                   <tbody>
                        @foreach($data as $item)
                        <tr class="border-b dark:border-gray-700">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $item->name }}</td>
                            <td class="border px-4 py-2">{{ $item->address }}</td>
                            <td class="border px-4 py-2">
                                @if($item->photo)
                                    <img class="w-16 h-16 object-cover rounded" src="{{ asset('storage/' . $item->photo) }}" alt="Foto">
                                @else
                                    <span class="text-gray-500">No Photo</span>
                                @endif
                            </td>
                            <td class="flex px-4 py-2 space-x-2">
                                <!-- Edit Button -->
                                <button type="button" class="edit-btn inline-flex items-center px-2 py-1 text-sm font-medium bg-yellow-500 border rounded text-slate-100 hover:text-blue-600 hover:bg-slate-100 border-slate-200"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-address="{{ $item->address }}"
                                        data-photo="{{ $item->photo }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <button type="button" 
                                    data-id="{{ $item->id }}"
                                    class="delete-btn inline-flex items-center px-2 py-1 text-sm font-medium bg-red-500 text-white hover:bg-red-700">
                                    Delete
                                </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase dark:text-gray-400">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Import Modals -->
        @include('components.partials.data-add-modal')
        @include('components.partials.data-edit-modal')
        @include('components.partials.data-delete-modal')

<script>
    // Buka modal Add Data
    document.getElementById('openAddModal').addEventListener('click', () => {
        const modal = document.getElementById('addDataModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    // Tutup modal Add Data
    document.getElementById('closeAddModal').addEventListener('click', () => {
        const modal = document.getElementById('addDataModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    document.getElementById('cancelAdd').addEventListener('click', () => {
        const modal = document.getElementById('addDataModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    // Script for Delete Modal
    document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        document.getElementById('deleteForm').action = `/data/${id}`;

            // Tampilkan modal delete
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    // Tombol untuk menutup modal delete
    document.getElementById('closeDeleteModal').addEventListener('click', () => {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    // Tombol cancel untuk menutup modal delete
    document.getElementById('cancelDelete').addEventListener('click', () => {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    // Script for Edit Modal
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const address = button.getAttribute('data-address');
            const photo = button.getAttribute('data-photo');

            // Isi input modal dengan data
            document.getElementById('editName').value = name;
            document.getElementById('editAddress').value = address;

            // Set foto lama (jika ada)
            const photoElement = document.getElementById('currentPhoto');
            if (photo) {
                photoElement.src = `/storage/${photo}`;
                photoElement.classList.remove('hidden');
            } else {
                photoElement.classList.add('hidden');
            }

            // Atur action form
            const editForm = document.getElementById('editForm');
            editForm.action = `/data/${id}`;

            // Tampilkan modal
            const modal = document.getElementById('editDataModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    // Tutup modal edit
    document.getElementById('closeEditDataModal').addEventListener('click', () => {
        const modal = document.getElementById('editDataModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    document.getElementById('cancelEdit').addEventListener('click', () => {
        const modal = document.getElementById('editDataModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    });

    // Search script
    const searchInput = document.getElementById('search');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase().trim();

        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase().trim();
            const email = row.querySelector('td:nth-child(4)').textContent.toLowerCase().trim();

            if (name.includes(searchText) || email.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
