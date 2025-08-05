<x-app-layout :pagename="__('locale.payment', ['suffix'=>'s'])">

    @push('links')
        <!-- DataTables Core and extensions CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.payment', ['suffix'=>'s'])</h4>
            <button 
                data-modal-target="add-payment" 
                type="button" 
                class="text-sm px-3 py-1.5 flex items-center gap-2 rounded-md text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                @lang('locale.add_payment')
            </button>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="paymentsTable" class="table table-striped table-hover table-sm min-w-max" style="width:100%">
                    <thead>
                        <tr>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">#</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.amount')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.payment_method')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.currency')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.payment_date')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.transaction_id')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.operator_id')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.order_id')</th>
                            <th class="first:pl-5 last:pr-5 font-semibold border-b border-slate-200 dark:border-zink-500">@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($payments as $payment)
                        <tr>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ number_format($payment->amount, 2) }}</td>
                            <td class="capitalize px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                @lang('locale.' . $payment->payment_method->value)
                            </td>
                            <td class="uppercase px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $payment->currency ?? 'XOF' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i') : '-' }}</td>
                            <td class="break-all px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $payment->transaction_id ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $payment->operator_id ?? '-' }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $payment->order_id }}</td>
                            <td class="px-3.5 py-1 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    <!-- Edit button -->
                                    <button 
                                        type="button"
                                        aria-label="Edit"
                                        class="w-8 h-8 flex items-center justify-center text-white btn bg-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100 focus:outline-none dark:ring-custom-400/20 rounded-[10px]"
                                        data-modal-target="edit-payment"
                                        data-id="{{ $payment->id }}"
                                        data-amount="{{ $payment->amount }}"
                                        data-payment_method="{{ $payment->payment_method->value }}"
                                        data-currency="{{ $payment->currency ?? 'XOF' }}"
                                        data-payment_date="{{ $payment->payment_date ? $payment->payment_date->format('Y-m-d\TH:i') : '' }}"
                                        data-transaction_id="{{ $payment->transaction_id }}"
                                        data-operator_id="{{ $payment->operator_id }}"
                                        data-order_id="{{ $payment->order_id }}"
                                        onclick="openEditPaymentModal(this)"
                                    >
                                        <i class="ri-edit-line text-base"></i>
                                    </button>

                                    <!-- Delete form -->
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('@lang('locale.delete_confirmation', [], app()->getLocale())');">
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

    {{-- Modal add-payment --}}
    @include('admin.payments.modals.add')

    {{-- Modal edit-payment --}}
    @include('admin.payments.modals.edit')
    

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
        <script src="{{ asset('libs/dropzone/dropzone-min.js') }}"></script>
        <script src="{{ asset('js/pages/form-file-upload.init.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>

        <script>
            $(function () {
                $('#paymentsTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });

            function openEditPaymentModal(button) {
                let id = button.dataset.id;
                let baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                let form = document.getElementById('edit-payment-form');

                form.action = `${baseUrl}/payments/${id}`;
                form.querySelector('#edit_amount').value = button.dataset.amount || '';
                form.querySelector('#edit_payment_method').value = button.dataset.payment_method || '';
                form.querySelector('#edit_currency').value = button.dataset.currency || '';
                form.querySelector('#edit_payment_date').value = button.dataset.payment_date || '';
                form.querySelector('#edit_transaction_id').value = button.dataset.transaction_id || '';
                form.querySelector('#edit_operator_id').value = button.dataset.operator_id || '';
                form.querySelector('#edit_order_id').value = button.dataset.order_id || '';

                document.getElementById('edit-payment').classList.remove('hidden');
            }
        </script>
    @endpush

</x-app-layout>
