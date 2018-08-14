<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Request, Session, Cart, Auth;
use App\Models\Product\ProductSize;
use App\Repositories\Backend\Product\ProductRepository;

/**
 * Class CheckoutController.
 */
class CheckoutController extends Controller
{

	public function __construct()
	{
		$this->productRepository 	= new ProductRepository();
		$this->productSize			= new ProductSize();
	}
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart(Request $request)
    {
    	if(Auth::check())
        {
            $cartId = Auth::user()->id;
        }
        else
        {
            if(Session::has('cartSessionId'))
            {
                $cartId = Session::get('cartSessionId');                
            }
            else
            {
                $cartId = rand(0,9999);
                session(['cartSessionId' => $cartId]);
            }
        }

        $cartData = Cart::session($cartId);
        
        if(empty($cartData->getContent()->count()))
        {
        	return redirect()->route('frontend.index')->withFlashWarning("No Product in the Cart.");
        }
        return view('frontend.checkout.cart')->with([
        	'cartData' 			=> $cartData,
        	'productRepository' => $this->productRepository,
        	'productSize'		=> $this->productSize
        	]);
    }
}
