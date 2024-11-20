<div>
    <h3>{{ $title }}</h3>
    <!-- En PHP para evitar que haya enlaces rotos (si cambiara la url
    de la pagina actual, por ejemplo) no daría encontrado la imagen, por 
    lo que es necesario incluir los archivos estáticos de la siguiente manera.
    Los scripts o estilos css se cargan de la misma manera (en caso de que
    estuvieran en la carpeta public) -->
    <img src="{{ asset('assets/img/IMG_7568.jpg') }}" alt="example" width="128" >
    <p>{{ $content }}</p>
</div>