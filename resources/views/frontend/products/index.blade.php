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
                                    <li><a href="#">Antique Rug</a></li>
                                    <li><a href="#">Modern</a></li>
                                    <li><a href="#">Traditional</a></li>
                                    <li><a href="#">Transitional</a></li>
                                    <li><a href="#">Gabbeh</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
                                    <li><a href="#">Ferahan</a></li>
                                    <li><a href="#">Lavar Kerman</a></li>
                                    <li><a href="#">Mahal</a></li>
                                    <li><a href="#">One of the Kind</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">Ikat</a></li>
                                    <li><a href="#">Overdyed</a></li>
                                    <li><a href="#">Patch Work</a></li>
                                    <li><a href="#">Sari Silk</a></li>
                                    <li><a href="#">Serapi</a></li>
                                    <li><a href="#">Soho</a></li>
                                    <li><a href="#">Tabriz</a></li>
                                    <li><a href="#">Taj</a></li>
                                    <li><a href="#">Tibetan</a></li>
                                    <li><a href="#">Tufted</a></li>
                                    <li><a href="#">Oushak</a></li>
                                    <li><a href="#">Ziegler</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
                                    <li><a href="#">Persian Classical</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">Indian</a></li>
                                    <li><a href="#">Turkish</a></li>
                                    <li><a href="#">Pakistan</a></li>
                                    <li><a href="#">Morocco</a></li>
                                    <li><a href="#">One of the Kinds</a></li>
                                    <li><a href="#">Russian</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
                                    <li><a href="#">Cotton</a></li>
                                    <li><a href="#">Jute & Sisal</a></li>
                                    <li><a href="#">Silk</a></li>
                                    <li><a href="#">Synthetics</a></li>
                                    <li><a href="#">Wool</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
                                    <li><a href="#">Braided</a></li>
                                    <li><a href="#">Flat Weaves</a></li>
                                    <li><a href="#">Hand Hooked</a></li>
                                    <li><a href="#">Hand Knotted</a></li>
                                    <li><a href="#">Loom Knotted</a></li>
                                    <li><a href="#">Hand Tufted</a></li>
                                    <li><a href="#">Machine Made</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
                                    <option value="106" data-color="#A0522D">sienna</option>
                                    <option value="47" data-color="#CD5C5C" selected="selected">indianred</option>
                                    <option value="87" data-color="#FF4500">orangered</option>
                                    <option value="17" data-color="#008B8B">darkcyan</option>
                                    <option value="18" data-color="#B8860B">darkgoldenrod</option>
                                    <option value="68" data-color="#32CD32">limegreen</option>
                                    <option value="42" data-color="#FFD700">gold</option>
                                    <option value="77" data-color="#48D1CC">mediumturquoise</option>
                                    <option value="107" data-color="#87CEEB">skyblue</option>
                                    <option value="46" data-color="#FF69B4">hotpink</option>
                                    <option value="47" data-color="#CD5C5C">indianred</option>
                                    <option value="64" data-color="#87CEFA">lightskyblue</option>
                                    <option value="13" data-color="#6495ED">cornflowerblue</option>
                                    <option value="15" data-color="#DC143C">crimson</option>
                                    <option value="24" data-color="#FF8C00">darkorange</option>
                                    <option value="78" data-color="#C71585">mediumvioletred</option>
                                    <option value="123" data-color="#000000">black</option>
                                </select>
                            </div>
                        </div>
                    </div>

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
                                    <li><a href="#">Accent</a></li>
                                    <li><a href="#">Large Rectangle</a></li>
                                    <li><a href="#">Medium Rectangle</a></li>
                                    <li><a href="#">Octagon</a></li>
                                    <li><a href="#">Oval</a></li>
                                    <li><a href="#">Oversized</a></li>
                                    <li><a href="#">Round</a></li>
                                    <li><a href="#">Runner</a></li>
                                    <li><a href="#">Small Rectangle</a></li>
                                    <li><a href="#">Square</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-sm-8 resutls">
                <div class="row items">
                    @foreach($products as $product)
                        <div class="col-xs-6 item">
                            <img src="{{ URL::to('/').'/uploads/products/'.$product->main_image }}" alt="Item" class="img-responsive">
                            <div class="text-center">{{ $product->name }}</div>
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