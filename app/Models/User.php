<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable, SoftDeletes;
    /**
     * Role super admin
     *
     * @var int
     */
    const ROLE_SUPER_ADMIN = 1;
    /**
     * Role admin of company.
     *
     * @var int
     */
    const ROLE_ADMIN = 2;
    /**
     * Role manager of company.
     *
     * @var int
     */
    const ROLE_MANAGER = 3;
    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;
    /**
     * Role super admin
     *
     * @var int
     */
    const ROLE_SUPER_ADMIN = 1;

    /**
     * Role admin of company.
     *
     * @var int
     */
    const ROLE_ADMIN = 2;

    /**
     * Role manager of company.
     *
     * @var int
     */
    const ROLE_MANAGER = 3;

    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
