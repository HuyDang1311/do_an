<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CarRepositoryInterface $repository CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $repository
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
            return back()->withErrors(['error' => trans('message.cars.delete_fail')]);
        }

        return redirect('/cars/index');
    }
}
