<?php

namespace App\Repositories\Eloquents\Customer;

use App\Models\Customer;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;

class CustomerRepository extends AbstractRepository implements CustomerRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }
}
