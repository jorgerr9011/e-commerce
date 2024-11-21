<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Product List: </h1>

        <!-- Lo siguiente ya no es codigo HTML, sino que es
        una directiva blade 'foreach', que nos permite recorrer
        una estructura, como un array.

        Las directivas interactivas, como pintar arrays

        Las directivas selectivas, que se ejecute según
        se cumplan condiciones o no.

        Directiva:
            - if endif

            - Estructura de un switch:
                switch($age)
                    case(18)
                    break

                    default
        -->

        @if($products->isEmpty())
            <h1>No hay productos!</h1>
        @else
            <ul>
                @foreach ($products as $product)
                    <li>
                        <h1>{{ $product->name }}</h1>
                    </li>
                @endforeach
            </ul>
        @endif
</body>

</html>
