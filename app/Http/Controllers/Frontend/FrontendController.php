<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Categories\CategoriesRepository;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{

    public function __construct()
    {
        $this->categories = new CategoriesRepository();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categories->query()->where('status', 1)->get();
        return view('frontend.index')->with(['categories'=> $categories]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
