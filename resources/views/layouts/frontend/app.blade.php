<!doctype html>
<html class="no-js" lang="zxx">
@include('layouts.frontend.head')
<body>
    @stack('css')
    @include('layouts.frontend.nav')

    <main>
        @yield('content')
    </main>

    @include('layouts.frontend.footer')
    @include('layouts.frontend.script')
    @stack('js')
</body>

</html>
