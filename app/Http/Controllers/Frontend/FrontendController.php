<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Repositories\Backend\HomeSlider\HomeSliderRepository;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{

    public function __construct()
    {
        $this->categories       = new CategoriesRepository();
        $this->subcategories    = new SubCategoriesRepository();
        $this->homeSlider       = new HomeSliderRepository();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories     = $this->categories->query()->where('status', 1)->get();
        $collections    = $this->subcategories->query()->where('status', 1)->get();
        $slides         = $this->homeSlider->getAll();
        return view('frontend.index')->with(['categories'=> $categories, 'slides' => $slides, 'collections' => $collections]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
