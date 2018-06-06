<?php

namespace App\Http\Controllers\Backend\Mailinglist;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Mailinglist\MailinglistRepository;
use App\Http\Requests\Backend\Mailinglist\ManageRequest;
use Carbon\Carbon;

/**
 * Class MailinglistTableController.
 */
class MailinglistTableController extends Controller
{
    /**
     * @var MailinglistRepository
     */
    protected $mailinglists;

    /**
     * @param MailinglistRepository $cmspages
     */
    public function __construct(MailinglistRepository $mailinglists)
    {
        $this->mailinglists = $mailinglists;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->mailinglists->getForDataTable())
            ->escapeColumns(['firstname','lastname','email','pobox'])
            ->addColumn('created_at', function ($mailinglists) {
                return Carbon::parse($mailinglists->created_at)->toDateString();
            })
            ->addColumn('actions', function ($mailinglists) {
                return $mailinglists->action_buttons;
            })
            ->make(true);
    }
}
