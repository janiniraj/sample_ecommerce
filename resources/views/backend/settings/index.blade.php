@extends ('backend.layouts.app')

@section ('title', 'Settings' )

@section('page-header')
    <h1>
        Settings
        <small>Settings</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.settings.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('site_name', 'Site Name: ', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('site_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Site Name']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group image-upload-container">
                    {{ Form::label('logo', 'Logo:', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        <img class="image-display {{ isset($setting->image) ? '' : 'hidden' }}" src="{{ isset($setting->image) ? URL::to('/').'/img/sliders/'.$setting->image : "" }}" style="max-height: 100px;">
                        {{ Form::file('logo', $attributes = array('required' => 'required', 'class' => 'image', 'accept' => "image/x-png,image/gif,image/jpeg")) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('catalog', 'Catalog:', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::file('catalog', $attributes = array('required' => 'required', 'accept' => "application/pdf")) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('vendor_form', 'Vendor Form:', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::file('vendor_form', $attributes = array('required' => 'required', 'accept' => "application/pdf")) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div>
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
        $(".image").on('change', function ()
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-display')
                        .attr('src', e.target.result).removeClass('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endsection