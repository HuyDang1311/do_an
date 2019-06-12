<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{

    use SoftDeletes;

    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;

    /**
     * Status done.
     *
     * @var int
     */
    const STATUS_DONE = 2;

    /**
     * Status cancel.
     *
     * @var int
     */
    const STATUS_CANCEL = 3;

    /**
     * Type history plan
     *
     * @var int
     */
    const TYPE_HISTORY_PLAN = 1;

    /**
     * Type now day plan
     *
     * @var int
     */
    const TYPE_NOW_DAY_PLAN = 2;

    /**
     * Type future plan
     *
     * @var int
     */
    const TYPE_FUTURE_PLAN = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';

    /**
     * Status object
     *
     * @var array
     */
    public static $status = [
        self::STATUS_USING => 'label.plan.status.using',
        self::STATUS_DONE => 'label.plan.status.done',
        self::STATUS_CANCEL => 'label.plan.status.cancel',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_start_id',
        'address_end_id',
        'time_start',
        'time_end',
        'car_id',
        'company_id',
        'user_driver_id',
        'price_ticket',
        'status',
    ];

    /**
     * Plan belongsTo BusStation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressStart()
    {
        return $this->belongsTo(BusStation::class, 'address_start_id', 'id');
    }

    /**
     * Plan belongsTo BusStation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressEnd()
    {
        return $this->belongsTo(BusStation::class, 'address_end_id', 'id');
    }

    /**
     * Plan belongsTo Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Plan belongsTo Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    /**
     * Plan belongsTo User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'user_driver_id', 'id');
    }

    /**
     * Plan hasMany Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->hasMany(Order::class, 'plan_id', 'id');
    }
}
