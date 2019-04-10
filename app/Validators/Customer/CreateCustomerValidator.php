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
        'company_code' => "required|type_code|max:20|exists_lower:companies,code",
        'employee_name' => 'required|max:255',
        'employee_code' => "required|type_code|exists:employees,code,deleted_at,NULL|max:20",
        'employee_phone' => "required|phone_number|max:20",
    ];
}
