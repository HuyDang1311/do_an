<?php
namespace App\Http\Controllers\Apis\AuthCustomer;

use App\Http\Controllers\ApiController;
use App\Models\Customer;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class CustomerAuthController extends ApiController
{

    /**
     * Constructor.
     *
     * @return void
     */
    function __construct()
    {
        Config::set('jwt.user', Customer::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]]);
    }

    /**
     * Handle the incoming request.
     *
     * @param array $columns Columns
     *
     * @return Auth
     *
     * @throws AuthenticationException
     */
    public function getAuthUser(array $columns = ['*'])
    {
        if (!Auth::user()) {
            throw new AuthenticationException(trans('auth.auth_fail'));
        }

        return Auth::user()->setVisible($columns);
    }
}
