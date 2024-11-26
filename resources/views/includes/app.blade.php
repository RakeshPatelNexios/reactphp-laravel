
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CarsOnSale">
        <meta name="author" content="CarsOnSale">
        <meta name="generator" content="CarsOnSale">
        <meta name="theme-color" content="#7952b3">

        <title>CarsOnSale</title>    
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            @include('includes.header')

            @yield('section-contents')

            @include('includes.footer')
        </div>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
