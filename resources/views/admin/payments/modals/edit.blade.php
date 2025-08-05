<div id="edit-payment" modal-center class="fixed inset-0 flex flex-col hidden transition-all duration-300 ease-in-out z-drawer show">
    <div class="flex flex-col w-full h-full bg-white dark:bg-zink-600">
        <!-- Header -->
        <div class="bg-custom-100 flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">@lang('locale.edit_payment')</h5>
            <button data-modal-close="edit-payment" class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-4 overflow-y-auto flex-grow">
            <form id="edit-payment-form" method="POST" action="" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                    <div class="xl:col-span-4">
                        <label for="edit_amount" class="inline-block mb-2 text-base font-medium">@lang('locale.amount') <span class="text-red-500">*</span></label>
                        <input type="number" id="edit_amount" name="amount" step="0.01" min="0" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                    <div class="xl:col-span-4">
                        <label for="edit_payment_method" class="inline-block mb-2 text-base font-medium">@lang('locale.payment_method') <span class="text-red-500">*</span></label>
                        <select id="edit_payment_method" name="payment_method" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                            <option value="">@lang('locale.choose')</option>
                            <option value="credit_card">@lang('locale.credit_card')</option>
                            <option value="mobile_money">@lang('locale.mobile_money')</option>
                            <option value="bank_transfer">@lang('locale.bank_transfer')</option>
                        </select>
                    </div>

                    <div class="xl:col-span-4">
                        <label for="edit_currency" class="inline-block mb-2 text-base font-medium">@lang('locale.currency')</label>
                        <input type="text" id="edit_currency" name="currency" maxlength="10" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="edit_payment_date" class="inline-block mb-2 text-base font-medium">@lang('locale.payment_date')</label>
                        <input type="datetime-local" id="edit_payment_date" name="payment_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="edit_transaction_id" class="inline-block mb-2 text-base font-medium">@lang('locale.transaction_id')</label>
                        <input type="text" id="edit_transaction_id" name="transaction_id" maxlength="255" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="edit_operator_id" class="inline-block mb-2 text-base font-medium">@lang('locale.operator_id')</label>
                        <input type="text" id="edit_operator_id" name="operator_id" maxlength="100" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="edit_order_id" class="inline-block mb-2 text-base font-medium">@lang('locale.order_id') <span class="text-red-500">*</span></label>
                        <input type="number" id="edit_order_id" name="order_id" min="1" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" />
                    </div>

                </div>

                <div class="flex items-center justify-end p-2 mt-6 border-t border-slate-200 dark:border-zink-500 gap-3">
                    <button type="reset" class="btn bg-white border border-red-500 text-red-500 hover:bg-red-100 hover:text-red-600 focus:ring focus:ring-red-100 rounded-md px-4 py-2">@lang('locale.reset')</button>
                    <button type="submit" class="btn bg-custom-500 border-custom-500 text-white hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-100 rounded-md px-4 py-2">@lang('locale.submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>