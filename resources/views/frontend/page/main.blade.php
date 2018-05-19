@extends('frontend.layouts.master')

@section('after-styles')
	@if(isset($styleName) && $styleName)
		{{ Html::style('/frontend/css/'.$styleName) }}
	@endif    
@endsection

@section('content')
    @if(isset($pageData->content))
        {!! $pageData->content !!}
    @endif
@endsection