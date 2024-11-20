<div id="editDataModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50 items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-3/4 lg:w-1/2">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Data
            </h3>
            <button id="closeEditDataModal" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="editForm" action="{{ route('data.update', ':id') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="name" id="editName" 
                        class="block w-full px-4 py-2 mt-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Alamat -->
                <div class="mb-4">
                    <label for="editAddress" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <input type="text" name="address" id="editAddress" 
                        class="block w-full px-4 py-2 mt-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label for="editPhoto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto (Opsional)</label>
                    <input type="file" name="photo" id="editPhoto" 
                        class="block w-full px-4 py-2 mt-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <img id="currentPhoto" src="#" alt="Foto" class="w-20 h-20 mt-2 rounded object-cover hidden">
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end items-center p-4 border-t dark:border-gray-700">
            <button id="cancelEdit" class="px-4 py-2 mr-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                Cancel
            </button>
            <button type="submit" form="editForm" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800">
                Save Changes
            </button>
        </div>
    </div>
</div>
