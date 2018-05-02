@extends('frontend.layouts.master')

@section('content')
    <div class="container" id="product">
        <div class="section">

            <div class="row">
                <div class="col-md-6">
                    @php
                        $images = json_decode($product->main_image, true);
                    @endphp
                    <div class="xzoom-container col-md-12">
                        <img class="xzoom" id="xzoom-default" src="{{ url('/'). '/img/products/thumbnail/'.$images[0] }}" xoriginal="{{ url('/'). '/img/products/'.$images[0] }}" />
                        <div class="xzoom-thumbs">
                            @foreach($images as $singleKey => $singleValue)
                                <a href="{{ url('/'). '/img/products/'.$singleValue }}"><img class="xzoom-gallery" width="80" src="{{ url('/'). '/img/products/thumbnail/'.$singleValue }}" ></a>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-md-6 product-desc">
                    <div class="path">

                        <a class="heart" href="#"><i class="fas fa-heart"></i></a>
                        <a class="share" href="#"><i class="fas fa-share-alt"></i></a>
                    </div>

                    <h2>Product Name</h2>

                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#specs">Specs</a></li>
                        <li><a data-toggle="pill" href="#shop">Shop</a></li>
                        <li><a href="#reviews-section">Review</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="specs" class="tab-pane fade in active">
                            <table>
                                <tr>
                                    <td>SKU</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Brand</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Collection</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Size</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Shape</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Design</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Matterials</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Border Color</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Foundation</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Knote per sq.</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div id="shop" class="tab-pane fade">
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div>
                        <div id="review" class="tab-pane fade">
                            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="product-details">
                <h2>Product Deatail</h2>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <p>This is a paragraph, This is a paragraph, This is a paragraph, This is a paragraph,
                            This is a paragraph, This is a paragraph, This is a paragraph, This is a paragraph
                            This is a  paragraph</p>
                    </div>
                </div>
            </div>

            <div class="might-like">

                <div class="heading">
                    <hr><h1><span>You Might Like This</span></h1>
                </div>

                <section class="slider" id="mightLikeSlider">
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
                    <div>
                        <img src="http://placehold.it/1920x1080?text=7">
                    </div>
                    <div>
                        <img src="http://placehold.it/1920x1080?text=8">
                    </div>

                </section>

            </div>

            <div class="arrivals">

                <div class="heading">
                    <hr><h1><span>New Arrivales</span></h1>
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
                    <div>
                        <img src="http://placehold.it/1920x1080?text=7">
                    </div>
                    <div>
                        <img src="http://placehold.it/1920x1080?text=8">
                    </div>
                </section>

            </div>

            <div id="reviews-section" class="reviews-section">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#writeReview">WRITE A REVIEW</a></li>
                    <li><a data-toggle="tab" href="#reviews">REVIEW</a></li>
                    <li><a data-toggle="tab" href="#question">QUESTION</a></li>
                </ul>

                <div class="tab-content">
                    <div id="writeReview" class="tab-pane fade in active">
                        <form action="">
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <div class="stars" id="userStars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <input type="range" class="hidden" id="score" min="1" max="5" value="3">
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title">
                            </div>

                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea class="form-control" rows="5" id="review"></textarea>
                            </div>

                        </form>
                    </div>
                    <div id="reviews" class="tab-pane fade">
                        <div class="user-review">
                            <div class="username">
                                <span>Liza</span>
                            </div>
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <div class="user-review">
                                <p>I love this rug! It is subtle but makes a bold statement. It is much softer than I expected for a jute rug. I love it!</p>
                            </div>
                        </div>
                    </div>
                    <div id="question" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

@section('after-scripts')
<script>
    /*$('.xzoom5, .xzoom-gallery5').xzoom({
        tint: '#006699',
        Xoffset: 15,
        fadeIn: true,
        smooth: true,
        smoothZoomMove: 3
    });
    $('#productImages').slickLightbox({
        itemSelector        : 'a',
        navigateByKeyboard  : true
    });*/
</script>
@endsection