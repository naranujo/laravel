<!-- resources/views/news.blade.php -->

@include('layouts.head')
@include('layouts.header')

<main class="container bg-primary mw-100">
    <div class="mt-5 mb-5">
        <p>.</p>
    </div>

    <h1 class="text-center text-white mt-1 pt-4">{{ $title }}</h1>

    @if (count($posts) == 0)
        <h5 class="text-center text-white mt-1 pt-4">Aún no hay publicaciones</h5>
    @else
        @foreach( $posts as $post )

            <article class="w-75 mx-auto pb-4">
                <h2 class="text-secondary pt-4 text-center mx-auto"><a href="/news/post/{{ $post->id }}" class="text-secondary">{!! $post->title !!}</a></h2>
                <div class="row row-cols-2 pt-2">
                    @foreach ($post->sections as $section)
                        <div class="col text-white mb-2">
                            <h5 class="text-secondary text-center mt-5" style="min-height: 3.5rem;">{!! $section->title !!}</h5>
                            <p class="text-white text-justify" style="line-height: 2;">{!! $section->content !!}</p>
                        </div>
                    @endforeach
                </div>
                <h6 class="text-right text-secondary">{{ $post->formatted_created_at }}</h6>
            </article>
            
            <hr class="border border-secondary border-5 mw-75 mx-auto">

        @endforeach
    @endif

</main>

@include('layouts.footer')