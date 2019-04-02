<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{

    use SoftDeletes;

    /**
     * Status using.
     *
     * @var int
     */
    const STATUS_USING = 1;

    /**
     * Type of seat.
     *
     * @var int
     */
    const TYPE_1 = 1;

    /**
     * Type of seat.
     *
     * @var int
     */
    const TYPE_2 = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'status',
        'car_id',
    ];
}
