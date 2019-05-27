<?php

namespace App\Http\Controllers\Apis\Orders;

use App\Http\Controllers\ApiController;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Exception;

class ListPaymentMethodOrderController extends ApiController
{

    /**
     * List payment method
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        try {
            $paymentMethods = transArr(Order::$paymentMethodObject);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.order.show_fail'));
        }

        return $this->responseSuccess('', $paymentMethods);
    }
}
