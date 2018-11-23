<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Session, Cart, Auth;
use App\Models\Product\ProductSize;
use App\Repositories\Backend\Product\ProductRepository;
use App\Models\UserAddress\UserAddress;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use App\Models\Promo\Promo;
use App\Models\Product\Product;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

/**
 * Class CheckoutController.
 */
class CheckoutController extends Controller
{
    /**
     * CheckoutController constructor.
     */
	public function __construct()
	{
		$this->productRepository 	= new ProductRepository();
		$this->productSize			= new ProductSize();
        $this->userAddress          = new UserAddress();
        $this->promo                = new Promo();
        $this->product              = new Product();
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
        	'productSize'		=> $this->productSize,
            'promos'            => $cartData->getConditionsByType('promo')
        	]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cartUpdate(Request $request)
    {
        $postData = $request->all();

        $this->productSize;

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

        $sizeId = $cartData->get($postData['item_id'])->attributes->size_id;

        $sizeData = $this->productSize->find($sizeId);

        if(isset($sizeData->quantity) && $sizeData->quantity < $postData['quantity'])
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Not Enough Quantity Available to Update.");
        }

        Cart::session($cartId)->update($postData['item_id'], array(
            'quantity' => array(
                'relative' => false,
                'value' => $postData['quantity']
            )
        ));

