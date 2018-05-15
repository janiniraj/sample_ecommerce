<?php namespace App\Helpers\Frontend;

use App\Models\Product\Product;

/**
 * Class MenuHelper.
 */
class MenuHelper
{
    public $product;

    public $rugCategoryList;

    public $rugCollection;

    public $rugStyleList;

    public $rugMaterialList;

    public $rugWeaveList;

    public $rugColorList;

    public $rugShapeList;


    public $lightingCategoryList;

    public $lightingCollection;

    public $lightingStyleList;

    public $lightingMaterialList;

    public $lightingWeaveList;

    public $lightingColorList;

    public $lightingShapeList;


    public $accessoriesCategoryList;

    public $accessoriesCollection;

    public $accessoriesStyleList;

    public $accessoriesMaterialList;

    public $accessoriesWeaveList;

    public $accessoriesColorList;

    public $accessoriesShapeList;

    public function __construct()
    {
        $this->product          = new Product();
        $this->rugCategoryList  = $this->product->where('products.type', 'rug')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->rugCollection    = $this->product->where('products.type', 'rug')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->rugStyleList     = $this->product->where('products.type', 'rug')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->rugMaterialList  = $this->product->where('products.type', 'rug')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->rugWeaveList     = $this->product->where('products.type', 'rug')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->rugColorList     = $this->product->where('products.type', 'rug')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->rugShapeList     = $this->product->where('products.type', 'rug')->select('products.shape')->groupBy('products.shape')->get();

        $this->lightingCategoryList = $this->product->where('products.type', 'lighting')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->lightingCollection   = $this->product->where('products.type', 'lighting')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->lightingStyleList    = $this->product->where('products.type', 'lighting')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->lightingMaterialList = $this->product->where('products.type', 'lighting')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->lightingWeaveList    = $this->product->where('products.type', 'lighting')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->lightingColorList    = $this->product->where('products.type', 'lighting')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->lightingShapeList    = $this->product->where('products.type', 'lighting')->select('products.shape')->groupBy('products.shape')->get();

        $this->accessoriesCategoryList = $this->product->where('products.type', 'accessories')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->accessoriesCollection   = $this->product->where('products.type', 'accessories')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->accessoriesStyleList    = $this->product->where('products.type', 'accessories')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->accessoriesMaterialList = $this->product->where('products.type', 'accessories')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->accessoriesWeaveList    = $this->product->where('products.type', 'accessories')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->accessoriesColorList    = $this->product->where('products.type', 'accessories')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->accessoriesShapeList    = $this->product->where('products.type', 'accessories')->select('products.shape')->groupBy('products.shape')->get();
    }
}
