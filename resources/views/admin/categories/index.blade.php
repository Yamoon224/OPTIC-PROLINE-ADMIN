<x-app-layout :pagename="__('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])">     
    @push('links')
        <!-- DataTables Core et extensions -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</h4>
            <button 
                data-modal-target="add-category" 
                type="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_category')
            </button>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="categoriesTable" class="table table-striped table-hover table-sm min-w-max">
                    <thead>
                        <tr>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">#</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.category_name')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($categories as $item)
                        <tr>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $item->name }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    <!-- Bouton Edit -->
                                    <button 
                                        type="button"
                                        aria-label="Edit"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 dark:ring-custom-400/20 rounded-[10px]"
                                        data-modal-target="edit-category"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        onclick="openEditCategoryModal(this)"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </button>

                                    <!-- Bouton Delete -->
                                    <form action="{{ route('categories.destroy', $item->id) }}" method="post" 
                                          onsubmit="return confirm('@lang('locale.delete_confirmation', [], app()->getLocale())');"
                                    >
                                        @csrf @method('DELETE')
                                        <button type="submit" aria-label="Delete"
                                                class="w-8 h-8 flex items-center justify-center text-white btn bg-red-500 hover:bg-red-600 focus:ring focus:ring-red-100 dark:ring-red-400/20 rounded-[10px]">
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

    {{-- Modal add-category --}}
    @include('admin.categories.modals.add')

    {{-- Modal edit-category --}}
    @include('admin.categories.modals.edit')   

    @push('scripts')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>

        <!-- DataTables core -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Buttons extension and dependencies -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

        <script>
            $(function () {
                $('#categoriesTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });

            function openEditCategoryModal(button) {
                const categoryId = button.getAttribute('data-id');
                const categoryName = button.getAttribute('data-name');

                document.getElementById('edit_category_name').value = categoryName;

                const form = document.getElementById('edit-category-form');
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                form.action = `${baseUrl}/categories/${categoryId}`;

                const modal = document.getElementById('edit-category');
                modal.classList.remove('hidden');
            }
        </script>
    @endpush
</x-app-layout>
