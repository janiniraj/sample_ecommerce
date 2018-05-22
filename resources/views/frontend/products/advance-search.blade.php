@extends('frontend.layouts.master')

@section('content')
    <style>
        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
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
            color: #666666;
            padding: 0 8px 0 10px;
            border-left: solid 1px #ccc;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }
    </style>
    <div class="container" id="results-page">
        <div class="section">
            <div class="col-md-12">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control input-lg" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="btn btn-default">
                    <input type="radio" name="options" value="all"> All
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="options" value="rug"> Rug
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="options" value="furniture"> Furniture
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="options" value="lighting"> Lighting
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="options" value="accessories"> Accessories
                </label>
            </div>
        </div>
    </div><!-- container -->
@endsection

@section('after-scripts')
    <script>

    </script>
@endsection