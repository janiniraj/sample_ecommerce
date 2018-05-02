@extends('frontend.layouts.master')

@section('content')
<div class="container accessories" id="results-page">
    <div class="section">

        <div class="results-limit">
            <select name="resultsLimiter" id="resultsLimiter">
                <option value="">Showing 1-10 of 2000 results</option>
            </select>
        </div>

        <div class="row">
            <div class="col-sm-4 filters">
                <ul class="filters-list">
                    <li class="list-header">Filters</li>
                </ul>
                @if(!empty($categoryList))
                <div class="panel-group" id="results-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse1">
                                    Categories
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($categoryList as $single)
                                        <li><a href="#">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($collectionList))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse2">
                                    Collections
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($collectionList as $single)
                                        <li><a href="#">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($styleList))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse3">
                                        Styles
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="sub-filters">
                                        @foreach($styleList as $single)
                                            <li><a href="#">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($materialList))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse4">
                                        Materials
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="sub-filters">
                                        @foreach($materialList as $single)
                                            <li><a href="#">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($weaveList))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse5">
                                        Weaves
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="sub-filters">
                                        @foreach($weaveList as $single)
                                            <li><a href="#">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($weaveList))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse6">
                                        Colors
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <span class="color-label">Select Color: </span>
                                    <select id="colorselector">
                                        @foreach($colorList as $singleKey => $singleValue)
                                            <option {{ $singleKey== 0 ? 'selected' : '' }} value="{{$singleValue->id}}" data-color="{{ $singleValue->name }}">{{ $singleValue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse7">
                                    Size
                                </a>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="dimensions">
                                    <div class="width">
                                        <label>Width</label>
                                        <div class="checkbox">
                                            <label><input type="radio" name="unit-length" checked> Feet</label>
                                            <label><input type="radio" name="unit-length"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="max">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="length">
                                        <label>length</label>
                                        <div class="checkbox">
                                            <label><input type="radio" name="unit-width" checked> Feet</label>
                                            <label><input type="radio" name="unit-width"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#results-accordion" href="#collapse8">
                                    Shape
                                </a>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach(config('constant.shapes') as $single)
                                        <li><a href="#">{{ $single }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="btn btn-submit pull-right" type="submit">Submit</button>
            </div>

            <div class="col-sm-8 resutls">
                <div class="row items">
                    @foreach($products as $product)
                        <div class="col-xs-6 item">
                            <a href="{{ route('frontend.product.show', $product->id) }}">
                                <img src="{{ URL::to('/').'/uploads/products/'.$product->main_image }}" alt="Item" class="img-responsive">
                                <div class="text-center product-title">{{ $product->name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <ul class="pagination">
                    <li><a href="#"><span>1</span></a></li>
                    <li><a href="#"><span>2</span></a></li>
                    <li><a href="#"><span>3</span></a></li>
                    <li class="etc">...</li>
                    <li><a href="#"><span>54</span></a></li>
                    <li><a href="#"><span>55</span></a></li>
                </ul>

            </div>
        </div>

    </div>
</div><!-- container -->
@endsection