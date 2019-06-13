<?php

namespace App\Http\Controllers\Webs\Users;

use App\Http\Controllers\Controller;
use App\Models\BusStation;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{

    /**
     * Show user info
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $user = Auth::user();
        } catch (Exception $ex) {
            session()->flash('error', trans('message.users.show_fail'));
            return redirect('plans/index');
        }

        return view('web.users.show')->with([
            'data' => $user,
        ]);
    }
}
