<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Models\Setting\Setting;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Setting\SettingRepository;
use App\Http\Requests\Backend\Setting\StoreRequest;
use App\Http\Requests\Backend\Setting\ManageRequest;

/**
 * Class SettingController.
 */
class SettingController extends Controller
{
    /**
     * @var SettingRepository
     */
    protected $Settings;

    /**
     * @param SettingRepository $Settings
     */
    public function __construct(SettingRepository $Settings)
    {
        $this->Settings = $Settings;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.settings.index');
    }

    public function saveData(StoreRequest $request)
    {
        
    }

    /**
     * @param Setting              $Setting
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Setting $Setting, DeleteRequest $request)
    {
        //$Setting = $this->Settings->find($id);

        $this->Settings->delete($Setting);

        return redirect()->route('admin.settings.index')->withFlashSuccess(trans('alerts.backend.Settings.deleted'));
    }
}
