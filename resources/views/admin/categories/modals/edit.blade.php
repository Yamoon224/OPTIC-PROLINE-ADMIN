<div id="edit-category" modal-center class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[20rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="bg-custom-100 flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">
                @lang('locale.edit_category')
            </h5>
            <button data-modal-close="edit-category"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form id="edit-category-form" method="post">
                @csrf
                @method('PUT')
                <div class="flex flex-col h-full">
                    <div class="mb-6">
                        <label for="edit_category_name" class="inline-block mb-2 text-base font-medium">
                            @lang('locale.category_name') <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-tag absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41a2 2 0 0 1 0 2.83l-4.17 4.17a2 2 0 0 1-2.83 0L3 10V3h7z"></path>
                                <circle cx="7.5" cy="7.5" r="1.5"></circle>
                            </svg>
                            <input
                                type="text"
                                id="edit_category_name"
                                name="name"
                                required
                                class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 w-full"
                                placeholder="@lang('locale.category_name')"
                            >
                        </div>
                    </div>
                    <div class="mt-auto flex justify-end border-slate-200 dark:border-zink-500">
                        <button type="submit" class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:ring active:ring-custom-100 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white dark:focus:bg-custom-500 dark:focus:text-white dark:active:bg-custom-500 dark:active:text-white dark:ring-custom-400/20">
                            <i data-lucide="send" class="w-4 h-4"></i> @lang('locale.submit')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>