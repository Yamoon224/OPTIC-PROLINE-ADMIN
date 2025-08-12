<x-app-layout :pagename="__('locale.add_product')">


    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.add_product')</h4>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <form id="add-product-form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
    
                    <input type="hidden" name="_previous" value="{{ route('products.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <label for="add_name" class="block mb-2">@lang('locale.product_name') <span class="text-red-500">*</span></label>
                            <!-- Icône produit (ex: tag) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-tag absolute size-4 ltr:left-3 rtl:right-3 top-1/2 translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41a2 2 0 0 1 0 2.83l-4.17 4.17a2 2 0 0 1-2.83 0L3 10V3h7z"></path>
                                <circle cx="7.5" cy="7.5" r="1.5"></circle>
                            </svg>
                            <input type="text" id="add_name" name="name" required placeholder="@lang('locale.product_name')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                    
                        <div class="relative">
                            <label for="add_category_id" class="block mb-2">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '']) <span class="text-red-500">*</span></label>
                            <!-- Icône catégorie (tag) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-tag absolute size-4 ltr:left-3 rtl:right-3 top-1/2 translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41a2 2 0 0 1 0 2.83l-4.17 4.17a2 2 0 0 1-2.83 0L3 10V3h7z"></path>
                                <circle cx="7.5" cy="7.5" r="1.5"></circle>
                            </svg>
                            <select id="add_category_id" name="category_id" class="ltr:pl-10 rtl:pr-10 form-select w-full">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Prix unitaire & prix de lot -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <label for="add_unit_price" class="mb-2 text-base font-medium">@lang('locale.unit_price') <span class="text-red-500">*</span></label>
                            <!-- Icône prix/unité (ex: dollar sign) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-dollar-sign absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            <input type="number" id="add_unit_price" name="unit_price" step="0.01" min="0" required placeholder="@lang('locale.unit_price')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                        <div class="relative">
                            <label for="add_batch_price" class="mb-2 text-base font-medium">@lang('locale.batch_price') <span class="text-red-500">*</span></label>
                            <!-- Icône lot (box) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-box absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l1-0.57"></path>
                                <path d="M16 12v6"></path>
                                <path d="M8 12v6"></path>
                            </svg>
                            <input type="number" id="add_batch_price" name="batch_price" step="0.01" min="0" placeholder="@lang('locale.batch_price')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                    </div>
                    
                    <!-- Quantité en stock & statut -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <label for="add_stock_quantity" class="mb-2 text-base font-medium">@lang('locale.stock_quantity') <span class="text-red-500">*</span></label>
                            <!-- Icône stock (archive) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-archive absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="4" rx="2" ry="2"></rect>
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8"></path>
                                <line x1="10" y1="12" x2="14" y2="12"></line>
                            </svg>
                            <input type="number" id="add_stock_quantity" name="stock_quantity" min="0" placeholder="@lang('locale.stock_quantity')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                        <div class="relative">
                            <label for="add_status" class="mb-2 text-base font-medium">@lang('locale.status') <span class="text-red-500">*</span></label>
                            <!-- Icône statut (check-circle) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-check-circle absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9 12l2 2 4-4"></path>
                            </svg>
                            <select id="add_status" name="status" class="ltr:pl-10 rtl:pr-10 form-select w-full">
                                @foreach(App\Enums\ProductStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}">@lang('locale.' . $status->value)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <label for="add_brand" class="mb-2 text-base font-medium">@lang('locale.brand')</label>
                            <!-- Icône marque (tag) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-tag absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41a2 2 0 0 1 0 2.83l-4.17 4.17a2 2 0 0 1-2.83 0L3 10V3h7z"></path>
                                <circle cx="7.5" cy="7.5" r="1.5"></circle>
                            </svg>
                            <input type="text" id="add_brand" name="brand" placeholder="@lang('locale.brand')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                        <div class="relative">
                            <label for="add_material" class="mb-2 text-base font-medium">@lang('locale.material')</label>
                            <!-- Icône matériel (tool) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-tool absolute size-4 ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M14.7 3.3l6 6-8 8-6-6 8-8z"></path>
                            </svg>
                            <input type="text" id="add_material" name="material" placeholder="@lang('locale.material')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                    </div>
                    
                    <!-- Genre, forme, couleur -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="relative">
                            <label for="add_gender" class="block mb-2">@lang('locale.gender') <span class="text-red-500">*</span></label>
                            <!-- Icône genre (users) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-users absolute size-4 ltr:left-3 rtl:right-3 top-1/2 translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-3-3.87M7 21v-2a4 4 0 0 1 3-3.87"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <select id="add_gender" name="gender" required class="ltr:pl-10 rtl:pr-10 form-select w-full">
                                <option value="">@lang('locale.choose')</option>
                                <option value="men">@lang('locale.men')</option>
                                <option value="women">@lang('locale.women')</option>
                                <option value="unisex">@lang('locale.unisex')</option>
                                <option value="kids">@lang('locale.kids')</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label for="add_shape" class="block mb-2">@lang('locale.shape')</label>
                            <!-- Icône forme (square) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-square absolute size-4 ltr:left-3 rtl:right-3 top-1/2 translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            </svg>
                            <input type="text" id="add_shape" name="shape" placeholder="@lang('locale.shape')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                        <div class="relative">
                            <label for="add_color" class="block mb-2">@lang('locale.color')</label>
                            <!-- Icône couleur (droplet) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-droplet absolute size-4 ltr:left-3 rtl:right-3 top-1/2 translate-y-1/2 text-slate-500 dark:text-zink-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 2C7 7 5 11 5 14a7 7 0 0 0 14 0c0-3-2-7-7-12z"></path>
                            </svg>
                            <input type="text" id="add_color" name="color" placeholder="@lang('locale.color')" class="ltr:pl-10 rtl:pr-10 form-input w-full" />
                        </div>
                    </div>
                        
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">@lang('locale.product_image')</h6>
                                <div class="flex items-center justify-center border rounded-md cursor-pointer bg-slate-100 dropzone border-slate-200 dark:bg-zink-600 dark:border-zink-500">
                                    <div class="fallback">
                                        <input name="image" type="file" accept=".jpeg, .png, .jpg, .gif, .svg, .webp">
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
    
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="add_description" class="inline-block mb-2 text-base font-medium">@lang('locale.description')</label>
                        <textarea id="add_description" name="description" rows="3" class="form-textarea w-full"></textarea>
                    </div>
    
                    <!-- Footer -->
                    <div class="flex items-center justify-end p-2 mt-6 border-t border-slate-200 dark:border-zink-500">
                        <button type="submit" class="btn bg-custom-100 text-custom-500 hover:bg-custom-600 hover:text-white focus:ring focus:ring-custom-100 flex items-center gap-2">
                            <i data-lucide="send" class="size-4"></i>
                            @lang('locale.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('libs/dropzone/dropzone-min.js') }}"></script>
        <script src="{{ asset('js/pages/form-file-upload.init.js') }}"></script>
    @endpush
</x-app-layout>
