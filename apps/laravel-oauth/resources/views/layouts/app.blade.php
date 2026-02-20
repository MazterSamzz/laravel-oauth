<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>{{ config('app.name') }} @hasSection('title')
            | @yield('title')
        @endif
    </title>

    @include('layouts.partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('layouts.partials.navbar')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.partials.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            @yield('content')
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        @include('layouts.partials.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    @stack('js')
</body>
<!--end::Body-->

</html>
