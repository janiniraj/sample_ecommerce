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
        $this->products         = new ProductRepository();
        $this->categories       = new CategoriesRepository();
        $this->subcategories    = new SubCategoriesRepository();
        $this->style            = new StyleRepository();
        $this->material         = new MaterialRepository();
        $this->weave            = new WeaveRepository();
        $this->color            = new ColorRepository();
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
                $products = $products->where('products.material_id', $filterData['style']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('products.weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->where('products.color_id', $filterData['color']);
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

        $queryParam = $products;

        $products   = $products->paginate(config('constant.perPage'));

        $categoryList = $queryParam->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();

        $collectionList = $queryParam->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();

        $styleList = $queryParam->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();

        $materialList = $queryParam->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();

        $weaveList = $queryParam->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();

        $colorList = $queryParam->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();       

        $filterDisplay = [];

        $labelType= [
            'type'          => 'Product',
            'category'      => 'Category',
            'collection'    => 'Collection',
            'style'         => 'Style',
            'material'      => 'Material',
            'weave'         => 'Weave',
            'shape'         => 'Shape'
        ];

        foreach ($filterData as $singleKey => $singleValue)
        {
            if(in_array($singleKey,array_keys($labelType)) && $singleValue)
            {
                $filterDisplay[$labelType[$singleKey]] = $labelType[$singleKey] . ' : ' . ucfirst($singleValue);
            }

            if($categoryName)
            {
                $filterDisplay['Category'] = 'Category : '. $categoryName;
            }

            if($singleKey == 'color' && $singleValue)
            {
                $filterDisplay['Color'] = $this->color->find($singleValue)->name;
            }
        }

        $sizeDisplay = [];

        if(isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
        {
            $sizeDisplay[] = 'Width : '.$filterData['width_min']. ' - '. $filterData['width_max'].' '. ucfirst($filterData['unit_width']);
        }

        if(isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
        {
            $sizeDisplay[] = 'Width : '.$filterData['length_min']. ' - '. $filterData['length_max'].' '. ucfirst($filterData['unit_length']);
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

        $newArrivals = $this->products->query()->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->limit(10)->get();

        return view('frontend.products.show')->with([
            'product' => $product,
            'newArrivals'   => $newArrivals
            ]);
    }

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

        $products = $products->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->paginate(config('constant.perPage'));

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

}
