<!-- Modal édition company -->
<div id="edit-company" modal-center class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="bg-custom-100 flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">@lang('locale.edit_company')</h5>
            <button data-modal-close="edit-company"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form id="edit-company-form" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col h-full">

                    {{-- Company Name (Required) --}}
                    <div class="mb-4">
                        <label for="edit_name" class="inline-block mb-2 text-base font-medium">
                            @lang('locale.company_name') <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-building-2 absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M6 22V2h9v20"></path>
                                <path d="M18 14v8"></path>
                                <path d="M18 3v3"></path>
                                <path d="M18 9v3"></path>
                                <path d="M10 6h1"></path>
                                <path d="M10 10h1"></path>
                                <path d="M10 14h1"></path>
                                <path d="M10 18h1"></path>
                            </svg>
                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                required
                                class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 w-full"
                                placeholder="@lang('locale.company_name')"
                            >
                        </div>
                    </div>

                    {{-- Register ID --}}
                    <div class="mb-4">
                        <label for="edit_register_id" class="inline-block mb-2 text-base font-medium">
                            @lang('locale.register_id')
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-id-card absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="14" x="3" y="5" rx="2"></rect>
                                <path d="M7 9h4"></path>
                                <path d="M7 13h2"></path>
                            </svg>
                            <input
                                type="text"
                                id="edit_register_id"
                                name="register_id"
                                class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 w-full"
                                placeholder="@lang('locale.register_id')"
                            >
                        </div>
                    </div>

                    {{-- Address (Required) --}}
                    <div class="mb-4">
                        <label for="edit_address" class="inline-block mb-2 text-base font-medium">
                            @lang('locale.address') <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-map-pin absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 6.5-9 13-9 13S3 16.5 3 10a9 9 0 0 1 18 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <input
                                type="text"
                                id="edit_address"
                                name="address"
                                required
                                class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 w-full"
                                placeholder="@lang('locale.address')"
                            >
                        </div>
                    </div>

                    {{-- Contact (Required) --}}
                    <div class="mb-4">
                        <label for="edit_contact" class="inline-block mb-2 text-base font-medium">
                            @lang('locale.contact') <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-phone absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.81.36 1.6.71 2.34a2 2 0 0 1-.45 2.11L8.09 9.91a16.91 16.91 0 0 0 6 6l1.74-1.74a2 2 0 0 1 2.11-.45c.74.35 1.53.59 2.34.71a2 2 0 0 1 1.72 2z"/>
                            </svg>
                            <input
                                type="text"
                                id="edit_contact"
                                name="contact"
                                required
                                class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 w-full"
                                placeholder="@lang('locale.contact')"
                            >
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-auto flex justify-end pt-4 border-t border-slate-200 dark:border-zink-500">
                        <button type="submit"
                            class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-[10px] text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:ring active:ring-custom-100 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white dark:focus:bg-custom-500 dark:focus:text-white dark:active:bg-custom-500 dark:active:text-white dark:ring-custom-400/20">
                            <i data-lucide="send" class="w-4 h-4"></i> @lang('locale.submit')
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>