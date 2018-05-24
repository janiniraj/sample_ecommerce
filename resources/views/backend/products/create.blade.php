@extends ('backend.layouts.app')

@section ('title', 'Product Management' . ' | ' . 'Create Product')

@section('page-header')
    <h1>
        Product Management
        <small>Create Product</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.product.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Create Product</h3>

                <div class="box-tools pull-right">
                    @include('backend.products.partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('type', 'Type', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        {{ Form::select('type', config('constant.product_types'), null, ['class' => 'form-control', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product Name']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('sku', 'SKU', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('sku', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product SKU']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('brand', 'Brand', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('brand', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Product Brand']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('category_id', 'Category', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('category_id', $categoryList, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Category']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('subcategory_id', 'Collection', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('subcategory_id', [], null, ['id' => 'subcategory_id', 'class' => 'form-control', 'placeholder' => 'Select Collection']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('style_id', 'Style', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('style_id', $styleList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Style']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('material_id', 'Material', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('material_id', $materialList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Material']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('weave_id', 'Weaves', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('weave_id', $weaveList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Weaves']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->                
                <div class="form-group">
                    {{ Form::label('color_id', 'Color', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <?php /*{{ Form::select('color_id', $colorList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Color']) }}*/ ?>
                        <select class="form-control" required="required" id="color_id" name="color_id">
                            <option selected="selected" value="">Select Color</option>
                            @foreach($colorList as $key => $value)
                                <option value="{{ $key }}" colorvalue="{{ $value }}">{{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('border_color_id', 'Border Color', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <?php /*{{ Form::select('border_color_id', $colorList, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Not Applicable']) }}*/ ?>
                        <select class="form-control" required="required" id="border_color_id" name="border_color_id">
                            <option selected="selected" value="">Not Applicable</option>
                            @foreach($colorList as $key => $value)
                                <option value="{{ $key }}" colorvalue="{{ $value }}">{{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('shape', 'Shape', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::select('shape', config('constant.shapes'), null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Shape']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="size-container">
                    <div class="form-group">
                        {{ Form::label('length', 'Size Length (Feet)', ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::number('length[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Size Length', 'step' => '0.01']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('width', 'Size Width (Feet)', ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::number('width[0]', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Size Width', 'step' => '0.01']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button class="btn btn-success add-size">Add More Size</button>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('foundation', 'Foundation', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('foundation', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required','placeholder' => 'Product Foundation']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('knote_per_sq', 'Knote Per Sq.', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('knote_per_sq', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required','placeholder' => 'Knote Per Sq.']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('country_origin', 'Country Of Origin', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        {{ Form::select('country_origin', config('constant.countries'), null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Country of Origin']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('main_image', 'Image', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10 image-container">
                        <div class="file-input-cloned">
                        <img class="image-display hidden">
                        {{ Form::file('main_image[]', ['id' => 'files', 'class' => 'files', 'required' => 'required', 'accept' => "image/x-png,image/gif,image/jpeg"]) }}
                        </div>
                        <button id="add_more_image" class="btn btn-success margin-top">Add More</button>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('detail', 'Details', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('detail', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Product Detail', 'rows' => 3]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('amazon_link', 'Amazon Link', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('amazon_link', null, ['class' => 'form-control', 'placeholder' => 'Product Amazon Link', 'rows' => 3]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('ebay_link', 'Ebay Link', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('ebay_link', null, ['class' => 'form-control', 'placeholder' => 'Product Ebay Link', 'rows' => 3]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('other_link', 'Other Link', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('other_link', null, ['class' => 'form-control', 'placeholder' => 'Product Other Store Link', 'rows' => 3]) }}
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
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
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

        $("#category_id").on('change', function (e) {
            var html = '<option selected="selected" value="">Select Collection</option>';
            var categoryId = $(this).val();
            if(categoryId)
            {
                $.ajax({
                    url: "<?php echo url('/') ?>"+"/admin/subcategories/"+categoryId+"/get",
                    type:'GET',
                    success:function(data) {
                        $.each(data, function (singleKey, singleValue) {
                            html += '<option value="'+singleValue.id+'">'+singleValue.subcategory+'</option>';
                        });
                        $("#subcategory_id").html(html);
                    }
                });
            }
            else
            {
                $("#subcategory_id").html(html);
            }
        });
        var closeButtonHtml = "<button class='btn btn-sm btn-warning delete-rule'>X</button>";
        ruleIndex = 0;
        $(".add-size").on('click', function(e){
            e.preventDefault();
            var clonedInput = $('.size-container').eq(0).clone();
            ruleIndex++;
            clonedInput.find('input').each(function() {
                this.name   = this.name.replace('[0]', '['+ruleIndex+']');
                this.value  = "";
            });
            if(clonedInput.find('.delete-rule').length == 0)
            {
                $(clonedInput).append(closeButtonHtml);
            }
            $(clonedInput).insertAfter(".size-container:last");
            //$('.size-container:last').append(closeButtonHtml);
        });

        $(document).on('click', ".delete-rule", function(e){
            e.preventDefault();
            $(this).closest('.size-container').remove();
        });
        $("#color_id option, #border_color_id option").each(function(e){
            var colorValue = $(this).attr('colorvalue');
            if(colorValue !== undefined)
            {
                console.log(colorValue);
                var n_match  = ntc.name(colorValue);
                console.log(n_match);
                if(n_match[1].length)
                {
                    $(this).html(n_match[1]);
                }
            }
        });

    });
</script>
@endsection