        return redirect()->route('frontend.checkout.cart');
    }

    /**
     * @param $itemId
     * @return mixed
     */
    public function removeItemFromCart($itemId)
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

        Cart::session($cartId)->remove($itemId);
        return redirect()->route('frontend.checkout.cart')->withFlashWarning("Item Successfully Deleted.");
    }

    /**
     * @return $this
     */
    public function checkout()
    {
        $userId = Auth::user()->id;

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

        $billingAddress = $this->userAddress
                    ->where('type', 'billing')
                    ->where('user_id', $userId)
                    ->first();

        $shippingAddress = $this->userAddress
                    ->where('type', 'shipping')
                    ->where('user_id', $userId)
                    ->first();

        return view('frontend.checkout.checkout')->with([
            'cartData'          => $cartData,
            'productRepository' => $this->productRepository,
            'productSize'       => $this->productSize,
            'billingAddress'    => $billingAddress,
            'shippingAddress'   => $shippingAddress
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddUserAddress(Request $request)
    {
        $postData = $request->all();

        $check = $this->userAddress
                    ->where('type', $postData['type'])
                    ->where('user_id', $postData['user_id'])
                    ->first();

        if($check)
        {
            $check->user_id = $postData['user_id'];
            $check->type = $postData['type'];
            $check->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
            $check->first_name = $postData['first_name'];
            $check->last_name = $postData['last_name'];
            $check->address = $postData['address'];
            $check->street = $postData['street'];
            $check->city = $postData['city'];
            $check->state = $postData['state'];
            $check->postal_code = $postData['postal_code'];
            $check->phone = $postData['phone'];
            $check->country = 'USA';

            $check->save();
        }
        else
        {
            $model = new UserAddress();
            $model->user_id = $postData['user_id'];
            $model->type = $postData['type'];
            $model->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
            $model->first_name = $postData['first_name'];
            $model->last_name = $postData['last_name'];
            $model->address = $postData['address'];
            $model->street = $postData['street'];
            $model->city = $postData['city'];
            $model->state = $postData['state'];
            $model->postal_code = $postData['postal_code'];
            $model->phone = $postData['phone'];
            $model->country = 'USA';

            $model->save();
        }

        if($postData['type'] == 'shipping')
        {
            $rate = new \Ups\Rate(
                    env('UPS_ACCESS_KEY'),
                    env('UPS_USERID'),
                    env('UPS_PASSWORD')
                );

            try {
                $shipment = new \Ups\Entity\Shipment();

                $shipperAddress = $shipment->getShipper()->getAddress();
                $shipperAddress->setPostalCode('20005');

                $address = new \Ups\Entity\Address();
                $address->setPostalCode('20005');
                $shipFrom = new \Ups\Entity\ShipFrom();
                $shipFrom->setAddress($address);

                $shipment->setShipFrom($shipFrom);

                $shipTo = $shipment->getShipTo();
                $shipTo->setCompanyName('Test Ship To');
                $shipToAddress = $shipTo->getAddress();
                $shipToAddress->setPostalCode('20005');

                $package = new \Ups\Entity\Package();
                $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
                $package->getPackageWeight()->setWeight(10);
                
                // if you need this (depends of the shipper country)
                /*$weightUnit = new \Ups\Entity\UnitOfMeasurement;
                $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
                $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);*/

                $dimensions = new \Ups\Entity\Dimensions();
                $dimensions->setHeight(10);
                $dimensions->setWidth(10);
                $dimensions->setLength(10);

                $unit = new \Ups\Entity\UnitOfMeasurement;
                $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

                $dimensions->setUnitOfMeasurement($unit);
                $package->setDimensions($dimensions);

                $shipment->addPackage($package);

                $rates = $rate->getRate($shipment);
                if(isset($rates->RatedShipment) && isset($rates->RatedShipment[0]))
                {
                    $passRates = $rates->RatedShipment[0]->TotalCharges->MonetaryValue;
                }

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

                $checkCartCondition = $cartData->getConditionsByType('coupon');

                if($checkCartCondition->count() > 0)
                {
                    foreach ($checkCartCondition as $key => $value) 
                    {
                        $cartData->removeCartCondition($key);
                    }
                }

                $condition = new CartCondition(array(
                    'name' => 'shipping',
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => '+'.$passRates,
                    'attributes' => array()
                ));

                Cart::session($cartId)->condition($condition);

                return response()->json([
                    'rates' => $passRates
                    ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
        }

        return response()->json(true);
    }

    public function applyPromo(Request $request)
    {
        $postData = $request->all();

        $checkPromo = $this->promo->where('code', $postData['promocode'])->first();

        if(!$checkPromo)
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("No such Promocode Exist.");
        }

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

        $checkCartCondition = $cartData->getConditionsByType('promo');
        
        if($checkCartCondition->count() > 0)
        {
            $promos = $checkCartCondition->all();

            $promoList = array_keys($promos);

            if(in_array($postData['promocode'], $promoList))
            {
                return redirect()->route('frontend.checkout.cart')->withFlashWarning("Procode Already Applied.");
            }

            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Only One Promocode can be applicable.");
        }
        else
        {
            if($checkPromo->type == 'flat')
            {
                $lessVal = '-'.$checkPromo->discount;
            }
            else
            {
                $lessVal = '-'.$checkPromo->discount.'%';
            }

            $condition = new CartCondition(array(
                'name' => $postData['promocode'],
                'type' => 'promo',
                'target' => 'total',
                'value' => $lessVal,
                'attributes' => array()
            ));   
        }

        Cart::session($cartId)->condition($condition);

        return redirect()->route('frontend.checkout.cart')->withFlashSuccess("Promocode Successfully Applied.");
    }

    public function removePromo(Request $request)
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

        $checkCartCondition = $cartData->getConditionsByType('promo');

        if($checkCartCondition->count() == 0)
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("No Promocode Applied.");
        }

        $promos = $checkCartCondition->all();

        foreach ($promos as $key => $value) 
        {
            $cartData->removeCartCondition($key);
        }

        return redirect()->route('frontend.checkout.cart')->withFlashSuccess("Promocode removed Successfully.");
        
    }

    public function beforePayment(Request $request)
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

        $provider = new ExpressCheckout;
        $provider->setCurrency('USD');

        $data = [];

        foreach($cartData->getContent() as $singleKey => $singleValue)
        {
            $productData = $this->productRepository->find($singleValue->attributes->product_id);

            $data['items'][] = [
                                    'name' => $singleValue->name,
                                    'price' => $singleValue->price,
                                    'qty' => $singleValue->quantity
                                ];
        }

        $data['invoice_id']             = 1;
        $data['invoice_description']    = "Order #{$data['invoice_id']} Invoice";
        $data['return_url']             = url('/payment/success');
        $data['cancel_url']             = url('/cart');

        $total = 0;
        foreach($data['items'] as $item) 
        {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;

        //give a discount of 10% of the order amount
        $shippingCondition = $cartData->getConditionsByType('coupon');
        if($shippingCondition->count() > 0)
        {
            $shippingData       = $shippingCondition->first();            
            $data['shipping']   = (float)str_replace('+', '', $shippingData->getValue());  
        }

        $response = $provider->setExpressCheckout($data);

        if((isset($response['type']) && $response['type'] == 'error') || (isset($response['paypal_link']) && !$response['paypal_link']))
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Error in Checkout with Paypal, Please try again later.");
        }
        else
        {
            return redirect($response['paypal_link']);    
        }
    }

    public function afterPayment(Request $request)
    {
        dd($request->all());
    }

    public function overview()
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

        return view('frontend.checkout.overview')->with([
            'cartData'          => $cartData,
            'productRepository' => $this->productRepository,
            'productSize'       => $this->productSize,
        ]);
    }
}
