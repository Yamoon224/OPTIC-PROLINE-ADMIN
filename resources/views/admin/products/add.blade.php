<x-app-layout :pagename="__('locale.add_product')">


    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.add_product')</h4>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <form id="add-product-form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
    
                    <!-- Nom du produit -->
                    <div class="mb-4">
                        <label for="add_name" class="inline-block mb-2 text-base font-medium">@lang('locale.product_name') <span class="text-red-500">*</span></label>
                        <input type="text" id="add_name" name="name" required class="form-input w-full" />
                    </div>
    
                    <!-- Prix unitaire & prix de lot -->
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="w-full md:w-1/2">
                            <label for="add_unit_price" class="mb-2 text-base font-medium">@lang('locale.unit_price') <span class="text-red-500">*</span></label>
                            <input type="number" id="add_unit_price" name="unit_price" step="0.01" min="0" required class="form-input w-full" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label for="add_batch_price" class="mb-2 text-base font-medium">@lang('locale.batch_price')</label>
                            <input type="number" id="add_batch_price" name="batch_price" step="0.01" min="0" class="form-input w-full" />
                        </div>
                    </div>
    
                    <!-- Quantité en stock & statut -->
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="w-full md:w-1/2">
                            <label for="add_stock_quantity" class="mb-2 text-base font-medium">@lang('locale.stock_quantity')</label>
                            <input type="number" id="add_stock_quantity" name="stock_quantity" min="0" class="form-input w-full" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label for="add_status" class="mb-2 text-base font-medium">@lang('locale.status')</label>
                            <select id="add_status" name="status" class="form-select w-full">
                                @foreach(App\Enums\ProductStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}">@lang('locale.' . $status->value)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <!-- Marque, matière -->
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="w-full md:w-1/2">
                            <label for="add_brand" class="mb-2 text-base font-medium">@lang('locale.brand')</label>
                            <input type="text" id="add_brand" name="brand" class="form-input w-full" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label for="add_material" class="mb-2 text-base font-medium">@lang('locale.material')</label>
                            <input type="text" id="add_material" name="material" class="form-input w-full" />
                        </div>
                    </div>
    
                    <!-- Genre, forme, couleur -->
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="w-full md:w-1/3">
                            <label for="add_gender" class="mb-2 text-base font-medium">@lang('locale.gender')</label>
                            <select id="add_gender" name="gender" class="form-select w-full">
                                <option value="">@lang('locale.choose')</option>
                                <option value="men">@lang('locale.men')</option>
                                <option value="women">@lang('locale.women')</option>
                                <option value="unisex">@lang('locale.unisex')</option>
                                <option value="kids">@lang('locale.kids')</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label for="add_shape" class="mb-2 text-base font-medium">@lang('locale.shape')</label>
                            <input type="text" id="add_shape" name="shape" class="form-input w-full" />
                        </div>
                        <div class="w-full md:w-1/3">
                            <label for="add_color" class="mb-2 text-base font-medium">@lang('locale.color')</label>
                            <input type="text" id="add_color" name="color" class="form-input w-full" />
                        </div>
                    </div>
    
                    <!-- Catégorie -->
                    <div class="mb-4">
                        <label for="add_category_id" class="mb-2 text-base font-medium">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])</label>
                        <select id="add_category_id" name="category_id" class="form-select w-full">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
