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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cartUpdate(Request $request)
    {
        $postData = $request->all();

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
                    $passRates = (array)$rates->RatedShipment[0]->TotalCharges->MonetaryValue;
                }

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

        $condition = new CartCondition(array(
            'name' => 'VAT 12.5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '12.5%',
            'attributes' => array( // attributes field is optional
                'description' => 'Value added tax',
                'more_data' => 'more data here'
            )
        ));

        Cart::condition($condition);
        Cart::session($userId)->condition($condition);
        dd($postData);
    }
}
