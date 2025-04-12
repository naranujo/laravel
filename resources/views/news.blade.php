@extends('layouts.app')

@section('styles')

@endsection

@section('title')
    <h1 class="text-center text-white mt-1 pt-4">{{ $title }}</h1>
@endsection

@section('content')
    <section class="container" id="main">
        <!-- Inicio carrusel -->
        @if (count($carrouselPosts) == 0)
            <h6 class="text-primary mx-auto">{{ $sinNovedades[$lang] }}</h6>
        @else
            @foreach ($carrouselPosts as $index => $post)
                <section class="row row-cols-2 shadow position-relative @if ($index != 0) d-none @endif" id="carrusel-{!! $index !!}">
                    <section class="col pl-0" id="c-left">
                        <img src="{{ asset('images/posts/'.$post->image) }}" class="w-100" alt="{!! $post->title !!}">
                    </section>
                    <section class="col pt-4" id="c-right">
                        <p class="text-primary mx-auto">{{ $post->category_name }}</p>
                        <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                        <p class="h-50 text-primary text-justify">{{ $post->resume }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="/news/post/{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                            <h6 class="text-right text-primary mr-2">{{ $post->formatted_created_at }}</h6>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <div class="d-flex justify-content-center">
                                @if (count($carrouselPosts) == 1)
                                    <div id="00" class="c-indicator mr-3 bg-primary" style="width:30px;height:5px;border:1px solid #000"></div>
                                @elseif (count($carrouselPosts) == 2)
                                    <div id="10" class="c-indicator mr-3 {{ $index == 0 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="11" class="c-indicator mr-3 {{ $index == 1 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                @elseif (count($carrouselPosts) == 3)
                                    <div id="20" class="c-indicator mr-3 {{ $index == 0 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="21" class="c-indicator mr-3 {{ $index == 1 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="22" class="c-indicator mr-3 {{ $index == 2 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                @elseif (count($carrouselPosts) == 4)
                                    <div id="{{ $index }}0" class="c-indicator mr-3 {{ $index == 0 ? 'bg-primary' : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="{{ $index }}1" class="c-indicator mr-3 {{ $index == 1 ? "bg-primary" : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="{{ $index }}2" class="c-indicator mr-3 {{ $index == 2 ? "bg-primary" : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                    <div id="{{ $index }}3" class="c-indicator mr-3 {{ $index == 3 ? "bg-primary" : '' }}" style="width:30px;height:5px;border:1px solid #000"></div>
                                @endif
                            </div>
                        </div>
                    </section>
                </section>
            @endforeach
            <!-- Inicio novedades -->
            <section class="row row-cols-2 pt-2" id="novedades">
                @php $index = 0; @endphp
                
                @if (count($posts) == 0)
                    <h6 class="text-primary text-center mx-auto mt-5">{{ $sinNovedades[$lang] }}</h6>
                @else
                    @foreach ($posts as $post)
                        @if ($index % 2 != 0)
                            <article class="col pr-0 text-primary mb-2">
                                <hr class="mw-75 mx-auto" style="border: 5px solid #a99c6b;">
                                <p class="text-primary mx-auto">{{ $novedades[$lang] }}</p>
                                <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                                <div class="d-flex justify-content-between">
                                    <a href="/news/post/{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                                    <h6 class="text-right text-primary">{{ $post->formatted_created_at }}</h6>
                                </div>
                            </article>
                        @else
                            <article class="col pl-0 text-primary mb-2">
                                <hr class="mw-75 mx-auto" style="border: 5px solid #a99c6b;">
                                <p class="text-primary mx-auto">{{ $novedades[$lang] }}</p>
                                <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                                <div class="d-flex justify-content-between">
                                    <a href="/news/post/{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                                    <h6 class="text-right text-primary">{{ $post->formatted_created_at }}</h6>
                                </div>
                            </article>
                        @endif
                        @php $index++; @endphp
                    @endforeach
                @endif
            </section>
            @if ($hasMorePosts)
                <div class="d-flex justify-content-center">
                    <a href="./?page={{ $page + 1 }}" class="btn border border-radius-25 text-white bg-primary w-25 mt-3 mb-3" id="cargar-mas">Cargar más</a>
                </div>
            @endif
            <!-- Fin novedades -->
        @endif
    </section>
    <!-- Fin carrusel -->
@endsection

@section('scripts')
    <script>
        let cIndicators = document.querySelectorAll(".c-indicator");

        let c0 = document.querySelector("#carrusel-0");
        let c1 = document.querySelector("#carrusel-1");
        let c2 = document.querySelector("#carrusel-2");
        let c3 = document.querySelector("#carrusel-3");

        cIndicators.forEach((indicator) => {
            indicator.addEventListener("click", (e) => {
                e.preventDefault();
                let id = e.target.id;

                if (id == "00" || id == "10" || id == "20" || id == "30") {
                    c0.classList.remove("d-none");
                    c1.classList.add("d-none");
                    c2.classList.add("d-none");
                    c3.classList.add("d-none");
                } else if (id == "01" || id == "11" || id == "21" || id == "31") {
                    c0.classList.add("d-none");
                    c1.classList.remove("d-none");
                    c2.classList.add("d-none");
                    c3.classList.add("d-none");
                } else if (id == "02" || id == "12" || id == "22" || id == "32") {
                    c0.classList.add("d-none");
                    c1.classList.add("d-none");
                    c2.classList.remove("d-none");
                    c3.classList.add("d-none");
                } else if (id == "03" || id == "13" || id == "23" || id == "33") {
                    c0.classList.add("d-none");
                    c1.classList.add("d-none");
                    c2.classList.add("d-none");
                    c3.classList.remove("d-none");
                }
            });
        });
    </script>
@endsection
