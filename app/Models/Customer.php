<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{

    use SoftDeletes;

    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;

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
        'status',
    ];

    /**
     * Status object
     *
     * @var array
     */
    public static $statusObject = [
        self::STATUS_USING => 'label.status.using',
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
}
