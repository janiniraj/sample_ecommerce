@extends('frontend.layouts.master')
@section('after-styles')
  {{ Html::style('/frontend/css/cart.css') }}
@endsection
@section('content')
<div class="container" id="results-page">
    <div class="section">
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartData->getContent() as $singleKey => $singleValue)
                            <tr>
                                @php 
                                $productData = $productRepository->find($singleValue->attributes->product_id);

                                $images = json_decode($productData->main_image, true);
                                @endphp
                                <td><a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}"><img class="cart-product-image" src="{{ admin_url().'/img/products/thumbnail/'.$images[0] }}" /></a> </td>
                                <td>
                                <a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}">{{ $singleValue->name }}
                                </a>
                                <br/>
                                {{ $singleValue->attributes->size }}                                
                                </td>
                                <td>In stock</td>
                                {{ Form::open(['route' => 'frontend.checkout.cart-update', 'class' => 'form-horizontal cart-update', 'role' => 'form', 'method' => 'post']) }}

                                {{ Form::close() }}
                                <td><input class="form-control input-quantity" type="number" value="{{ $singleValue->quantity }}" /><button class="btn btn-sm btn-quantity">Update</button></td>
                                <td class="text-right">$ {{ $singleValue->price * $singleValue->quantity }}</td>
                                <td class="text-right"><a href="{{ route('frontend.checkout.cart.remove-item', $singleValue->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a> </td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">$ {{ $cartData->getSubTotal() }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>$ {{ $cartData->getTotal() }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button onclick='function test(){ window.location = "<?php echo url()->previous(); ?>"; } test();' class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a href="{{ route('frontend.checkout.checkout') }}" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
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