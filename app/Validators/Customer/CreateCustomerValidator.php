<?php

namespace App\Validators\Customer;

use App\Repositories\Traits\ExtendValidator;
use App\Validators\LaravelValidator;

class CreateCustomerValidator extends LaravelValidator
{
    use ExtendValidator;

    /**
     * Rule validator
     *
     * @var array
     */
    protected $rules = [
        'phone_number' => 'required|phone_number',
        'password' => 'required|min:6:max:255',
        'name' => 'required|max:255',
    ];
}
