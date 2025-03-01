<!-- resources/views/layouts/intranet.blade.php -->

@include('layouts.head_intranet')

<body>

@include('layouts.header_intranet')

<main class="container">
    <h1 class="pt-5">{{ $title }}</h1>
    @yield('content')
</main>

@include('layouts.footer_intranet')

</body>
</html>