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
            <form id="edit-company-form" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">@lang('locale.logo_company')</h6>
                                <div class="flex items-center justify-center border rounded-md cursor-pointer bg-slate-100 dropzone border-slate-200 dark:bg-zink-600 dark:border-zink-500">
                                    <div class="fallback">
                                        <input name="logo" type="file" accept=".jpeg, .png, .jpg, .gif, .svg, .webp">
                                    </div>
                                    <div class="w-full py-5 text-lg text-center dz-message needsclick">
                                        <div class="mb-3">
                                            <i data-lucide="upload-cloud" class="block mx-auto size-12 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                        </div>
        
                                        <h5 class="mb-0 font-normal text-slate-500 text-15">Drag and drop your files or <a href="forms-file-upload.html#!">browse</a> your files</h5>
                                    </div>
                                </div>
        
                                <ul class="mb-0 dropzone-preview">
                                    <li class="mt-2 dropzone-preview-list">
                                        <!-- This is used as the file preview template -->
                                         
                                        <div class="border rounded border-slate-200 dark:border-zink-500">
                                            <div class="flex p-2">
                                                <div class="shrink-0 me-3">
                                                    <div class="p-2 rounded-md size-14 bg-slate-100 dark:bg-zink-600">
                                                        <img data-dz-thumbnail class="block w-full h-full rounded-md" src="data:image/png;base64,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" alt="Dropzone-Image">
                                                    </div>
                                                </div>
                                                <div class="grow">
                                                    <div class="pt-1">
                                                        <h5 class="mb-1 text-15" data-dz-name>&nbsp;</h5>
                                                        <p class="mb-0 text-slate-500 dark:text-zink-200" data-dz-size></p>
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>
                                                </div>
                                                <div class="shrink-0 ms-3">
                                                    <button data-dz-remove class="px-2 py-1.5 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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