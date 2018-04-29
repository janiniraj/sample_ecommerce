<?php

namespace App\Http\Controllers\Backend\HomeSlider;

use App\Models\HomeSlider\HomeSlider;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\HomeSlider\StoreRequest;
use App\Http\Requests\Backend\HomeSlider\ManageRequest;

/**
 * Class HomeSliderController.
 */
class HomeSliderController extends Controller
{
    /**
     * @param HomeSlider $homeSlider
     */
    public function __construct(HomeSlider $homeSlider)
    {
        $this->homeSlider = $homeSlider;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        $slides = $this->homeSlider->all();

        return view('backend.homeslider.index')->with('slides', $slides);
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->homeSlider->create($request->all());

        return redirect()->route('admin.homeslider.index')->withFlashSuccess(trans('alerts.backend.categories.created'));
    }
}
