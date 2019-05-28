<?php
namespace App\Http\Controllers\Apis\AuthCustomer;

use App\Models\Customer;
use App\Resources\CustomerResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class InfoController extends CustomerAuthController
{

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {

            $customerId = $request->get('customer_id');
//        $user = Customer::firstOrFail($customerId);
//        $user = new CustomerResource(Auth::user());
            $user = new CustomerResource(Customer::findOrFail($customerId));
        } catch (ModelNotFoundException $ex) {
            return $this->responseError(trans('message.customer_auth.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer_auth.show_fail'));
        }

        return $this->responseSuccess('', $user);
    }
}
