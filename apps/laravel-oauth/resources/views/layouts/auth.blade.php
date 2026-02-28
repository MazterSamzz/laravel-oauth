<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>

    <head>
        @include('layouts.partials.meta')
        <title>@yield('title', config('app.name'))</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('css')
    </head>
</head>
<!--end::Head-->

<!--begin::Body-->
@yield('content')
<!--end::Body-->
