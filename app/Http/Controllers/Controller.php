<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Activity\Activity;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $userId
     * @param null $productId
     * @param $activity
     * @return bool
     */
    public function createActivityLog($userId = null, $productId = null, $activity)
    {
        $this->activity = new Activity;

        $this->activity->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'activity' => $activity
        ]);

        return true;
    }
}
