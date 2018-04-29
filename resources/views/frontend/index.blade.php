@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid" id="header">
        <section class="slider" id="headerSlider">
            <div>
                <iframe class="youtube-video" src="https://www.youtube.com/embed/yIIGQB6EMAM" frameborder="0" allowfullscreen></iframe>
            </div>
            <div>
                <img src="http://placehold.it/1920x1080?text=2">
                <div class="slide-caption">
                    <h1 class="title">New Collection</h1>
                </div>
            </div>
            <div>
                <img src="http://placehold.it/1920x1080?text=3">
                <div class="slide-caption">
                    <h1 class="title">New Collection</h1>
                </div>
            </div>
            <div>
                <img src="http://placehold.it/1920x1080?text=4">
                <div class="slide-caption">
                    <h1 class="title">New Collection</h1>
                </div>
            </div>
            <div>
                <img src="http://placehold.it/1920x1080?text=5">
                <div class="slide-caption">
                    <h1 class="title">New Collection</h1>
                </div>
            </div>
            <div>
                <img src="http://placehold.it/1920x1080?text=6">
                <div class="slide-caption">
                    <h1 class="title">New Collection</h1>
                </div>
            </div>
        </section>
    </div>

    <div class="container sections" id="homepage">
        <div class="section" id="categories">
            <div class="heading">
                <hr><h1><span>Categories</span></h1>
            </div>
            <section class="slider" id="categoriesSlider">
                @foreach($categories as $category)
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ url('/').'/img/category/'.$category->icon }}" alt="sq-sample33" />
                            <figcaption>
                                <h2>{{ $category->category }}</h2>
                                <a href="/main/page/production">Quick View</a>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </section>
        </div>

        <div class="section" id="featured">
            <div class="heading">
                    <hr><h1><span>Featured Items</span></h1>
            </div>
            <section class="slider" id="featuredSlider">
                <div>
                    <img src="http://placehold.it/1920x1080?text=1">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=2">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=3">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=4">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=5">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=6">
                    <div class="slide-caption">Item</div>
                </div>
            </section>
        </div>

        <div class="section" id="services">
            <div class="heading">
                    <hr><h1><span>Chic & Modern Furniture</span></h1>
            </div>
            <section class="slider" id="servicesSlider">
                <div>
                    <img src="http://placehold.it/1920x1080?text=1">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=2">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=3">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=4">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=5">
                    <div class="slide-caption">Item</div>
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=6">
                    <div class="slide-caption">Item</div>
                </div>
            </section>
        </div>

        <div class="section" id="arrivals">
            <div class="heading">
                    <hr><h1><span>New Arrivals</span></h1>
            </div>
            <section class="slider" id="arrivalsSlider">
                <div>
                    <img src="http://placehold.it/1920x1080?text=1">
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=2">
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=3">
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=4">
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=5">
                </div>
                <div>
                    <img src="http://placehold.it/1920x1080?text=6">
                </div>
            </section>
        </div>

    </div>
@endsection