<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Request;

/**
 * Class CheckoutController.
 */
class CheckoutController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart(Request $request)
    {
        return view('frontend.checkout.cart');
    }
}
