<x-app-layout :pagename="__('locale.order') . ' #' . $order->id">
    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-6 gap-6 mb-6">
        {{-- Shipping Details --}}
        <div class="2xl:col-span-3 bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold">@lang('locale.shipping_details')</h6>
                <i class="ri-truck-line text-purple-500 text-xl"></i>
            </div>
            <div class="text-slate-600 space-y-1">
                <p><strong>{{ $order->user->name ?? '-' }}</strong></p>
                <p>{{ $order->delivery_address }}</p>
            </div>
        </div>
    
        {{-- Billing Details --}}
        <div class="2xl:col-span-3 bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold">@lang('locale.billing_details')</h6>
                <i class="ri-bank-card-line text-orange-500 text-xl"></i>
            </div>
            <div class="text-slate-600 space-y-1">
                <p><strong>{{ $order->user->name ?? '-' }}</strong></p>
                <p>{{ $order->billing_address ?? '-' }}</p>
            </div>
        </div>
    
        {{-- Payment Info --}}
        <div class="2xl:col-span-3 bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold">@lang('locale.payment_details')</h6>
                <i class="ri-wallet-3-line text-sky-500 text-xl"></i>
            </div>
            <div class="text-slate-600 space-y-1">
                <p>ID: #{{ $order->id }}</p>
                <p>@lang('locale.payment_status'):
                    <span class="font-semibold">@lang('locale.' . $order->payment_status->value)</span>
                </p>
                <p>@lang('locale.method'): <span>{{ $order->payment_method ?? '-' }}</span></p>
            </div>
        </div>
    
        {{-- Customer Info --}}
        <div class="2xl:col-span-3 bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold">@lang('locale.customer_info')</h6>
                <i class="ri-user-line text-custom-500 text-xl"></i>
            </div>
            <div class="text-slate-600 space-y-1">
                <p><strong>{{ $order->user->name ?? '-' }}</strong></p>
                <p>{{ $order->user->email ?? '-' }}</p>
                <p>{{ $order->user->phone ?? '-' }}</p>
            </div>
        </div>
    </div>
    

    {{-- Order Summary and Products --}}
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6">
        <div class="2xl:col-span-9">
            {{-- Résumé commande --}}
            <div class="flex gap-4 w-full mb-6">
                <div class="flex-1 bg-white p-4 rounded shadow text-center">
                    <div class="text-xs text-slate-400">@lang('locale.order_id')</div>
                    <div class="font-semibold text-slate-700">#{{ $order->id }}</div>
                </div>
                <div class="flex-1 bg-white p-4 rounded shadow text-center">
                    <div class="text-xs text-slate-400">@lang('locale.created_at')</div>
                    <div class="font-semibold text-slate-700">{{ $order->created_at->format('d M Y') }}</div>
                </div>
                <div class="flex-1 bg-white p-4 rounded shadow text-center">
                    <div class="text-xs text-slate-400">@lang('locale.delivery_date')</div>
                    <div class="font-semibold text-slate-700">{{ $order->delivered_at?->format('d M Y') ?? '-' }}</div>
                </div>
                <div class="flex-1 bg-white p-4 rounded shadow text-center">
                    <div class="text-xs text-slate-400">@lang('locale.amount')</div>
                    <div class="font-semibold text-slate-700">{{ number_format($order->amount, 2) }}</div>
                </div>
                <div class="flex-1 bg-white p-4 rounded shadow text-center">
                    <div class="text-xs text-slate-400">@lang('locale.order_status')</div>
                    <span class="inline-block mt-1 text-sm font-medium px-2 py-1 rounded
                        @if($order->order_status->value === 'delivered') bg-green-100 text-green-700
                        @elseif($order->order_status->value === 'processing') bg-yellow-100 text-yellow-700
                        @elseif($order->order_status->value === 'shipped') bg-blue-100 text-blue-700
                        @else bg-slate-100 text-slate-700 @endif">
                        @lang('locale.' . $order->order_status->value)
                    </span>
                </div>
            </div>

            {{-- Produits commandés --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">@lang('locale.product', ['suffix'=>'s'])</h6>
                        {{-- Exemple de lien optionnel à personnaliser --}}
                        @if($order->status == 'cancelled')
                            <a href="#!" class="text-red-500 underline shrink-0">@lang('locale.cancelled_order')</a>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="px-3.5 py-4 border-b border-dashed first:pl-0 last:pr-0 border-slate-200 dark:border-zinc-500">
                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center justify-center rounded-md size-12 bg-slate-100 shrink-0">
                                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="h-8 w-8 object-cover rounded" />
                                                </div>
                                                <div class="grow">
                                                    <h6 class="mb-1 text-15">
                                                        <a href="{{ route('products.show', $item->product->id) }}" class="transition-all duration-300 ease-linear hover:text-custom-500">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-slate-500 dark:text-zinc-200">
                                                        {{-- Quantité x Prix unitaire --}}
                                                        ${{ number_format($item->product->unit_price, 2) }} x {{ $item->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3.5 py-4 border-b border-dashed first:pl-0 last:pr-0 border-slate-200 dark:border-zink-500 ltr:text-right rtl:text-left">
                                            {{-- Total ligne = unit_price x quantité --}}
                                            ${{ number_format($item->product->unit_price * $item->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
            
                                {{-- Sous-total --}}
                                <tr>
                                    <td class="px-3.5 pt-4 pb-3 first:pl-0 last:pr-0 text-slate-500 dark:text-zink-200">
                                        @lang('locale.subtotal')
                                    </td>
                                    <td class="px-3.5 pt-4 pb-3 first:pl-0 last:pr-0 ltr:text-right rtl:text-left">
                                        ${{ number_format($order->amount, 2) }}
                                    </td>
                                </tr>
            
                                {{-- Discount --}}
                                <tr>
                                    <td class="px-3.5 py-3 first:pl-0 last:pr-0 text-slate-500 dark:text-zink-200">
                                        @lang('locale.discount')
                                    </td>
                                    <td class="px-3.5 py-3 first:pl-0 last:pr-0 ltr:text-right rtl:text-left">
                                        -${{ number_format($order->discount ?? 0, 2) }}
                                    </td>
                                </tr>
            
                                {{-- Total --}}
                                <tr class="font-semibold">
                                    <td class="px-3.5 pt-3 first:pl-0 last:pr-0 text-slate-500 dark:text-zink-200">
                                        @lang('locale.total')
                                    </td>
                                    <td class="px-3.5 pt-3 first:pl-0 last:pr-0 ltr:text-right rtl:text-left">
                                        ${{ number_format($order->amount - ($order->discount ?? 0), 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar : tracking / documents --}}
        <div class="2xl:col-span-3 space-y-6">
            <div class="bg-white rounded-xl shadow p-5">
                <h6 class="text-15 font-semibold mb-2">@lang('locale.tracking')</h6>
                @if ($order->tracking_id)
                    <p class="text-slate-600">@lang('locale.tracking_id'): <strong>{{ $order->tracking_id }}</strong></p>
                @else
                    <p class="text-slate-500 italic">@lang('locale.no_tracking')</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
