
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is the ReactPHP demonstration where we can learn the concepts of what the ReactPHP is.">
        <meta name="author" content="ReactPHP">
        <meta name="generator" content="ReactPHP">
        <meta name="theme-color" content="#7952b3">

        <title>ReactPHP | @yield('page-title')</title>    
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            @include('includes.header')

            @yield('section-contents')
        </div>
        @include('includes.footer')
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
