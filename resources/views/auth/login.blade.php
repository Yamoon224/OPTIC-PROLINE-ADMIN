<x-auth-layout>
    @if (session()->has('status') || $errors->any())
        <div class="mt-8 text-center">
            <p class="{{ $errors->any() ? 'text-red-500' : 'text-green-500' }}">
                {{ $errors->any() ? implode('', $errors->all()) : session('status') }}
            </p>
        </div>
    @endif


    <form action="{{ route('login') }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-3">
            <label for="username" class="inline-block mb-2 text-base font-medium">@lang('locale.username')</label>
            <input type="text" id="username" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" name="email" placeholder="@lang('locale.your_username')" required>
        </div>
        <div class="mb-3">
            <label for="password" class="inline-block mb-2 text-base font-medium">@lang('locale.password')</label>
            <input type="password" id="password" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" name="password" placeholder="@lang('locale.your_password')" required>
        </div>
        <div>
            <div class="flex items-center gap-2">
                <input name="remember" id="checkboxDefault1" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox">
                <label for="checkboxDefault1" class="inline-block text-base font-medium align-middle cursor-pointer">@lang('locale.remember_me')</label>
            </div>
        </div>
        <div class="mt-5">
            <button class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">@lang('locale.sign_in')</button>
        </div>
    </form>
</x-auth-layout>
