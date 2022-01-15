<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{  asset('css/app.css') }}">
        <link href="{{ asset('libs/toastr/toastr.min.css') }}" rel="stylesheet">
       
        <link rel="icon" href="https://icap.columbia.edu/wp-content/uploads/cropped-Flavicon-ICAP-32x32.png" sizes="32x32">

        @yield('styles')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{  asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @yield('scripts')
    	<script src="{{ asset('libs/toastr/toastr.min.js') }}" type="text/javascript"></script>

        <script>
            var optionsToastr = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            showDuration: 300,
            hideDuration: 1000,
            optionsToastr: 5000,
            extendedTimeOut: 1000,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };


        function toastrInfo(mensaje){
            toastr.options = optionsToastr;
            toastr['info']('\n'+mensaje, 'IACAP');
        };

        function toastrSuccess(mensaje){
            toastr.options = optionsToastr;
            toastr['success']('\n'+mensaje, 'IACAP');
        };

        function toastrWarning(mensaje){
            toastr.options = optionsToastr;
            toastr['warning']('\n'+mensaje, 'IACAP');
        };

        function toastrError(mensaje){
            toastr.options = optionsToastr;
            toastr['error']('\n'+mensaje, 'IACAP');
        };
        </script>
        @include('layouts.notifications')
    </body>
</html>
