<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

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
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'customer_id',
        'order_code',
        'payment_method_id',
        'coupon_id',
        'status',
        'seat_ids',
    ];

    /**
     * Order hasMany OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    /**
     * Order belongsTo Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
