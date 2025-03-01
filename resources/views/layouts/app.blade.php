<!-- resources/views/layouts/app.blade.php -->

@include('layouts.head')

<body>

@include('layouts.header')

<section id="slider" class="carousel slide carousel-fade bg-primary pt-2 text-white" data-interval="6000" data-pause="false" data-ride="carousel">
    @yield('slider')
</section>

<main class="container" id="main">
    @yield('content')
</main>

@include('layouts.footer')

</body>
</html>
