<?php

namespace App\Providers;

use App\Repositories\Eloquents\BusStation\BusStationRepository;
use App\Repositories\Eloquents\Car\CarRepository;
use App\Repositories\Eloquents\Company\CompanyRepository;
use App\Repositories\Eloquents\Customer\CustomerRepository;
use App\Repositories\Eloquents\Driver\DriverRepository;
use App\Repositories\Eloquents\Order\OrderRepository;
use App\Repositories\Eloquents\Plan\PlanRepository;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
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
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
        $this->app->bind(
            CarRepositoryInterface::class,
            CarRepository::class
        );
        $this->app->bind(
            DriverRepositoryInterface::class,
            DriverRepository::class
        );
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
