<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
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
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $products = $this->products->getAll();
        return view('backend.products.index')->with(['products' => $products]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('backend.products.create');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->products->create($request->all());

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Successfully saved.");
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Product $product, Request $request)
    {
        return view('backend.products.edit')
            ->withProduct($product);
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function update(Product $product, Request $request)
    {
        $this->products->update($product, $request->all());

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Updated.");
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Product $product, Request $request)
    {
        $this->products->delete($product);

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Deleted");
    }
}
