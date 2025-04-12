<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ $lang ?? 'es' }}">

    @include('layouts.head')

    <body class="d-flex flex-column min-vh-100">
        @yield('styles')

        @include('layouts.header')

        <main class="flex-fill">
            @hasSection('slider')
                @yield('slider')
            @else
                <div class="mt-5 mb-4">
                    <p>.</p>
                </div>
            @endif
            @yield('title')
            @yield('content')
            @yield('scripts')
        </main>

        @include('layouts.footer')

    </body>

</html>
