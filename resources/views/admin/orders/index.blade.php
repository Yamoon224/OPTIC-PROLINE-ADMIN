<x-app-layout :pagename="__('locale.order', ['suffix'=>'s'])">
    @push('links')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    @endpush

    <div class="card">
        <div class="border-b border-custom-200 flex items-center justify-between p-4">
            <h4 class="text-18">@lang('locale.order', ['suffix'=>'s'])</h4>
        </div>

        <div class="card-body">
            <div class="overflow-x-auto w-full">
                <table id="ordersTable" class="table table-striped table-hover table-sm min-w-max">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('locale.user', ['suffix'=>''])</th>
                            <th>@lang('locale.amount')</th>
                            <th>@lang('locale.discount')</th>
                            <th>@lang('locale.payment_status')</th>
                            <th>@lang('locale.order_status')</th>
                            <th>@lang('locale.delivery_address')</th>
                            <th>@lang('locale.billing_address')</th>
                            <th>@lang('locale.created_at')</th>
                            <th>@lang('locale.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>{{ number_format($order->amount, 2) }}</td>
                                <td>{{ number_format($order->discount ?? 0, 2) }}</td>
                                <td>
                                    <span class="px-2 py-1 rounded-md text-xs 
                                        @if($order->payment_status->value === 'paid') bg-green-100 text-green-600
                                        @elseif($order->payment_status->value === 'refunded') bg-red-100 text-red-600
                                        @else bg-yellow-100 text-yellow-600
                                        @endif
                                    ">
                                        @lang('locale.' . $order->payment_status->value)
                                    </span>
                                </td>
                                <td>
                                    <span class="px-2 py-1 rounded-md text-xs 
                                        @if($order->order_status->value === 'delivered') bg-green-100 text-green-600 
                                        @elseif($order->order_status->value === 'shipped') bg-blue-100 text-blue-600 
                                        @elseif($order->order_status->value === 'processing') bg-yellow-100 text-yellow-600 
                                        @else bg-slate-100 text-slate-600 
                                        @endif">
                                        @lang('locale.' . $order->order_status->value)
                                    </span>
                                </td>
                                <td class="max-w-xs truncate" title="{{ $order->delivery_address }}">{{ $order->delivery_address }}</td>
                                <td class="max-w-xs truncate" title="{{ $order->billing_address }}">{{ $order->billing_address ?? '-' }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn bg-custom-500 text-white hover:bg-custom-600 btn-sm px-2 py-1 rounded-[10px]">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        {{-- Optionnel : bouton supprimer si besoin --}}
                                        
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post" onsubmit="return confirm('@lang('locale.delete_confirmation')');">
                                            @csrf @method('DELETE')
                                            <button class="btn bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-[10px]">
                                                <i class="ri-delete-bin-6-line"></i>
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
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('js/datatables/data-tables.tailwindcss.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script>
            $(function () {
                $('#ordersTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    responsive: true,
                    pageLength: 10
                });
            });
        </script>
    @endpush
</x-app-layout>
