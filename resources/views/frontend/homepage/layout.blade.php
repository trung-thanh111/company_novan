<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.component.head')
    @stack('styles')
    @vite('resources/css/app.scss')
</head>
@if(isset($schema))
{!! $schema !!}
@endif

<body class="@yield('body-class')">
    @hasSection('site_header')
        @yield('site_header')
    @else
        @include('frontend.component.header')
    @endif
    @yield('content')
    @hasSection('site_footer')
        @yield('site_footer')
    @else
        @include('frontend.component.footer')
    @endif
    @include('frontend.component.script')
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>