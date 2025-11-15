<div>
    <x-green-button data-modal-target="popup-modal" data-modal-toggle="popup-modal">Mark as
        {{ $status }}</x-green-button>
    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <h3 class="mb-5 text-base font-bold text-gray-500 dark:text-gray-400">Are you sure you want to mark
                        as {{ $status }}?</h3>
                    <button data-modal-hide="popup-modal" type="button" wire:click="mark"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-bold rounded-lg text-base inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-base font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
