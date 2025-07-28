@props(['id', 'title'])

<div 
    id="{{ $id }}" 
    tabindex="-1" 
    aria-hidden="true" 
    class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden bg-black/50 backdrop-blur-sm"
>
    <div class="relative w-full max-w-2xl mx-auto mt-20">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $title }}
                </h3>
                <button 
                    type="button" 
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-hide="{{ $id }}"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 8.586l4.95-4.95 1.414 1.414L11.414 10l4.95 4.95-1.414 1.414L10 11.414l-4.95 4.95-1.414-1.414L8.586 10 3.636 5.05l1.414-1.414L10 8.586z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
