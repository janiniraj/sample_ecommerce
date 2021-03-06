<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use Illuminate\Http\Request;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Repositories\Backend\Style\StyleRepository;
use App\Repositories\Backend\Material\MaterialRepository;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Repositories\Backend\Color\ColorRepository;
use Redirect;
use App\Models\Product\UserFavourite;
use Auth;
use App\Models\Product\ProductReview;
use DB;
use App\Models\Product\ProductSize;
use Session, Cart;

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
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->products         = new ProductRepository();
        $this->categories       = new CategoriesRepository();
        $this->subcategories    = new SubCategoriesRepository();
        $this->style            = new StyleRepository();
        $this->material         = new MaterialRepository();
        $this->weave            = new WeaveRepository();
        $this->color            = new ColorRepository();
        $this->userFavourite    = new UserFavourite();
        $this->productReview    = new ProductReview();
        $this->productSize      = new ProductSize();
    }

    /**
     * Product List
     *
     * @param $categoryName
     * @param Request $request
     * @return $this
     */
    public function index($categoryName = NULL, Request $request)
    {
        $perPage = config('constant.perPage');

        $filterData = $request->all();

        if(isset($filterData['category']) && $filterData['category'])
        {
            $categoryId = $filterData['category'];

            unset($filterData['category']);

            $appendData = http_build_query($filterData);

            $categoryName = $this->categories->getCategoryNameById($categoryId);

            return Redirect::to('products/'.$categoryName.'?'.$appendData);
        }

        if($categoryName)
        {
            $categoryId     = $this->categories->getCategoryIdByName($categoryName);
            $collectionList = $this->subcategories->getSubCategoriesByCategory($categoryId); 
        }
        else
        {
            $collectionList = $this->subcategories->getAll();
        }

        $categoryList   = $this->categories->getAll();        
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();


        $products = $this->products->query();

        if(isset($categoryId) && $categoryId)
        {
            $products = $products->where('products.category_id', $categoryId);
        }        

        if(!empty($filterData))
        {
            if(isset($filterData['type']) && $filterData['type'] != 'all')
            {
                $products = $products->where('products.type', $filterData['type']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('products.subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('products.style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('products.material_id', $filterData['material']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('products.weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                //$products = $products->where('products.color_id', $filterData['color']);
                $products->join('product_colors as color_table', 'color_table.product_id', '=', 'products.id');
                $products = $products->where('color_table.color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('products.shape', $filterData['shape']);
            }

            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                /*$products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);*/

                $products = $products->join('product_sizes as width_table', 'width_table.product_id', '=', 'products.id');
                $products = $products->whereBetween('width_table.width', [$filterData['width_min'], $filterData['width_max']]);

            }

            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['length_min'] = $filterData['length_min']/12;
                    $filterData['length_max'] = $filterData['length_max']/12;
                }
                /*$products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);*/

                $products = $products->join('product_sizes as length_table', 'length_table.product_id', '=', 'products.id');
                $products = $products->whereBetween('length_table.length', [$filterData['length_min'], $filterData['length_max']]);
            }

            if(isset($filterData['search']) && $filterData['search'])
            {
                $products = $products->where('products.name', 'LIKE', "%".$filterData['search']."%");
            }

            if(isset($filterData['sku']) && $filterData['sku'])
            {
                $products = $products->where('products.sku', 'LIKE', "%".$filterData['sku']."%");
            }

            if(isset($filterData['country']) && $filterData['country'])
            {
                $products = $products->where('products.country_origin', $filterData['country']);
            }

            if(isset($filterData['knote_per_sq']) && $filterData['knote_per_sq'])
            {
                $products = $products->where('products.knote_per_sq', $filterData['knote_per_sq']);
            }

            if(isset($filterData['foundation']) && $filterData['foundation'])
            {
                $products = $products->where('products.foundation', $filterData['foundation']);
            }

            if(isset($filterData['border_color']) && $filterData['border_color'])
            {
                $products = $products->where('products.border_color_id', $filterData['border_color']);
            }
        }

        $products           = $products->where('products.status', 1);

        $categoryParam      = clone $products; 
        $collectionParam    = clone $products;
        $styleParam         = clone $products;
        $materialParam      = clone $products;
        $weaveParam         = clone $products;
        $colorParam         = clone $products;

        if(isset($filterData['perpage']) && $filterData['perpage'])
        {
            $perPage = $filterData['perpage'];
        }

        $products   = $products->select('products.*')->paginate($perPage);

        $categoryList = $categoryParam->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();

        $collectionList = $collectionParam->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();

        $styleList = $styleParam->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->orderBy('styles.name')->get();

        $materialList = $materialParam->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->orderBy('materials.name', 'ASC')->get();

        $weaveList = $weaveParam->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->orderBy('weaves.name', 'ASC')->get();

        $colorList = $colorParam
                    ->join('product_colors as color_list_table', 'color_list_table.product_id', '=', 'products.id')
                    ->join('colors', 'colors.id', '=', 'color_list_table.color_id')->select('colors.*')->groupBy('colors.id')->orderBy('colors.name', 'ASC')->get();       

        $filterDisplay = [];

        $labelType= [
            'type'          => 'Product',
            'category'      => 'Category',
            'collection'    => 'Collection',
            'style'         => 'Style',
            'material'      => 'Material',
            'weave'         => 'Weave',
            'shape'         => 'Shape',
            'country'       => 'Country of Origin',
            'knote_per_sq'  => 'Knots per Sq',
            'foundation'    => 'Foundation',
            'sku'           => 'Item Number'
        ];

        foreach ($filterData as $singleKey => $singleValue)
        {
            if(in_array($singleKey,array_keys($labelType)) && $singleValue)
            {
                $filterDisplay[$labelType[$singleKey]] = $labelType[$singleKey] . ' : ' . ucfirst($singleValue);
            }

            if($singleKey == 'type' && $singleValue)
            {
                $filterDisplay['Product'] = 'Product : '. ucfirst($singleValue);
            }

            if($categoryName)
            {
                $filterDisplay['Category'] = 'Category : '. ucfirst($categoryName);
            }

            if($singleKey == 'collection' && $singleValue)
            {
                $filterDisplay['Collection'] = 'Collection : '. ucfirst($this->subcategories->find($singleValue)->subcategory);
            }

            if($singleKey == 'style' && $singleValue)
            {
                $filterDisplay['Style'] = 'Style : '. ucfirst($this->style->find($singleValue)->name);
            }

            if($singleKey == 'material' && $singleValue)
            {
                $filterDisplay['Material'] = 'Material : '. ucfirst($this->material->find($singleValue)->name);
            }

            if($singleKey == 'weave' && $singleValue)
            {
                $filterDisplay['Weave'] = 'Weave : '. ucfirst($this->weave->find($singleValue)->name);
            }

            if($singleKey == 'shape' && $singleValue)
            {
                $filterDisplay['Weave'] = 'shape : '. ucfirst($singleValue);
            }

            if($singleKey == 'color' && $singleValue)
            {
                $filterDisplay['Color'] = $this->color->find($singleValue)->name;
            }

            if($singleKey == 'border_color' && $singleValue)
            {
                $filterDisplay['Border Color'] = $this->color->find($singleValue)->name;
            }
        }

        $sizeDisplay = [];

        if(isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
        {
            $sizeDisplay[] = 'Width : '.$filterData['width_min']. ' - '. $filterData['width_max'].' '. ucfirst($filterData['unit_width']);
        }

        if(isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
        {
            $sizeDisplay[] = 'Length : '.$filterData['length_min']. ' - '. $filterData['length_max'].' '. ucfirst($filterData['unit_length']);
        }

        if(!empty($sizeDisplay))
        {
            $filterDisplay['Size'] = 'Size : '. implode(' , ', $sizeDisplay);
        }

        return view('frontend.products.index')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList,
            'filterData'        => $filterData,
            'categoryId'        => isset($categoryId) ? $categoryId : '',
            'filterDisplay'     => $filterDisplay
        ]);
    }

    /**
     * Product Show
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($productId)
    {
        $product = $this->products->find($productId);

        $newArrivals = $this->products->query()->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();

        $productLike = $this->products->query()
                        ->where('category_id', '=', $product->category_id)
                        ->orWhere('shape', '=', $product->shape)
                        ->orWhere('color_id', '=', $product->color_id)
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();

        $favourite = 0;

        if(Auth::check())
        {
            $check = $this->userFavourite->where([
                'user_id'       => Auth::user()->id,
                'product_id'    => $productId
            ])->first();

            if($check)
            {
                $favourite = 1;
            }           

        }

        $reviews = $this->productReview->where('product_id', $productId)->join('users', 'users.id', '=', 'reviews.user_id')->select(['reviews.*', 'users.first_name', 'users.last_name'])->get();

        $averageStarQuery = $this->productReview->where('product_id', $productId)->select(DB::raw("SUM(star) as sumStar, COUNT(id) as countStar"))->first();
        $averageStar = 0;

        if($averageStarQuery->sumStar)
        {
            $averageStar = round($averageStarQuery->sumStar / $averageStarQuery->countStar);
        }
        
        return view('frontend.products.show')->with([
            'product'       => $product,
            'newArrivals'   => $newArrivals,
            'favourite'     => $favourite,
            'reviews'       => isset($reviews) ? $reviews : [],
            'averageStar'   => $averageStar,
            'productLike'   => $productLike
            ]);
    }

    /**
     * New Arrival
     *
     * @param Request $request
     * @return $this
     */
    public function newArrival(Request $request)
    {
        $filterData = $request->all();

        $categoryList   = $this->categories->getAll();
        $collectionList = $this->subcategories->getAll();
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

        $products = $this->products->query();

        if(!empty($filterData))
        {
            if(isset($filterData['category']) && $filterData['category'])
            {
                $products = $products->where('category_id', $filterData['category']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('material_id', $filterData['style']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->where('color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('shape', $filterData['shape']);
            }

            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);
            }

            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);
            }
        }

        $products = $products->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->where('status', 1)->paginate(config('constant.perPage'));

        return view('frontend.products.new-arrival')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);
    }

    /**
     * Add Favourites
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavourites(Request $request)
    {
        $postData = $request->all();

        if(isset($postData['product_id']) && $postData['product_id'])
        {
            $userCheck = Auth::check();
            if($userCheck == false)
            {
                return response()->json([
                    'error' => true,
                    'redirect' => true,
                    'message' => 'Login first to add to favourite.'
                ]);
            }

            $check = $this->userFavourite->where([
                'user_id'       => Auth::user()->id,
                'product_id'    => $postData['product_id']
            ])->first();

            if($postData['favourite'] == 0)
            {
                if(!empty($check))
                {
                    $this->userFavourite->where('id', $check->id)->delete();

                    return response()->json([
                        'success' => true,
                        'message' => 'Removed from Favourite List.'
                    ]);
                }
                else
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'Add to Favourite List First.'
                    ]);
                }
            }
            else
            {
                if(!empty($check))
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'Already Exist in Favourite List.'
                    ]);
                }
                else
                {
                    $this->createActivityLog(Auth::user()->id, $postData['product_id'], 'add_wishlist');

                    $this->userFavourite->create([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $postData['product_id']
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Successfully Added in Favourite List'
                    ]);
                }
            }
        }
        else
        {
            return response()->json([
               'error' => true,
               'message' => 'Error in Data'
            ]);
        }
    }

    public function favourites(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('frontend.index')->withFlashWarning("Login first to add products in favourite.");
        }

        $user = AUth::user();

        $categoryList   = $this->categories->getAll();
        $collectionList = $this->subcategories->getAll();
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

        $products = $this->products->query();

        if(!empty($filterData))
        {
            if(isset($filterData['category']) && $filterData['category'])
            {
                $products = $products->where('category_id', $filterData['category']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('material_id', $filterData['style']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->where('color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('shape', $filterData['shape']);
            }

            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);
            }

            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);
            }
        }

        $products = $products->join('user_favourites', 'user_favourites.product_id', '=', 'products.id')->where('user_favourites.user_id', $user->id)->where('status', 1)->paginate(config('constant.perPage'));

        return view('frontend.products.favourite')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);

    }

    public function advanceSearch(Request $request)
    {
        $categoryList   = $this->categories->query()->orderBy('category', 'ASC')->get();        
        $collectionList = $this->subcategories->query()->orderBy('subcategory', 'ASC')->get();       
        $styleList      = $this->style->query()->orderBy('name', 'ASC')->get();
        $materialList   = $this->material->query()->orderBy('name', 'ASC')->get();
        $weaveList      = $this->weave->query()->orderBy('name', 'ASC')->get();
        $colorList      = $this->color->query()->orderBy('display_name', 'ASC')->get();

        return view('frontend.products.advance-search')->with([
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function writeReview(Request $request)
    {
        $postData = $request->all();
        $success = true;

        $userCheck = Auth::check();
        if($userCheck == false)
        {
            return response()->json([
                'success'   => false,
                'auth'      => false,
                'message'   => 'Login first to write a review.'
            ]);
        }

        $postData['user_id'] = Auth::user()->id;

        $reviewData = $this->productReview->create($postData);

        if($reviewData)
        {
            return response()->json([
                'success'   => true,
                'auth'      => true,
                'message'   => 'Thank you for writing Review.'
            ]);
        }
        else
        {
            return response()->json([
                'success'   => false,
                'auth'      => true,
                'message'   => 'Error in writing Review.'
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrice(Request $request)
    {
        $postData = $request->all();

        $sizeData = $this->productSize->find($postData['size_id']);
        $price = 0;

        if(Auth::check())
        {
            $user = Auth::user();
            $role = $user->roles->first();

            if($role->name == 'Affiliate')
            {   
                if($sizeData)
                {
                    $price = $sizeData->price_affiliate;
                }
            }
            else
            {
                $price = $sizeData->price;
            }
        }
        else
        {
            if($sizeData)
            {
                $price = $sizeData->price;
            }              
        } 

        $finalPrice = number_format($sizeData->width*$sizeData->length*$price, 2, '.', '');

        return response()->json([
            'price' => $finalPrice
        ]);       
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function addToCart(Request $request) 
    {
        $postData = $request->all();

        $sizeData = $this->productSize->find($postData['size_id']);

        if($sizeData->quantity < 1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Product is Out of Stock.'
            ]);
        }
        
        $productData = $this->products->find($postData['product_id']);
        if(empty($sizeData) || empty($productData))
        {
            return response()->json([
                'success' => false,
                'message' => 'Product Size not available.'
            ]);
        }

        $length = $sizeData->length+0;
        $width = $sizeData->width+0;
        $explodedLength = explode(".", $length);
        $explodedWidth = explode(".", $width);

        $sizeName = $explodedLength[0]."'".(isset($explodedLength[1]) ? $explodedLength[1]."''" : ""). ' x '. $explodedWidth[0]."'".(isset($explodedWidth[1]) ? $explodedWidth[1]."''" : "");

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

        $cartData = Cart::session($cartId)->getContent();

        $updated = false;

        if(!empty($cartData))
        {
            foreach($cartData as $singleKey => $singleValue)
            {                
                if($singleValue->attributes->size_id == $postData['size_id'] && $singleValue->attributes->product_id == $postData['product_id'])
                {
                    $quantity = $singleValue->quantity+1;

                    Cart::session($cartId)->add($singleKey,$productData->name,$sizeData->price, $quantity,array(
                            'size'      => $sizeName,
                            'size_id'   => $sizeData->id,
                            'product_id' => $productData->id
                    ));
                    $updated = true;
                    break;
                }
            }

            if($updated == true)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Product Quantity Increased.'
                ]);
            }
        }

        $user = Auth::user();
        $role = $user->roles->first();
        if($role->name == 'Affiliate')
        {
            $price = $sizeData->price_affiliate;
        }
        else
        {
            $price = $sizeData->price;
        }


        $finalPrice = number_format($sizeData->width*$sizeData->length*$price, 2, '.', '');

        Cart::session($cartId)->add(rand(0,9999),$productData->name,$finalPrice, 1,array(
                'size'      => $sizeName,
                'size_id'   => $sizeData->id,
                'product_id' => $productData->id
        ));
        
        return response()->json([
            'success' => true,
            'message' => 'Product Added to Cart.'
        ]);
    }

    public function cart(Request $request)
    {
        return view('frontend.products.cart');
    }

    public function getSuggestion(Request $request)
    {
        $data       = $request->all();
        $finalArray = [];

        if(isset($data['term']) && $data['term'])
        {
            $products = $this->products->query()->where('status', 1)->where('name', 'LIKE', $data['term'].'%')->get();

            foreach ($products as $key => $value) 
            {
                $finalArray[$key] = [
                    'id' => $value->id,
                    'label' => $value->name,
                    'value' => $value->name
                ];
            }
        }

        return response()->json($finalArray);
        
    }
}
