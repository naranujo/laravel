@include('layouts.head_intranet')

<body class="bg-primary m-0 p-0">
    <main class="container bg-primary p-0 d-flex flex-column align-items-center" style="width: 210mm !important; max-width: 794px !important;">
        <!-- Logo centrado -->
        <div class="d-flex justify-content-center align-items-center w-100">
            <img src="{{ asset('images/logo-v.svg') }}" class="mt-4 mb-4" style="width: 50mm !important; max-width: 189px !important;" alt="Logo">
        </div>
        <hr class="mt-4 mb-5" style="border: 3px solid #a99c6b; width: 100% !important; max-width: 100% !important;">

        <article class="pb-4" style="width: 90% !important; max-width: 100% !important">
            <h1 class="text-center text-secondary mt-5 mb-4">{{ $post->title }}</h1>
            <h6 class="text-center text-white">{{ $post->formatted_created_at }}</h6>
            <div class="row pt-5">
                @foreach ($post->sections as $section)
                    <div class="col-6 text-white mb-3">
                        <h5 class="text-secondary text-center mt-5" style="min-height: 3.5rem;">{!! $section->title !!}</h5>
                        <p class="text-white text-justify" style="line-height: 2;">{!! $section->content !!}</p>
                    </div>
                @endforeach
            </div>
        </article>
    </main>
    
    <!-- Incluir html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Incluir html2pdf -->
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postId = "{{ $post->id }}"; // Obtener el ID del post

            // Dimensiones A4 en mm
            const a4Width = 210; // mm
            const a4Height = 297; // mm
            const a4Ratio = a4Width / a4Height;

            // Obtener dimensiones del viewport en píxeles
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;
            const viewportRatio = viewportWidth / viewportHeight;

            // Ajustar el tamaño del body manteniendo el ancho del viewport pero con la altura proporcional a A4
            if (viewportRatio > a4Ratio) {
                // Viewport más ancho que A4 → Ajustamos altura en base al ancho del viewport
                document.body.style.width = `${viewportWidth}px`;
                document.body.style.height = 'auto';
            } else {
                // Viewport más alto que A4 → Ajustamos ancho en base a la altura del viewport
                document.body.style.width = `${viewportHeight * a4Ratio}px`;
                document.body.style.height = 'auto';
            }

            // Centramos el contenido si es necesario
            document.body.style.margin = "0 auto";
            document.body.style.display = "flex";
            document.body.style.justifyContent = "center";
            document.body.style.alignItems = "start";


            setTimeout(() => {

                html2canvas(document.body).then(canvas => {
                    // Descargar la imagen
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = `post_${postId}.png`;
                    link.click();

                    // Generar y descargar el PDF con nombre correcto
                    html2pdf().from(document.body).save();

                    // Redirigir a la página del post
                    window.location.href = "{{ route('view.post', $post->id) }}";
                }).catch(error => {
                    console.error('Error generando imagen o PDF:', error);
                });
            }, 1); // Esperar 1 segundo para asegurar que el contenido esté completamente renderizado
        });
    </script>
</body>
