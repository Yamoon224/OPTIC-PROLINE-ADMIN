<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'OPTIC PROLINE') }}</title>

        <meta content="Minimal Admin & Dashboard Template" name="description">
        <meta content="{{ config('app.name', 'OPTIC PROLINE') }}" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo/favicon.ico') }}">
        <!-- Layout config Js -->
        <script src="{{ asset('js/layout.js') }}"></script>
        <!-- Icons CSS -->
        
        <!-- Tailwind CSS -->
        <link rel="stylesheet" href="{{ asset('css/tailwind2.css') }}">
    </head>
    <body class="text-base bg-white text-body font-public dark:text-zink-50 dark:bg-zinc-900">
        <x-nav></x-nav>

        {{ $slot }}

        <x-footer></x-footer>

        <button id="back-to-top" class="fixed flex items-center justify-center text-white bg-purple-500 rounded-md size-10 bottom-10 right-10">
            <i data-lucide="chevron-up" class="animate animate-icons"></i>
        </button>
    
        <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
        <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>
        <script src="{{ asset('libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
        <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
        <script src="{{ asset('libs/lucide/umd/lucide.js') }}"></script>
        <script src="{{ asset('js/tailwick.bundle.js') }}"></script>
        <script src="{{ asset('libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('libs/aos/aos.js') }}"></script>
    
        <script src="{{ asset('js/pages/landing-product.init.js') }}"></script>
    </body>
</html>
