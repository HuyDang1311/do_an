<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    use SoftDeletes;

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
     * Status object
     *
     * @var array
     */
    public static $statusObject = [
        self::STATUS_USING => 'label.companies.status_using',
        self::STATUS_STOP => 'label.companies.status_stop',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'status',
    ];
}
