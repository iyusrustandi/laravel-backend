<div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-auto bg-smoke-light">
    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg">
        <span class="absolute top-0 right-0 p-4">
            <svg id="closeDeleteModal" class="h-6 w-6 cursor-pointer text-gray-600 hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a1 1 0 110-2 1 1 0 010 2zm.707-.707L14 4.586a1 1 0 00-1.414-1.414L10 6.172 7.414 3.586A1 1 0 006 4.586L8.586 7 6 9.586A1 1 0 107.414 11L10 8.414l2.586 2.586A1 1 0 0014 9.586L11.414 7 14 4.414z" clip-rule="evenodd" />
            </svg>
        </span>
        <h2 class="text-2xl font-semibold mb-4">Delete Data</h2>
        <p>Are you sure you want to delete this data?</p>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-500 dark:hover:bg-red-600 focus:outline-none dark:focus:ring-red-800">Delete</button>
                <button type="button" id="cancelDelete" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel</button>
            </div>
        </form>
    </div>
</div>
