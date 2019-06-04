<?php

namespace App\Repositories\Eloquents\Car;

use App\Models\Car;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use DB;

class CarRepository extends AbstractRepository implements CarRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Car::class;
    }

    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'car_number_plates' => ['column' => 'cars.car_number_plates', 'operator' => 'ilike', 'type' => 'normal'],
        'car_manufacturer' => ['column' => 'cars.car_manufacturer', 'operator' => 'ilike', 'type' => 'normal'],
        'company_id' => ['column' => 'cars.company_id', 'operator' => '=', 'type' => 'normal'],
        'type' => ['column' => 'cars.type', 'operator' => '=', 'type' => 'normal'],
    ];

    /**
     * List company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCar(array $data)
    {
        $with['company'] = function ($query) {
            return $query->select([
                'companies.id',
                'companies.name',
            ]);
        };

        $query = $this->with($with)->search($data);

        return $query->scopeQuery(function ($query) {
                return $query->join('companies', 'companies.id', '=', 'cars.company_id');
            })
            ->orderBy('car_number_plates', 'asc')->all([
            'cars.id',
            'cars.car_number_plates',
            'cars.car_manufacturer',
            'cars.company_id',
            'cars.type',
            'cars.seat_quantity',
            'cars.created_at',
            'companies.name as company_name',
            DB::raw("CASE WHEN cars.type = " . Car::TYPE_LAY
                . " THEN '" . trans('label.car.type_lay')
                . "' WHEN cars.type = " . Car::TYPE_SEAT
                . " THEN '" . trans('label.car.type_seat')
                . "' END as type_name"),
            DB::raw("ROW_NUMBER () OVER (ORDER BY cars.car_number_plates) as row_number")
        ]);
    }

    /**
     * Show car
     *
     * @param int $id Id of car
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCar(int $id)
    {
        $with['company'] = function ($query) {
            return $query->select([
                'companies.id',
                'companies.name',
            ]);
        };

        return $this->with($with)->find($id, [
            'cars.id',
            'cars.car_number_plates',
            'cars.car_manufacturer',
            'cars.company_id',
            'cars.type',
            'cars.seat_quantity',
            'cars.created_at',
            DB::raw("CASE WHEN cars.type = " . Car::TYPE_LAY
                . " THEN '" . trans('label.car.type_lay')
                . "' WHEN cars.type = " . Car::TYPE_SEAT
                . " THEN '" . trans('label.car.type_seat')
                . "' END as type_name"),
        ]);
    }

    /**
     * Update car
     *
     * @param int $id Id of car
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCar(int $id, array $data)
    {
        return $this->update($data, $id);
    }

    /**
     * Create car
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCar(array $data)
    {
        return $this->create($data);
    }
}
