@extends('frontend.layouts.master')
@section('content')
    <div class='container'>
        <div class='row' style='padding-top:25px; padding-bottom:25px;'>
            <div class='col-md-12'>
                <div id='mainContentWrapper'>
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-align: center;">
                            Review Your Order & Complete Checkout
                        </h2>
                        <hr/>
                        <div class="shopping_cart">
                            <div class="panel-group" id="accordion">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Contact and Billing Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                        {{ Form::open(['route' => 'frontend.checkout.add_user_address', 'id' => 'user_billing', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}

                                            {{ Form::hidden('user_id', Auth::user()->id) }}
                                            {{ Form::hidden('type', 'billing') }}

                                            <b>Help us keep your account safe and secure, please verify your billing
                                                information.</b>
                                            <br/><br/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Best Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email" name="email" value="{{ isset($billingAddress->email) ? $billingAddress->email : '' }}" required="required" type="email"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">First name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_first_name" name="first_name" value="{{ isset($billingAddress->first_name) ? $billingAddress->first_name : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Last name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_last_name" name="last_name" value="{{ isset($billingAddress->last_name) ? $billingAddress->last_name : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Address:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_1" value="{{ isset($billingAddress->address) ? $billingAddress->address : '' }}" name="address" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Unit / Suite #:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_2" value="{{ isset($billingAddress->street) ? $billingAddress->street : '' }}" name="street" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_city" name="city" value="{{ isset($billingAddress->city) ? $billingAddress->city : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="form-control" id="id_state" name="state">
                                                            <option {{ isset($billingAddress->state) && $billingAddress->state == "AK" ? "selected" : "" }} value="AK">Alaska</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "AL" ? "selected" : "" }} value="AL">Alabama</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "AZ" ? "selected" : "" }} value="AZ">Arizona</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "AR" ? "selected" : "" }} value="AR">Arkansas</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "CA" ? "selected" : "" }} value="CA">California</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "CO" ? "selected" : "" }} value="CO">Colorado</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "CT" ? "selected" : "" }} value="CT">Connecticut</option>
                                                            <option {{ isset($billingAddress->state) && $billingAddress->state == "DE" ? "selected" : "" }}  value="DE">Delaware</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "FL" ? "selected" : "" }} value="FL">Florida</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "GA" ? "selected" : "" }} value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "ID" ? "selected" : "" }} value="ID">Idaho</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "IL" ? "selected" : "" }} value="IL">Illinois</option>
                                                            <option {{ isset($billingAddress->state) && $billingAddress->state == "IN" ? "selected" : "" }}  value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "KS" ? "selected" : "" }} value="KS">Kansas</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "KY" ? "selected" : "" }} value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "ME" ? "selected" : "" }} value="ME">Maine</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MD" ? "selected" : "" }} value="MD">Maryland</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MA" ? "selected" : "" }} value="MA">Massachusetts</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MI" ? "selected" : "" }} value="MI">Michigan</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MN" ? "selected" : "" }} value="MN">Minnesota</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MS" ? "selected" : "" }} value="MS">Mississippi</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MO" ? "selected" : "" }} value="MO">Missouri</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "MT" ? "selected" : "" }} value="MT">Montana</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NE" ? "selected" : "" }} value="NE">Nebraska</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NV" ? "selected" : "" }} value="NV">Nevada</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NH" ? "selected" : "" }} value="NH">New Hampshire</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NJ" ? "selected" : "" }} value="NJ">New Jersey</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NM" ? "selected" : "" }} value="NM">New Mexico</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NY" ? "selected" : "" }} value="NY">New York</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "NC" ? "selected" : "" }} value="NC">North Carolina</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "ND" ? "selected" : "" }} value="ND">North Dakota</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "OH" ? "selected" : "" }} value="OH">Ohio</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "OK" ? "selected" : "" }} value="OK">Oklahoma</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "OR" ? "selected" : "" }} value="OR">Oregon</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "PA" ? "selected" : "" }} value="PA">Pennsylvania</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "RI" ? "selected" : "" }} value="RI">Rhode Island</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "SC" ? "selected" : "" }} value="SC">South Carolina</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "SD" ? "selected" : "" }} value="SD">South Dakota</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "TN" ? "selected" : "" }} value="TN">Tennessee</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "TX" ? "selected" : "" }} value="TX">Texas</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "UT" ? "selected" : "" }} value="UT">Utah</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "VT" ? "selected" : "" }} value="VT">Vermont</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "VA" ? "selected" : "" }} value="VA">Virginia</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "WA" ? "selected" : "" }} value="WA">Washington</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "DC" ? "selected" : "" }} value="DC">Washington D.C.</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "WV" ? "selected" : "" }} value="WV">West Virginia</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "WI" ? "selected" : "" }} value="WI">Wisconsin</option>
                                                            <option  {{ isset($billingAddress->state) && $billingAddress->state == "WY" ? "selected" : "" }} value="WY">Wyoming</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_postalcode">Postalcode:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_postalcode" name="postal_code" value="{{ isset($billingAddress->postal_code) ? $billingAddress->postal_code : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_phone">Phone:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_phone" name="phone" value="{{ isset($billingAddress->phone) ? $billingAddress->phone : '' }}" type="text"/>
                                                    </td>
                                                </tr>

                                            </table>
                                            {{ Form::close() }}
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;">
                                                
                                                <a style="width:100%;" class=" btn btn-success billing-submit">Continue to Shipping Information»</a>   
                                            </div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Contact and Shipping Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        {{ Form::open(['route' => 'frontend.checkout.add_user_address', 'id' => 'user_shipping', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}

                                                {{ Form::hidden('user_id', Auth::user()->id) }}
                                                {{ Form::hidden('type', 'shipping') }}

                                            <b>Help us keep your account safe and secure, please verify your Shipping
                                                information.</b>
                                            <br/><br/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Best Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email2" name="email" value="{{ isset($shippingAddress->email) ? $shippingAddress->email : '' }}" required="required" type="email"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">First name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_first_name2" value="{{ isset($shippingAddress->first_name) ? $shippingAddress->first_name : '' }}" name="first_name" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Last name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_last_name2" name="last_name" value="{{ isset($shippingAddress->last_name) ? $shippingAddress->last_name : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Address:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_1_2" value="{{ isset($shippingAddress->address) ? $shippingAddress->address : '' }}" name="address" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Unit / Suite #:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_2_2" value="{{ isset($shippingAddress->street) ? $shippingAddress->street : '' }}" name="street" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_city2" name="city" value="{{ isset($shippingAddress->city) ? $shippingAddress->city : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="form-control" id="id_state2" name="state">
                                                            <option {{ isset($shippingAddress->state) && $shippingAddress->state == "AK" ? "selected" : "" }} value="AK">Alaska</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "AL" ? "selected" : "" }} value="AL">Alabama</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "AZ" ? "selected" : "" }} value="AZ">Arizona</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "AR" ? "selected" : "" }} value="AR">Arkansas</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "CA" ? "selected" : "" }} value="CA">California</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "CO" ? "selected" : "" }} value="CO">Colorado</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "CT" ? "selected" : "" }} value="CT">Connecticut</option>
                                                            <option {{ isset($shippingAddress->state) && $shippingAddress->state == "DE" ? "selected" : "" }}  value="DE">Delaware</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "FL" ? "selected" : "" }} value="FL">Florida</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "GA" ? "selected" : "" }} value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "ID" ? "selected" : "" }} value="ID">Idaho</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "IL" ? "selected" : "" }} value="IL">Illinois</option>
                                                            <option {{ isset($shippingAddress->state) && $shippingAddress->state == "IN" ? "selected" : "" }}  value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "KS" ? "selected" : "" }} value="KS">Kansas</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "KY" ? "selected" : "" }} value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "ME" ? "selected" : "" }} value="ME">Maine</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MD" ? "selected" : "" }} value="MD">Maryland</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MA" ? "selected" : "" }} value="MA">Massachusetts</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MI" ? "selected" : "" }} value="MI">Michigan</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MN" ? "selected" : "" }} value="MN">Minnesota</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MS" ? "selected" : "" }} value="MS">Mississippi</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MO" ? "selected" : "" }} value="MO">Missouri</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "MT" ? "selected" : "" }} value="MT">Montana</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NE" ? "selected" : "" }} value="NE">Nebraska</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NV" ? "selected" : "" }} value="NV">Nevada</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NH" ? "selected" : "" }} value="NH">New Hampshire</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NJ" ? "selected" : "" }} value="NJ">New Jersey</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NM" ? "selected" : "" }} value="NM">New Mexico</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NY" ? "selected" : "" }} value="NY">New York</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "NC" ? "selected" : "" }} value="NC">North Carolina</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "ND" ? "selected" : "" }} value="ND">North Dakota</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "OH" ? "selected" : "" }} value="OH">Ohio</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "OK" ? "selected" : "" }} value="OK">Oklahoma</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "OR" ? "selected" : "" }} value="OR">Oregon</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "PA" ? "selected" : "" }} value="PA">Pennsylvania</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "RI" ? "selected" : "" }} value="RI">Rhode Island</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "SC" ? "selected" : "" }} value="SC">South Carolina</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "SD" ? "selected" : "" }} value="SD">South Dakota</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "TN" ? "selected" : "" }} value="TN">Tennessee</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "TX" ? "selected" : "" }} value="TX">Texas</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "UT" ? "selected" : "" }} value="UT">Utah</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "VT" ? "selected" : "" }} value="VT">Vermont</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "VA" ? "selected" : "" }} value="VA">Virginia</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "WA" ? "selected" : "" }} value="WA">Washington</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "DC" ? "selected" : "" }} value="DC">Washington D.C.</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "WV" ? "selected" : "" }} value="WV">West Virginia</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "WI" ? "selected" : "" }} value="WI">Wisconsin</option>
                                                            <option  {{ isset($shippingAddress->state) && $shippingAddress->state == "WY" ? "selected" : "" }} value="WY">Wyoming</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_postalcode2">Postalcode:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_postalcode2" name="postal_code" value="{{ isset($shippingAddress->postal_code) ? $shippingAddress->postal_code : '' }}" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_phone2">Phone:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_phone2" value="{{ isset($shippingAddress->phone) ? $shippingAddress->phone : '' }}" name="phone" type="text"/>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center;">
                                                <a class=" btn   btn-success shipping-submit" id="payInfo" style="width:100%;display: none;">Enter Payment Information »</a>
                                            </div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverview">OverView</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOverview" class="panel-collapse collapse">
                                        <div class="panel-body">
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
                                                                <td>{{ $singleValue->quantity }}</td>
                                                                <td class="text-right">$ {{ $singleValue->price * $singleValue->quantity }}</td>
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
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <b>Payment Information</b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <span class='payment-errors'></span>
                                            <fieldset>
                                                <legend>What method would you like to pay with today?</legend>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="card-holder-name">Name on
                                                        Card</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" stripe-data="name" id="name-on-card" placeholder="Card Holder's Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="card-number">Card
                                                        Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" stripe-data="number" id="card-number" placeholder="Debit/Credit Card Number">
                                                        <br/>
                                                        <div><img class="pull-right" src="https://s3.amazonaws.com/hiresnetwork/imgs/cc.png" style="max-width: 250px; padding-bottom: 20px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="expiry-month">Expiration
                                                            Date</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-xs-3">
                                                                    <select class="form-control col-sm-2" data-stripe="exp-month" id="card-exp-month" style="margin-left:5px;">
                                                                        <option>Month</option>
                                                                        <option value="01">Jan (01)</option>
                                                                        <option value="02">Feb (02)</option>
                                                                        <option value="03">Mar (03)</option>
                                                                        <option value="04">Apr (04)</option>
                                                                        <option value="05">May (05)</option>
                                                                        <option value="06">June (06)</option>
                                                                        <option value="07">July (07)</option>
                                                                        <option value="08">Aug (08)</option>
                                                                        <option value="09">Sep (09)</option>
                                                                        <option value="10">Oct (10)</option>
                                                                        <option value="11">Nov (11)</option>
                                                                        <option value="12">Dec (12)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <select class="form-control" data-stripe="exp-year" id="card-exp-year">
                                                                        <option value="2016">2016</option>
                                                                        <option value="2017">2017</option>
                                                                        <option value="2018">2018</option>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="cvv">Card CVC</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" stripe-data="cvc" id="card-cvc" placeholder="Security Code">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-9">
                                                        </div>
                                                    </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-success btn-lg" style="width:100%;">Pay Now
                                            </button>
                                            <br/>
                                            <div style="text-align: left;"><br/>
                                                By submiting this order you are agreeing to our <a href="/legal/billing/">universal billing agreement</a>, and <a href="/legal/terms/">terms of service</a>. If you have any questions about our products or services please contact us before placing this order.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script>
    $(document).ready(function(){
        $("#user_billing").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:      $(this).attr('action'),
                type:     $(this).attr('method'),
                data:     $(this).serialize(),
                success: function(data) {
                    $('#accordion .in').collapse('hide');
                    $(".billing-submit").fadeOut(); 
                    $('#collapseTwo').collapse('show');
                    $(".shipping-submit").fadeIn();
                }
            });
        });

        $("#user_shipping").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:      $(this).attr('action'),
                type:     $(this).attr('method'),
                data:     $(this).serialize(),
                success: function(data) {
                    if(data.rates)
                    {
                        alert("Shipping Charges Added: $"+data.rates);

                        $('#accordion .in').collapse('hide');
                        $(".shipping-submit").fadeOut(); 
                        $('#collapseThree').collapse('show');
                    }
                    else
                    {
                        alert("Error in Address.");
                    }                    
                }
            });
        });

        $(".billing-submit").on("click", function(){
            $("#user_billing").submit();
        });

        $(".shipping-submit").on("click", function(){
            $("#user_shipping").submit();
            //$(this).fadeOut(); 
            //$('#payInfo').fadeIn();
        });
    });
    </script>
@endsection