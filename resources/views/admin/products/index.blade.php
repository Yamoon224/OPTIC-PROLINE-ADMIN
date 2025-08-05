<x-app-layout :pagename="__('locale.product', ['suffix'=>'s'])">
    @push('links')
        <!-- DataTables Core et extensions CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    {{-- Statistiques en haut si tu veux garder la grid (sinon tu peux adapter ou supprimer) --}}
    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-12 mb-4">
        <div class="xl:col-span-6">
            <div class="card">
                <div class="flex items-center gap-4 card-body">
                    <div class="flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-md size-12 text-15 dark:bg-red-500/20 shrink-0">
                        <i data-lucide="user-x-2"></i>
                    </div>
                    <div class="overflow-hidden grow">
                        <h5 class="mb-1 text-16"><span class="counter-value" data-target="6">0</span></h5>
                        <p class="truncate text-slate-500 dark:text-zink-200">Absent Employee (Today)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="xl:col-span-6">
            <div class="card">
                <div class="flex items-center gap-4 card-body">
                    <div class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                        <i data-lucide="user-check-2"></i>
                    </div>
                    <div class="overflow-hidden grow">
                        <h5 class="mb-1 text-16"><span class="counter-value" data-target="32">0</span></h5>
                        <p class="truncate text-slate-500 dark:text-zink-200">Present Employee (Today)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.product', ['suffix'=>'s'])</h4>
            <a 
                href="{{ route('products.create') }}" 
                role="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_product')
            </a>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="productsTable" class="table table-striped table-hover table-sm min-w-max">
                    <thead>
                        <tr>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">#</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.product_name')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.unit_price')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.batch_price')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.stock_quantity')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.status')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.brand')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.material')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.gender')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.shape')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.color')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($products as $product)
                        <tr>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->name }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ number_format($product->unit_price, 2) }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ number_format($product->batch_price, 2) }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->stock_quantity }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <span class="px-2 py-1 rounded-md text-xs {{ $product->status->value === 'in_stock' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                    @lang('locale.' . $product->status->value)
                                </span>
                            </td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->brand ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->material ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->gender ? __('locale.' . $product->gender->value) : '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->shape ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->color ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    {{-- Bouton Edit --}}
                                    <a 
                                        href="{{ route('products.edit', $product->id) }}"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 rounded-[10px]"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </a>
                                    {{-- <button 
                                        type="button"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 rounded-[10px]"
                                        data-modal-target="edit-product"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-description="{{ $product->description }}"
                                        data-unit_price="{{ $product->unit_price }}"
                                        data-batch_price="{{ $product->batch_price }}"
                                        data-stock_quantity="{{ $product->stock_quantity }}"
                                        data-status="{{ $product->status->value ?? $product->status }}"
                                        data-brand="{{ $product->brand }}"
                                        data-material="{{ $product->material }}"
                                        data-gender="{{ $product->gender }}"
                                        data-shape="{{ $product->shape }}"
                                        data-color="{{ $product->color }}"
                                        data-category_id="{{ $product->category_id }}"
                                        onclick="openEditProductModal(this)"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </button> --}}

                                    {{-- Bouton Delete --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('@lang('locale.delete_confirmation')');">
                                        @csrf @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="w-8 h-8 flex items-center justify-center text-white btn bg-red-500 hover:bg-red-600 rounded-[10px]"
                                            aria-label="Delete"
                                        >
                                            <i class="ri-delete-bin-6-line text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal add-product --}}
    @include('admin.products.modals.add')

    {{-- Modal edit-product --}}
    @include('admin.products.modals.edit')

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>

        <script src="{{ asset('libs/dropzone/dropzone-min.js') }}"></script>
        <script src="{{ asset('js/pages/form-file-upload.init.js') }}"></script>

        <script>
            $(function () {
                $('#productsTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });

            function openEditProductModal(button) {
                const id = button.dataset.id;
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                const form = document.getElementById('edit-product-form');

                form.action = `${baseUrl}/products/${id}`;
                form.querySelector('#edit_name').value = button.dataset.name || '';
                form.querySelector('#edit_description').value = button.dataset.description || '';
                form.querySelector('#edit_unit_price').value = button.dataset.unit_price || '';
                form.querySelector('#edit_batch_price').value = button.dataset.batch_price || '';
                form.querySelector('#edit_stock_quantity').value = button.dataset.stock_quantity || '';
                form.querySelector('#edit_status').value = button.dataset.status || '';
                form.querySelector('#edit_brand').value = button.dataset.brand || '';
                form.querySelector('#edit_material').value = button.dataset.material || '';
                form.querySelector('#edit_gender').value = button.dataset.gender || '';
                form.querySelector('#edit_shape').value = button.dataset.shape || '';
                form.querySelector('#edit_color').value = button.dataset.color || '';
                form.querySelector('#edit_category_id').value = button.dataset.category_id || '';

                document.getElementById('edit-product').classList.remove('hidden');
            }
        </script>
    @endpush
</x-app-layout>
