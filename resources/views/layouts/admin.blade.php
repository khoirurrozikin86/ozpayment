<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>

    {{-- Fonts (opsional) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    {{-- core:css --}}
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/vendors/core/core.css') }}">
    {{-- Plugin css (contoh: DataTables Bootstrap 5) --}}

    <!-- Plugin css for this page -->
    <link rel="stylesheet"
        href="{{ asset('vendor/nobleui/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <!-- End plugin css for this page -->

    @stack('vendor-styles')
    {{-- inject:css --}}
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    {{-- Layout styles --}}
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/css/demo1/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('vendor/nobleui/assets/images/favicon.png') }}" />
    @stack('styles')
</head>

<body>
    <div class="main-wrapper">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        <nav class="settings-sidebar">@includeWhen(View::exists('admin.partials.settings'), 'admin.partials.settings')</nav>

        <div class="page-wrapper">
            {{-- Navbar --}}
            @include('admin.partials.navbar')

            <div class="page-content">
                @yield('breadcrumb')
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('admin.partials.footer')
        </div>
    </div>

    {{-- core:js --}}
    <script src="{{ asset('vendor/nobleui/assets/vendors/core/core.js') }}"></script>
    {{-- Plugins per halaman --}}
    @stack('vendor-scripts')
    {{-- inject:js --}}

    <!-- Plugin js for this page -->
    <script src="{{ asset('vendor/nobleui/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/nobleui/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>


    <!-- Plugin js for this page -->
    <script src="{{ asset('vendor/nobleui/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- End plugin js for this page -->


    <!-- Custom js for this page -->
    <script src="{{ asset('vendor/nobleui/assets/js/sweet-alert.js') }}"></script>
    <!-- End custom js for this page -->


    <script src="{{ asset('vendor/nobleui/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('vendor/nobleui/assets/js/template.js') }}"></script>
    {{-- Custom per halaman --}}
    @stack('scripts')
</body>

</html>
