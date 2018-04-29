<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', app_name())</title>
@yield('meta')

<!-- Styles -->
@yield('before-styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1"
          crossorigin="anonymous">
    {{ Html::style('/frontend/css/bootstrap-colorselector.min.css') }}
    {{ Html::style('/frontend/css/slick.css') }}
    {{ Html::style('/frontend/css/slick-theme.css') }}
    {{ Html::style('/frontend/css/style.css') }}
    {{ Html::style('/frontend/css/results-style.css') }}
    {{ Html::style('/frontend/css/product-style.css') }}
    {{ Html::style('/frontend/css/xzoom.css') }}
    {{ Html::style('/frontend/css/magnific-popup.css') }}
    {{ Html::style('/frontend/css/custom.css') }}

@yield('after-styles')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {!! Html::script('/frontend/js/app.js') !!}
    {!! Html::script('/frontend/js/slick.min.js') !!}
</head>
<body>

    @include('frontend.includes.header')

    
        @include('includes.partials.messages')
        @yield('content')
    

    @include('frontend.includes.footer')

<!-- Scripts -->
@yield('before-scripts')
    {!! Html::script('/frontend/js/bootstrap-colorselector.min.js') !!}
    {!! Html::script('/frontend/js/slick.min.js') !!}
    {!! Html::script('/frontend/js/slick-lightbox.min.js') !!}
    {!! Html::script('/frontend/js/xzoom.js') !!}
    {!! Html::script('/frontend/js/magnific-popup.js') !!}
    {!! Html::script('/frontend/js/custom.js') !!}
    <script>
        $(function() {
            $('#colorselector').colorselector();
        });
    </script>
@yield('after-scripts')
</body>
</html>