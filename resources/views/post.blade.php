<!-- resources/views/news.blade.php -->

@include('layouts.head')
@include('layouts.header')

<main class="container  bg-primary mw-100">
    <div class="mt-5 mb-5">
        <p>.</p>
    </div>

    <article class="w-75 pb-4 mx-auto">
        <h1 class="text-white mt-4 mb-4 mx-auto">{!! $post->title !!}</h1>
        <img src="{{ asset('images/posts/'.$post->image) }}" class="w-100 mt-4 mb-4" alt="{!! $post->title !!}">
        <p class="text-white mw-100 w-100 text-justify">{!! $post->resume !!}</p>
        <div class="row row-cols-2 pt-2">
            @foreach ($post->sections as $section)
                <div class="col text-white mb-2">
                    <h5 class="text-secondary text-center mt-5" style="min-height: 3.5rem;">{!! $section->title !!}</h5>
                    <p class="text-white text-justify" style="line-height: 2;">{!! $section->content !!}</p>
                </div>
            @endforeach
        </div>
        <h6 class="text-right text-white">{!! $post->formatted_created_at !!}</h6>
    </article>
    
</main>

@include('layouts.footer')