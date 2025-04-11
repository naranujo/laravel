<!-- resources/views/layouts/intranet.blade.php -->

@include('layouts.head_intranet')

<body>

@include('layouts.header_intranet')

<main class="container">
    @yield('title')
    @yield('content')
</main>

@include('layouts.footer_intranet')

</body>
</html>