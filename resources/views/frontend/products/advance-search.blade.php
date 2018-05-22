@extends('frontend.layouts.master')

@section('content')
    <style>
        #custom-search-input{
            padding: 5px;            
            border-radius: 6px;
            background-color: #e7e7e7;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #333;
            padding: 0 8px 0 10px;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            color: #000;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }
        .type-container .btn {
            background: #e7e7e7;
        }        
        .different-container {
            background: #e7e7e7;
        }
        .panel-heading .chevron:after {
            content: "\f077";
            cursor: pointer;
        }
        .panel-heading.collapsed .chevron:after {
            content: "\f078"; 
            cursor: pointer;
        }


        /* Separate for this page only */
        #results-page .filters .panel-heading {
            padding: 10px 15px;
        }

        #results-page .filters .panel-default
        {
            border-bottom:none;
        }
        /* End */

        @media (min-width:1025px) {
            .type-container .btn {
                margin: 0 19px;
            }
        }
    </style>
    <div class="container" id="results-page">
        <div class="section">
            <div class="col-md-12 padding">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        <input type="text" class="form-control input-lg" placeholder="Search..." />
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12 padding type-container">
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12 col-md-offset-1">
                    <input type="radio" name="options" value="all"> All
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="options" value="rug"> Rug
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="options" value="furniture"> Furniture
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="options" value="lighting"> Lighting
                </label>
                <label class="btn btn-default col-md-2 col-xs-12 col-sm-12">
                    <input type="radio" name="options" value="accessories"> Accessories
                </label>
            </div>
            <div class="col-md-12 padding different-container">
                
                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="shape" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#shapeItems"> 
                            <h4 class="panel-title">Shape <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="shapeItems">
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

                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="category" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#categoriesItems"> 
                            <h4 class="panel-title">Categories<i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="categoriesItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($categoryList as $single)
                                        <li><a class="filter-option {{ isset($categoryId) && $categoryId == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->category }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 filters">
                    
                    <div class="panel panel-default">
                        <input type="hidden" name="collection" class="filter-input">
                        <div class="panel-heading" data-toggle="collapse" data-target="#collectionItems"> 
                            <h4 class="panel-title">Collections <i class="chevron fa fa-fw pull-right" ></i></h4>
                        </div>
                        <div class="collapse in" id="collectionItems">
                            <div class="panel-body">
                                <ul class="sub-filters">
                                    @foreach($collectionList as $single)
                                        <li><a class="filter-option {{ isset($filterData['collection']) && $filterData['collection'] == $single->id ? 'active' : '' }}" fieldvalue="{{ $single->id }}" href="javascript:void(0);">{{ $single->subcategory }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>   

            </div>
        </div>
    </div><!-- container -->
@endsection

@section('after-scripts')
    <script>

    </script>
@endsection