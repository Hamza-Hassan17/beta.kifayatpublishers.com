<!doctype html>

<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @include('auth.layouts.meta')
    @include('auth.layouts.css')
    @yield('css')
</head>

<body>
    <div class="gradient-background d-flex justify-content-center align-items-center vh-100 @yield('auth-page-class')">
        @yield('content')
    </div>

    <!-- JS -->
    @include('auth.layouts.script')
    @yield('script')
</body>

</html>
