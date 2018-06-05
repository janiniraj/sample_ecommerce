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
    {!! Html::script('/frontend/js/modernizr.js') !!}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.15.1/dist/sweetalert2.all.js"></script>

    {{ Html::style('/fontawesome/css/fontawesome-all.min.css') }}
    {{ Html::style('/frontend/css/bootstrap-colorselector.min.css') }}
    {{ Html::style('/frontend/css/slick.css') }}
    {{ Html::style('/frontend/css/slick-theme.css') }}
    {{ Html::style('/frontend/css/style.css') }}
    {{ Html::style('/frontend/css/results-style.css') }}
    {{ Html::style('/frontend/css/product-style.css') }}
    
    {{ Html::style('/frontend/css/xzoom.css') }}
    {{ Html::style('/frontend/css/jquery.fancybox.js') }}
    {{ Html::style('/frontend/css/magnific-popup.css') }}
    {{ Html::style('/frontend/css/bootstrap-tagsinput.css') }}

    {{ Html::style('/frontend/css/custom.css') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    {!! Html::script('/frontend/js/bootstrap-colorselector.min.js') !!}
    {!! Html::script('/frontend/js/slick.min.js') !!}
    {!! Html::script('/frontend/js/slick-lightbox.min.js') !!}
    {!! Html::script('/frontend/js/xzoom.js') !!}
    {!! Html::script('/frontend/js/jquery.hammer.min.js') !!}
    {!! Html::script('/frontend/js/jquery.fancybox.js') !!}
    {!! Html::script('/frontend/js/magnific-popup.js') !!}
    {!! Html::script('/frontend/js/foundation.min.js') !!}
    {!! Html::script('/frontend/js/setup.js') !!}
    {!! Html::script('/frontend/js/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('/frontend/js/color_name.js') !!}
    {!! Html::script('/frontend/js/custom.js') !!}
    <script>
        $(function() {
            $('#colorselector').colorselector();
            /*$(".dropdown-submenu a.dropdown-toggle").hover(function(){
                $(this).next('ul').show();
            }, function() {
                $(this).next('ul').hide();
            });*/
        });
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false }, 'google_translate_element');
        }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        function translateLanguage(lang) {

            var $frame = $('.goog-te-menu-frame:first');
            if (!$frame.length) {
                alert("Error: Could not find Google translate frame.");
                return false;
            }
            if($frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0))
            {
                $frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
            }            
            return false;
        }
        $(document).ready(function(){
            $(".register-button").on('click', function(){
                $("#login-modal").modal('hide');
                $("#register-modal").modal('show');
            });
            $(".forgetpassword-button").on('click', function(){
                $("#login-modal").modal('hide');
                $("#forgetpassword-modal").modal('show');
            });
            $(".back-login").on('click', function(){
                $("#forgetpassword-modal").modal('hide');
                $("#register-modal").modal('hide');
                $("#login-modal").modal('show');
            });
        });
    </script>
@yield('after-scripts')
</body>
</html>