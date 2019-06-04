<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{

    use Notifiable, SoftDeletes;

    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;

    /**
     * Status stop.
     *
     * @var int
     */
    const STATUS_STOP = 2;

    /**
     * Ignore accessor
     *
     * @var bool
     */
    public static $ignoreMutator = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'password',
        'name',
        'address',
        'email',
        'avatar',
    ];

    /**
     * Status object
     *
     * @var array
     */
    public static $statusObject = [
        self::STATUS_USING => 'label.customers.using',
        self::STATUS_STOP => 'label.customers.stop',
    ];

    /**
     * Set hash for password.
     *
     * @param string $password Password
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        if (!self::$ignoreMutator && Hash::needsRehash($password)) {
            $password = bcrypt($password);
        }

        $this->attributes['password'] = $password;
    }

    /**
     * Get object status
     *
     * @param int $value Value of status
     *
     * @return array
     */
    public function getStatusAttribute($value)
    {
        $value = $value ?? self::STATUS_USING;
       return [
           'value' => $value,
           'text' => trans(self::$statusObject[$value])
       ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
