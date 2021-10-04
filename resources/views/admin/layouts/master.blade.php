<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eCommerce Shop - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/fontawesome.min.css') }}">
    @notifyCss
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
</head>
<body>

<div class="d-flex">
    @include('admin.partials.sidebar')
    <div class="flex-grow-1" style="background: #EEF0F8;">
        @include('admin.partials.top_nav')
        <div class="container-fluid p-4 rounded-2">
            @yield('content')
        </div>
    </div>
</div>

<x:notify-messages />

<script src="{{ asset('js/common/bootstrap.bundle.min.js') }}"></script>
@notifyJs
<script src="{{ asset('js/common/main.js') }}"></script>
@yield('scripts')

</body>
</html>
