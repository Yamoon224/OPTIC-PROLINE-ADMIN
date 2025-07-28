<div id="edit-product" modal-center class="fixed inset-0 flex flex-col hidden transition-all duration-300 ease-in-out z-drawer show">
    <div class="flex flex-col w-full h-full bg-white dark:bg-zink-600">
        <!-- Header -->
        <div class="bg-custom-100 flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">@lang('locale.edit_product')</h5>
            <button data-modal-close="edit-product" class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-4 overflow-y-auto">
            <form id="edit-product-form" method="POST" action="{{ route('products.update', ['product' => '__PRODUCT_ID__']) }}">
                @csrf
                @method('PUT')

                <!-- Nom du produit -->
                <div class="mb-4">
                    <label for="edit_name" class="inline-block mb-2 text-base font-medium">@lang('locale.product_name') <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_name" name="name" required class="form-input w-full" />
                </div>

                <!-- Prix unitaire & prix de lot -->
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="w-full md:w-1/2">
                        <label for="edit_unit_price" class="mb-2 text-base font-medium">@lang('locale.unit_price') <span class="text-red-500">*</span></label>
                        <input type="number" id="edit_unit_price" name="unit_price" step="0.01" min="0" required class="form-input w-full" />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="edit_batch_price" class="mb-2 text-base font-medium">@lang('locale.batch_price')</label>
                        <input type="number" id="edit_batch_price" name="batch_price" step="0.01" min="0" class="form-input w-full" />
                    </div>
                </div>

                <!-- Quantité en stock & statut -->
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="w-full md:w-1/2">
                        <label for="edit_stock_quantity" class="mb-2 text-base font-medium">@lang('locale.stock_quantity')</label>
                        <input type="number" id="edit_stock_quantity" name="stock_quantity" min="0" class="form-input w-full" />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="edit_status" class="mb-2 text-base font-medium">@lang('locale.status')</label>
                        <select id="edit_status" name="status" class="form-select w-full">
                            @foreach(App\Enums\ProductStatusEnum::cases() as $status)
                                <option value="{{ $status->value }}">@lang('locale.' . $status->value)</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Marque, matière -->
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="w-full md:w-1/2">
                        <label for="edit_brand" class="mb-2 text-base font-medium">@lang('locale.brand')</label>
                        <input type="text" id="edit_brand" name="brand" class="form-input w-full" />
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="edit_material" class="mb-2 text-base font-medium">@lang('locale.material')</label>
                        <input type="text" id="edit_material" name="material" class="form-input w-full" />
                    </div>
                </div>

                <!-- Genre, forme, couleur -->
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="w-full md:w-1/3">
                        <label for="edit_gender" class="mb-2 text-base font-medium">@lang('locale.gender')</label>
                        <select id="edit_gender" name="gender" class="form-select w-full">
                            <option value="">@lang('locale.choose')</option>
                            <option value="men">@lang('locale.men')</option>
                            <option value="women">@lang('locale.women')</option>
                            <option value="unisex">@lang('locale.unisex')</option>
                            <option value="kids">@lang('locale.kids')</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label for="edit_shape" class="mb-2 text-base font-medium">@lang('locale.shape')</label>
                        <input type="text" id="edit_shape" name="shape" class="form-input w-full" />
                    </div>
                    <div class="w-full md:w-1/3">
                        <label for="edit_color" class="mb-2 text-base font-medium">@lang('locale.color')</label>
                        <input type="text" id="edit_color" name="color" class="form-input w-full" />
                    </div>
                </div>

                <!-- Catégorie -->
                <div class="mb-4">
                    <label for="edit_category_id" class="mb-2 text-base font-medium">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])</label>
                    <select id="edit_category_id" name="category_id" class="form-select w-full">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="edit_description" class="inline-block mb-2 text-base font-medium">@lang('locale.description')</label>
                    <textarea id="edit_description" name="description" rows="3" class="form-textarea w-full"></textarea>
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
