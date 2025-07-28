<x-app-layout :pagename="__('locale.company', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])">
    @push('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.company', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</h4>
            <button 
                data-modal-target="add-company" 
                type="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_company')
            </button>
        </div>

        <div class="card-body">
            <table id="dataTable" class="table table-striped table-hover table-sm w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('locale.company_name')</th>
                        <th>@lang('locale.register_id')</th>
                        <th>@lang('locale.address')</th>
                        <th>@lang('locale.contact')</th>
                        <th>@lang('locale.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->register_id ?? '-' }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->contact }}</td>
                        <td>
                            <div class="flex gap-2">
                                <!-- Edit -->
                                <button 
                                    type="button"
                                    class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 rounded-[10px]"
                                    data-modal-target="edit-company"
                                    data-id="{{ $company->id }}"
                                    data-name="{{ $company->name }}"
                                    data-register_id="{{ $company->register_id }}"
                                    data-address="{{ $company->address }}"
                                    data-contact="{{ $company->contact }}"
                                    onclick="openEditCompanyModal(this)"
                                >
                                    <i class="ri-edit-line text-base"></i>
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('companies.destroy', $company->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-white btn bg-red-500 hover:bg-red-600 rounded-[10px]">
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
   
    {{-- Modal add-product --}}
    @include('admin.companies.modals.add')

    {{-- Modal edit-product --}}
    @include('admin.companies.modals.edit')   

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- DataTables core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        function openEditCompanyModal(button) {
            const id = button.dataset.id;
            const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
            const form = document.getElementById('edit-company-form');

            form.action = `${baseUrl}/companies/${id}`;
            form.querySelector('#edit_name').value = button.dataset.name;
            form.querySelector('#edit_register_id').value = button.dataset.register_id ?? '';
            form.querySelector('#edit_address').value = button.dataset.address;
            form.querySelector('#edit_contact').value = button.dataset.contact;

            document.getElementById('edit-company').classList.remove('hidden');
        }
    </script>
    @endpush
</x-app-layout>
