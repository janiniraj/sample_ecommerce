<?php namespace App\Helpers\Frontend;

use App\Models\Product\Product;
use App\Models\Product\UserFavourite;
use App\Models\Setting\Setting;
use Auth, Cart, Session;

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


    public $furnitureCategoryList;

    public $furnitureCollection;

    public $furnitureStyleList;

    public $furnitureMaterialList;

    public $furnitureWeaveList;

    public $furnitureColorList;

    public $furnitureShapeList;

    public $favouriteCount;

    public $settings;

    public $catalogLink;

    public $cartCount;

    public function __construct()
    {
        $this->product          = new Product();
        $this->rugCategoryList  = $this->product->where('products.type', 'rug')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();
        $this->rugCollection    = $this->product->where('products.type', 'rug')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();
        $this->rugStyleList     = $this->product->where('products.type', 'rug')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->orderBy('styles.name')->get();
        $this->rugMaterialList  = $this->product->where('products.type', 'rug')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->orderBy('materials.name', 'ASC')->get();
        $this->rugWeaveList     = $this->product->where('products.type', 'rug')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->orderBy('weaves.name', 'ASC')->get();
        $this->rugColorList     = $this->product->where('products.type', 'rug')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->orderBy('colors.name', 'ASC')->get();
        $this->rugShapeList     = $this->product->where('products.type', 'rug')->select('products.shape')->groupBy('products.shape')->orderBy('products.shape', 'ASC')->get();

        $this->lightingCategoryList = $this->product->where('products.type', 'lighting')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();
        $this->lightingCollection   = $this->product->where('products.type', 'lighting')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();
        $this->lightingStyleList    = $this->product->where('products.type', 'lighting')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->orderBy('styles.name', 'ASC')->get();
        $this->lightingMaterialList = $this->product->where('products.type', 'lighting')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->orderBy('materials.name', 'ASC')->get();
        $this->lightingWeaveList    = $this->product->where('products.type', 'lighting')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->orderBy('weaves.name', 'ASC')->get();
        $this->lightingColorList    = $this->product->where('products.type', 'lighting')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->orderBy('colors.name', 'ASC')->get();
        $this->lightingShapeList    = $this->product->where('products.type', 'lighting')->select('products.shape')->groupBy('products.shape')->orderBy('products.shape', 'ASC')->get();

        $this->accessoriesCategoryList = $this->product->where('products.type', 'accessories')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();
        $this->accessoriesCollection   = $this->product->where('products.type', 'accessories')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();
        $this->accessoriesStyleList    = $this->product->where('products.type', 'accessories')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->orderBy('styles.name', 'ASC')->get();
        $this->accessoriesMaterialList = $this->product->where('products.type', 'accessories')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->orderBy('materials.name', 'ASC')->get();
        $this->accessoriesWeaveList    = $this->product->where('products.type', 'accessories')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->orderBy('weaves.name', 'ASC')->get();
        $this->accessoriesColorList    = $this->product->where('products.type', 'accessories')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->orderBy('colors.name', 'ASC')->get();
        $this->accessoriesShapeList    = $this->product->where('products.type', 'accessories')->select('products.shape')->groupBy('products.shape')->orderBy('products.shape', 'ASC', 'ASC')->get();

        $this->furnitureCategoryList = $this->product->where('products.type', 'furniture')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();
        $this->furnitureCollection   = $this->product->where('products.type', 'furniture')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();
        $this->furnitureStyleList    = $this->product->where('products.type', 'furniture')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->orderBy('styles.name', 'ASC')->get();
        $this->furnitureMaterialList = $this->product->where('products.type', 'furniture')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->orderBy('materials.name', 'ASC')->get();
        $this->furnitureWeaveList    = $this->product->where('products.type', 'furniture')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->orderBy('weaves.name', 'ASC')->get();
        $this->furnitureColorList    = $this->product->where('products.type', 'furniture')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->orderBy('colors.name', 'ASC')->get();
        $this->furnitureShapeList    = $this->product->where('products.type', 'furniture')->select('products.shape')->groupBy('products.shape')->orderBy('products.shape', 'ASC')->get();

        $this->favouriteCount = 0;

        if(Auth::check())
        {
            $userId             = Auth::user()->id;
            $productFavourite   = new UserFavourite();

            $this->favouriteCount = $productFavourite->where('user_id', $userId)->count();
        }

        $this->settings = Setting::get();

        $this->catalogLink = "#";

        foreach($this->settings as $single)
        {
            if($single->key == 'catalog')
            {
                $this->catalogLink = env('ADMIN_URL').'/settings/'.$single->value;
            }
        }

        // Cart Logic
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

        $this->cartCount = Cart::session($cartId)->getContent()->count();
    }
}
