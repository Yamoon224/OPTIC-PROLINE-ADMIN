<x-app-layout :pagename="__('locale.user', ['suffix'=>'s'])">
    @push('links')
        <!-- DataTables Core and extensions CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.user', ['suffix'=>'s'])</h4>
            <button 
                data-modal-target="add-user" 
                type="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_user')
            </button>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="usersTable" class="table table-striped table-hover table-sm min-w-max">
                    <thead>
                        <tr>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">#</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.usernname')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.email')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.phone')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.role')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.locale')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.company_name')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $user->name }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $user->email }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $user->phone ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <span class="uppercase px-2 py-1 rounded-md text-xs {{ $user->role->value === 'admin' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                    @lang('locale.' . $user->role->value)
                                </span>
                            </td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ strtoupper($user->locale) }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $user->company->name ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    <!-- Edit button -->
                                    <button 
                                        type="button"
                                        aria-label="Edit"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none dark:ring-custom-400/20 rounded-[10px]"
                                        data-modal-target="edit-user"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-role="{{ $user->role->value }}"
                                        data-locale="{{ $user->locale }}"
                                        data-company_id="{{ $user->company_id }}"
                                        onclick="openEditUserModal(this)"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </button>

                                    <!-- Delete form -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('@lang('locale.delete_confirmation', [], app()->getLocale())');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" aria-label="Delete" class="w-8 h-8 flex items-center justify-center text-white btn bg-red-500 hover:bg-red-600 focus:ring focus:ring-red-100 focus:outline-none dark:ring-red-400/20 rounded-[10px]">
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

    {{-- Modal add-user --}}
    @include('admin.users.modals.add')

    {{-- Modal edit-user --}}
    @include('admin.users.modals.edit')
    

    @push('scripts')
        <!-- jQuery and DataTables scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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
                $('#usersTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });


            function openEditUserModal(button) {
                let id = button.dataset.id;
                let baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                let form = document.getElementById('edit-user-form');

                form.action = `${baseUrl}/users/${id}`;
                form.querySelector('#edit_name').value = button.dataset.name || '';
                form.querySelector('#edit_email').value = button.dataset.email || '';
                form.querySelector('#edit_phone').value = button.dataset.phone || '';
                // Password left blank on edit (optional)
                form.querySelector('#edit_password').value = '';

                form.querySelector('#edit_role').value = button.dataset.role || 'staff';
                form.querySelector('#edit_locale').value = button.dataset.locale || 'fr';
                form.querySelector('#edit_company_id').value = button.dataset.company_id || '';

                document.getElementById('edit-user').classList.remove('hidden');
            }
        </script>
    @endpush
</x-app-layout>
