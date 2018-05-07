@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid" id="header">
        <section class="slider" id="headerSlider">
            @foreach($slides as $slide)
                @if($slide->type == 'youtubevideo')
                    <div>
                        <iframe class="youtube-video" src="https://www.youtube.com/embed/{{ $slide->youtubevideo_id }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <div>
                        <a href="{{url('/').'/'.$slide->url }}"> <img src="{{ URL::to('/').'/img/sliders/'.$slide->image }}"></a>
                        @if($slide->title)
                            <div class="slide-caption">
                                <h1 class="title">{{ $slide->title }}</h1>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
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
                                <a href="{{ route('frontend.product.index', $category->category) }}">Quick View</a>
                                <h2>{{ $category->category }}</h2>
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
                @foreach($collections as $collection)
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ url('/').'/img/subcategory/'.$collection->icon }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.index', $collection->subcategory) }}">Quick View</a>
                                <h2>{{ $collection->subcategory }}</h2>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
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
                <a href="{{ route('frontend.product.new-arrival') }}" class="btn btn-default btn-view-all">View All</a>
            </div>
            <section class="slider" id="arrivalsSlider">
                @foreach($newArrivals as $product)
                    @php $images = json_decode($product->main_image, true); @endphp
                    <div class="">
                        <figure class="snip1174 grey">
                            <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="sq-sample33" />
                            <figcaption>
                                <a href="{{ route('frontend.product.show', $product->id) }}">Quick View</a>
                                <h2>{{ $product->name }}</h2>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </section>
        </div>

    </div>
@endsection