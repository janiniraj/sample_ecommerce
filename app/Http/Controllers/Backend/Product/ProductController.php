<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Repositories\Backend\Style\StyleRepository;
use App\Repositories\Backend\Material\MaterialRepository;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Repositories\Backend\Color\ColorRepository;

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
    public function __construct()
    {
        $this->products     = new ProductRepository();
        $this->category     = new CategoriesRepository();
        $this->subCategory  = new SubCategoriesRepository();
        $this->style        = new StyleRepository();
        $this->material     = new MaterialRepository();
        $this->weave        = new WeaveRepository();
        $this->color        = new ColorRepository();
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
        $categoryList   = $this->category->query()->where('status', 1)->pluck('category', 'id');
        $styleList      = $this->style->query()->where('status', 1)->pluck('name', 'id');
        $materialList   = $this->material->query()->where('status', 1)->pluck('name', 'id');
        $weaveList      = $this->weave->query()->where('status', 1)->pluck('name', 'id');
        $colorList      = $this->color->query()->where('status', 1)->pluck('name', 'id');

        return view('backend.products.create')->with([
            'categoryList'  => $categoryList,
            'styleList'     => $styleList,
            'materialList'  => $materialList,
            'weaveList'     => $weaveList,
            'colorList'     => $colorList
            ]);
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
        $categoryList   = $this->category->query()->where('status', 1)->pluck('category', 'id');
        $styleList      = $this->style->query()->where('status', 1)->pluck('name', 'id');
        $materialList   = $this->material->query()->where('status', 1)->pluck('name', 'id');
        $weaveList      = $this->weave->query()->where('status', 1)->pluck('name', 'id');
        $colorList      = $this->color->query()->where('status', 1)->pluck('name', 'id');
        $subcategoryList = $this->subCategory->query()->where('category_id', $product->category_id)->pluck('subcategory', 'id');

        return view('backend.products.edit')
            ->with([
                    'product' => $product,
                    'categoryList'  => $categoryList,
                    'styleList'     => $styleList,
                    'materialList'  => $materialList,
                    'weaveList'     => $weaveList,
                    'colorList'     => $colorList,
                    'subcategoryList' => $subcategoryList
                ]);
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
