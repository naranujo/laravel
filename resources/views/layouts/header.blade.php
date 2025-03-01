<header class="container d-md-block bg-primary" id="top">
    <nav class="navbar navbar-expand-lg fixed-top bg-primary pt-3 pb-0 " id="mainNav">
        <div class="container pb-2">
            <a class="navbar-brand mr-0" href="/?lang={{ $lang }}"><img src="{{ asset('images/logo.svg') }}" width="180px" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
            <div class="collapse navbar-collapse bg-primary" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center bg-primary">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#top">
                            {{ $title0[$lang] }}<span class="sr-only">Menu</span>
                        </a>
                    </li>
                    <li class="nav-item pl-lg-2 pl-xl-4">
                        <a class="nav-link js-scroll-trigger" href="#nosotros">
                            {{ $title1[$lang] }}
                        </a>
                    </li>
                    <li class="nav-item pl-lg-2 pl-xl-4">
                        <a class="nav-link js-scroll-trigger" href="#clientes">
                            {{ $title2[$lang] }}
                        </a>
                    </li>
                    <li class="nav-item pl-lg-2 pl-xl-4">
                        <a class="nav-link js-scroll-trigger" href="#servicios">
                            {{ $title3[$lang] }}
                        </a>
                    </li>
                    <li class="nav-item  pl-lg-2 pl-xl-4">
                        <a class="nav-link js-scroll-trigger" href="#contacto">
                            {{ $title4[$lang] }}
                        </a>
                    </li>
                    <li class="nav-item  pl-lg-2 pl-xl-4">
                        <a class="nav-link js-scroll-trigger" href="./news">
                            {{ $title5[$lang] }}
                        </a>
                    </li>
                    <script>
                        const navLinks = document.querySelectorAll('.nav-link');
                        navLinks.forEach(navLink => {
                            navLink.addEventListener('click', () => {
                                window.location.href = navLink.href;
                            });
                        });

                    </script>
                    <li class="nav-item  pl-lg-2 pl-xl-5 pr-0 mr-0">
                        <a class="nav-link d-inline-block pr-0 <?php if ($lang == 'es') {echo 'current';}?>"
                            href="?lang=es">Esp</a> |
                        <a class="nav-link d-inline-block pl-0 pr-0 <?php if ($lang == 'en') {echo 'current';}?>"
                            href="?lang=en">Eng</a> |
                        <a class="nav-link d-inline-block pl-0 pr-0 <?php if ($lang == 'pt') {echo 'current';}?>"
                            href="?lang=pt">Por</a>
                    </li>
                    <li class="nav-item  pl-lg-2 pl-xl-5 pr-0 mr-0">
                        <a class="nav-link d-inline-block pl-0 pr-0" href="/intranet?lang={{ $lang }}">
                            Intranet
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>