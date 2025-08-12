<x-app-layout :pagename="__('locale.company', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])">
    @push('links')
        <!-- DataTables Core and extensions CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.company', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</h4>
            <a 
                href="{{ route('companies.create') }}"
                role="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_company')
            </a>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="companiesTable" class="table table-striped table-hover table-sm min-w-max">
                    <thead>
                        <tr>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">#</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.company_name')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.register_id')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.address')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.contact')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($companies as $company)
                        <tr>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <a href="{{ route('companies.show', $company->id) }}" class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full shrink-0 bg-slate-100">
                                        <img src="{{ asset($company->logo) }}" alt="LOGO" class="h-6 rounded-full">
                                    </div>
                                    <h6 class="grow">{{ $company->name }}</h6>
                                </a>
                            </td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $company->register_id ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $company->address }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $company->contact }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    <!-- Edit button -->
                                    <a 
                                        role="button"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none dark:ring-custom-400/20 rounded-[10px]"
                                        href="{{ route('companies.edit', $company->id) }}"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </a>

                                    <!-- Delete form -->
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="post" 
                                          onsubmit="return confirm('@lang('locale.delete_confirmation', [], app()->getLocale())');"
                                    >
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                aria-label="Delete" 
                                                class="w-8 h-8 flex items-center justify-center text-white btn bg-red-500 hover:bg-red-600 focus:ring focus:ring-red-100 focus:outline-none dark:ring-red-400/20 rounded-[10px]">
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

    @push('scripts')
        <!-- jQuery and DataTables scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>

        <!-- DataTables Buttons extension and dependencies -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>

        <script>
            $(function () {
                $('#companiesTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });
        </script>
    @endpush
</x-app-layout>
