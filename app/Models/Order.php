<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Status registered.
     *
     * @var int
     */
    const STATUS_REGISTERED = 1;

    /**
     * Status paying.
     *
     * @var int
     */
    const STATUS_PAYING = 2;

    /**
     * Status done.
     *
     * @var int
     */
    const STATUS_DONE = 3;

    /**
     * Status cancel.
     *
     * @var int
     */
    const STATUS_CANCEL = 4;

    /**
     * Payment method direct money
     *
     * @var int
     */
    const PAYMENT_METHOD_DIRECT_MONEY = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Payment method object
     *
     * @var array
     */
    public static $paymentMethodObject = [
        self::PAYMENT_METHOD_DIRECT_MONEY => 'label.payment_method.direct_money',
    ];

    /**
     * Status object
     *
     * @var array
     */
    public static $statusObject = [
        self::STATUS_REGISTERED => 'label.order_status.registered',
        self::STATUS_PAYING => 'label.order_status.paying',
        self::STATUS_DONE => 'label.order_status.done',
        self::STATUS_CANCEL => 'label.order_status.cancel',
    ];

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
     * Order hasOne OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class, 'order_id', 'id');
    }

    /**
     * Order belongsTo Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
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
