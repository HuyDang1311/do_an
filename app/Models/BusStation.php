<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BusStation extends Model
{

    use SoftDeletes;

    /**
     * Type city.
     *
     * @var int
     */
    const TYPE_CITY = 1;

    /**
     * Type bus station.
     *
     * @var int
     */
    const TYPE_BUS_STATION = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city',
        'name_station',
        'latitude',
        'longitude',
    ];

    /**
     * BusStation hasMany BusStation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childBusStation()
    {
        return $this->hasMany(BusStation::class, 'parent_id' , 'id');
    }

    /**
     * BusStation belongTo BusStation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentBusStation()
    {
        return $this->belongsTo(BusStation::class, 'parent_id' , 'id');
    }
}
