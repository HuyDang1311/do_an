<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    /**
     * Status using.
     *
     * @var int
     */
    const PAYMENT_STATUS_PAYED = 1;

    /**
     * Status using.
     *
     * @var int
     */
    const PAYMENT_STATUS_NOT_PAYED = 2;

    /**
     * Status using.
     *
     * @var int
     */
    const PROCESS_STATUS_USING = 1;

    /**
     * Status using.
     *
     * @var int
     */
    const PROCESS_STATUS_STOP = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'quantity',
        'total_money',
        'payment_status',
        'process_status',
    ];

    /**
     * OrderDetail belongsTo Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
