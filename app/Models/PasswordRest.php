<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordRest extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_reset';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
    ];
}
