<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand main-logo" href="{{ url('/') }}"><img src="{{ url('/').'/logo.jpg' }}"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse hidden-sm hidden-xs" id="socialNavbar">
            <ul class="nav navbar-nav navbar-right social">
                <li>{{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => 'login' ]) }}</li>
                <li><a class="heart" href="#"><i class="fas fa-heart"></i></a></li>
                <li class="rounded"><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="rounded"><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="rounded"><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="rounded"><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right social phonenumber">
                <li><a class="number">001 1234 5678</a></li>
                <li class="rounded"><a class="phone" href="#"><i class="fas fa-phone"></i></a></li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Rug</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Discontinued</a></li>
                        <li><a href="#">Padding</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">Styles</a></li>
                        <li><a href="#">Materials</a></li>
                        <li><a href="#">Weaves</a></li>
                        <li><a href="#">Colors</a></li>
                        <li><a href="#">Size</a></li>
                        <li><a href="#">Shape</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Furniture</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Sofas</a></li>
                        <li><a href="#">Accent Chairs</a></li>
                        <li><a href="#">Benches & Stools</a></li>
                        <li><a href="#">Ottoman</a></li>
                        <li><a href="#">Table</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Lighting</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Chandeliers</a></li>
                        <li><a href="#">Floor Lamps</a></li>
                        <li><a href="#">Flush lighting</a></li>
                        <li><a href="#">Pendants</a></li>
                        <li><a href="#">Outdoor Lighting</a></li>
                        <li><a href="#">Sconces</a></li>
                        <li><a href="#">Table Lamps</a></li>
                    </ul>


                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Accessories</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Mirrors</a></li>
                        <li><a href="#">Pillows</a></li>
                        <li><a href="#">Wall Décor</a></li>
                        <li><a href="#">Art</a></li>
                        <li><a href="#">Garden Stools </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Shop</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Search</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Advanced Search</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">About</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#">Contact Us</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Our Store</a></li>
                        <li><a href="#">Inquire</a></li>
                        <li><a href="#">Live Chat</a></li>
                        <li><a href="#">Join Mailing List</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown language">
                    <a class="dropdown-toggle" href="#">Language</a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src="{{ url('/') }}/frontend/img/flags/us.png"></a></li>
                        <li><a href="#"><img src="{{ url('/') }}/frontend/img/flags/fr.png"></a></li>
                        <li><a href="#"><img src="{{ url('/') }}/frontend/img/flags/ch.png"></a></li>
                        <li><a href="#"><img src="{{ url('/') }}/frontend/img/flags/sp.png"></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>