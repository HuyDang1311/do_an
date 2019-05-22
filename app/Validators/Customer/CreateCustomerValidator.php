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
        'phone_number' => 'required|phone_number|unique:customers',
        'password' => 'required|min:6:max:255|unique:customers',
        'name' => 'required|max:255',
        'address' => 'nullable|max:255',
        'email' => 'nullable|email|max:255',
        'avatar' => 'nullable|max:255',
    ];
}
