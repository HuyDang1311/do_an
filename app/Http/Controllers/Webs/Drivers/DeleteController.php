<?php

namespace App\Http\Controllers\Webs\Drivers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    /**
     * DriverRepositoryInterface
     *
     * @var DriverRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param DriverRepositoryInterface $repository DriverRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        DriverRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Delete company
     *
     * @param Request $request Request
     * @param int     $id      Id of company
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $this->repository->delete($id);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.drivers.delete_fail'));
            return back();
        }

        session()->flash('message_success', trans('message.drivers.delete_success'));
        return redirect('/drivers/index');
    }
}
