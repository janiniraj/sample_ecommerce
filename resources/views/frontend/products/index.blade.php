@extends('frontend.layouts.master')

@section('content')
<div class="container accessories" id="results-page">
    <div class="section">

        <div class="results-limit">
            <select name="resultsLimiter" id="resultsLimiter">
                <option value="">{{ 'Showing '. (($products->currentPage()-1)*config('constant.perPage')+1).'-'.(($products->currentPage()-1)*config('constant.perPage')+$products->count()).' of '.$products->total() }} results</option>
            </select>
        </div>

        <div class="row">
            <div class="col-sm-4 filters">
                {{ Form::open(['method' => 'GET']) }}
                <ul class="filters-list">
                    <li class="list-header">Filters</li>
                </ul>
                <div class="panel-group" id="results-accordion">
                    @if(!empty($categoryList))
                    <div class="panel panel-default">
                        <input type="hidden" name="category" class="filter-input">
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
                                        <li><a class="filter-option " fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($collectionList))
                    <div class="panel panel-default">
                        <input type="hidden" name="collection" class="filter-input">
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
                                        <li><a class="filter-option {{ isset($filterData['collection']) && $filterData['collection'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($styleList))
                        <div class="panel panel-default">
                            <input type="hidden" name="style" class="filter-input">
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
                                            <li><a class="filter-option {{ isset($filterData['style']) && $filterData['style'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($materialList))
                        <div class="panel panel-default">
                            <input type="hidden" name="material" class="filter-input">
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
                                            <li><a class="filter-option {{ isset($filterData['material']) && $filterData['material'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($weaveList))
                        <div class="panel panel-default">
                            <input type="hidden" name="weave" class="filter-input">
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
                                            <li><a class="filter-option {{ isset($filterData['weave']) && $filterData['weave'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($colorList))
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
                                    <select name="color" id="colorselector">
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
                                            <label><input type="radio" name="unit_width" value="feet" checked> Feet</label>
                                            <label><input type="radio" name="unit_width" value="inch"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="width_min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="width_max">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="length">
                                        <label>length</label>
                                        <div class="checkbox">
                                            <label><input type="radio" name="unit_length" value="feet" checked> Feet</label>
                                            <label><input type="radio" name="unit_length" value="inch"> Inch</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="min" placeholder="Min" name="length_min">
                                            <input type="text" class="form-control" id="max" placeholder="Max" name="length_max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <input type="hidden" name="shape" class="filter-input">
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
                                        <li><a class="filter-option {{ isset($filterData['shape']) && $filterData['shape'] == $single ? 'active' : '' }}" fieldvalue="{{ $single }}" href="javascript:void(0);">{{ $single }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="btn btn-submit pull-right" type="submit">Submit</button>
                {{ Form::close() }}
            </div>

            <div class="col-sm-8 resutls">
                <div class="row items">
                    @foreach($products as $product)
                        <div class="col-xs-6 item">
                            <a href="{{ route('frontend.product.show', $product->id) }}">
                                @php $images = json_decode($product->main_image, true); @endphp
                                <img src="{{ URL::to('/').'/img/products/thumbnail/'.$images[0] }}" alt="Item" class="img-responsive">
                                <div class="text-center product-title">{{ $product->name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{ $products->links() }}

            </div>
        </div>

    </div>
</div><!-- container -->
@endsection

@section('after-scripts')
<script>
    $(".filter-option").on('click', function (e) {
        $(this).closest('.panel.panel-default').find('.filter-option').each(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
            }
        });
        $(this).addClass('active');
        var fieldValue = $(this).attr('fieldvalue');
        $(this).closest('.panel.panel-default').find('.filter-input').val(fieldValue);
    });
</script>
@endsection