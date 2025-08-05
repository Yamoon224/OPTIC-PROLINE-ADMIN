<div id="add-user" modal-center class="fixed inset-0 flex flex-col hidden transition-all duration-300 ease-in-out z-drawer show">
    <div class="flex flex-col w-full h-full bg-white dark:bg-zink-600">
        <!-- Header -->
        <div class="bg-custom-100 flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">@lang('locale.add_user')</h5>
            <button data-modal-close="add-user" class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-4 overflow-y-auto flex-grow">
            <form id="add-user-form" method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6">
                        <label for="add_name" class="inline-block mb-2 text-base font-medium">@lang('locale.username') <span class="text-red-500">*</span></label>
                        <input type="text" id="add_name" name="name" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="add_email" class="inline-block mb-2 text-base font-medium">@lang('locale.email') <span class="text-red-500">*</span></label>
                        <input type="email" id="add_email" name="email" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="add_phone" class="inline-block mb-2 text-base font-medium">@lang('locale.phone')</label>
                        <input type="text" id="add_phone" name="phone" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="add_password" class="inline-block mb-2 text-base font-medium">@lang('locale.password') <span class="text-red-500">*</span></label>
                        <input type="password" id="add_password" name="password" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100" />
                    </div>

                    <div class="xl:col-span-6">
                        <label for="add_role" class="inline-block mb-2 text-base font-medium">@lang('locale.role')</label>
                        <select id="add_role" name="role" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100">
                            <option value="admin">@lang('locale.admin')</option>
                            <option value="staff" selected>@lang('locale.staff')</option>
                        </select>
                    </div>

                    <div class="xl:col-span-6">
                        <label for="add_locale" class="inline-block mb-2 text-base font-medium">@lang('locale.locale')</label>
                        <select id="add_locale" name="locale" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100">
                            <option value="fr">@lang('locale.fr')</option>
                            <option value="en">@lang('locale.en')</option>
                        </select>
                    </div>

                    <div class="xl:col-span-12">
                        <label for="add_company_id" class="inline-block mb-2 text-base font-medium">@lang('locale.company_name')</label>
                        <select id="add_company_id" name="company_id" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100">
                            <option value="">@lang('locale.select_company')</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
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