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
     * Seat number 1.
     *
     * @var int
     */
    const SEAT_NUMBER_1 = 20;

    /**
     * Seat number 2.
     *
     * @var int
     */
    const SEAT_NUMBER_2 = 40;

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
     * Type object.
     *
     * @var array
     */
    public static $seatNumber = [
        self::SEAT_NUMBER_1 => self::SEAT_NUMBER_1,
        self::SEAT_NUMBER_2 => self::SEAT_NUMBER_2
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

    /**
     * Plan belongsTo Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
