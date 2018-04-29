<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use Illuminate\Http\Request;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @param ProductRepository       $products
     */
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * Product List
     *
     * @param $categoryId
     * @param Request $request
     * @return $this
     */
    public function index($categoryId, Request $request)
    {
        $products = $this->products->getAll();
        return view('frontend.products.index')->with(['products' => $products]);
    }

    /**
     * Product Show
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($productId)
    {
        return view('frontend.products.show');
    }

}
