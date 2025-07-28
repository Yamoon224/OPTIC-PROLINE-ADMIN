<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr"
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="app-url" content="{{ env('APP_URL') }}">

        <title>{{ config('app.name', 'OPTIC PROLINE') }}</title>

        <meta content="Minimal Admin & Dashboard Template" name="description">
        <meta content="{{ config('app.name', 'OPTIC PROLINE') }}" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo/favicon.ico') }}">
        <!-- Layout config Js -->
        <script src="{{ asset('js/layout.js') }}"></script>

        @stack('links')
        
        <!-- Tailwind CSS -->
        <link rel="stylesheet" href="{{ asset('css/tailwind2.css') }}">
    </head>
    <body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
        <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
            <x-app-menu></x-app-menu>

            <div id="sidebar-overlay" class="absolute inset-0 z-[1002] bg-slate-500/30 hidden"></div>
            <x-app-header></x-app-header>

            <x-app-cart></x-app-cart>
            <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
                <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
                    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                            <div class="grow">
                                <h5 class="text-16">{{ $pagename }}</h5>
                            </div>
                            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                                    <a href="index.html#!" class="text-slate-400 dark:text-zink-200">{{ config('app.name', 'OPTIC PROLINE') }}</a>
                                </li>
                                <li class="text-slate-700 dark:text-zink-100">{{ $pagename }}</li>
                            </ul>
                        </div>
                        
                        {{ $slot }}
                    </div>
                </div>
                <x-app-footer></x-app-footer>
            </div>
        </div>

        <x-app-settings></x-app-settings>

        <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
        <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>
        <script src="{{ asset('libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
        <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
        <script src="{{ asset('libs/lucide/umd/lucide.js') }}"></script>
        <script src="{{ asset('js/tailwick.bundle.js') }}"></script>
        
        @stack('scripts')

        <!-- App js -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
