@extends ('backend.layouts.app')

@section ('title', 'Product Management' . ' | ' . 'Edit Product')

@section('page-header')
    <h1>
        Product Management
        <small>Edit Product</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($product, ['route' => ['admin.product.update', $product], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Product</h3>

                <div class="box-tools pull-right">
                    @include('backend.products.partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', 'Product Name', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product Name']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('main_image', 'Product Image', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10 image-container">
                        @php
                            $images = json_decode($product->main_image, true);
                            foreach($images as $singleImage) {
                                echo '<img class="image-display margin" src="'.url('/').'/uploads/products/'.$singleImage.'">';
                            }
                        @endphp
                        <div class="file-input-cloned">
                            <img class="image-display hidden">
                            {{ Form::file('main_image[]', ['id' => 'files', 'class' => 'files', 'accept' => "image/x-png,image/gif,image/jpeg"]) }}
                        </div>
                        <button id="add_more_image" class="btn btn-success margin-top">Add More</button>
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.product.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script>
        $(document).ready(function() {
            $("#add_more_image").on('click', function(e){
                e.preventDefault();
                var html = '<div class="file-input-cloned"> <img class="image-display hidden"><input class="files" required="required" accept="image/x-png,image/gif,image/jpeg" name="main_image[]" type="file"><span class="remove">X</span></div>';
                $(html).insertBefore(this);
            });

            $(document).on('change', ".files", function ()
            {
                var fileInput = $(this);
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        fileInput.closest('div').find('.image-display')
                            .attr('src', e.target.result).removeClass('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
            $(document).on('click', '.remove', function()
            {
                $(this).closest('div').remove();
            });
        });
    </script>
@endsection