<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{

    use SoftDeletes;

    /**
     * Type lay.
     *
     * @var int
     */
    const TYPE_LAY = 1;

    /**
     * Type seat
     *
     * @var int
     */
    const TYPE_SEAT = 2;

    /**
     * Type object.
     *
     * @var array
     */
    public static $type = [
        self::TYPE_LAY => 'label.car.type_lay',
        self::TYPE_SEAT => 'label.car.type_seat'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_number_plates',
        'car_manufacturer',
        'seat_quantity',
        'company_id',
        'type'
    ];
}
