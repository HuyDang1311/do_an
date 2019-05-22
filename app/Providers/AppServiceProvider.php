<?php

namespace App\Providers;

use App\Repositories\Eloquents\BusStation\BusStationRepository;
use App\Repositories\Eloquents\Customer\CustomerRepository;
use App\Repositories\Eloquents\Order\OrderRepository;
use App\Repositories\Eloquents\Plan\PlanRepository;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use App\Validators\Customer\CreateCustomerValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );
        $this->app->bind(
            BusStationRepositoryInterface::class,
            BusStationRepository::class
        );
        $this->app->bind(
            PlanRepositoryInterface::class,
            PlanRepository::class
        );
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
        $this->app->bind(CreateCustomerValidator::class, function ($app) {
            return new CreateCustomerValidator($app['validator']);
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Validate phone
         */
        app('validator')->extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            $regex = '/^([0-9\(\)\+ .-]{0,20})$/';
            $result = preg_match($regex, $value);
            if ($result === 1 || is_null($value)) {
                return true;
            }
            return false;
        });
    }
}
