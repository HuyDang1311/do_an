<?php

namespace App\Repositories\Eloquents\Car;

use App\Models\Car;
use App\Models\Company;
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
        $query = $this->search($data);

        return $query->scopeQuery(function ($query) {
                return $query->join('companies', 'companies.id', '=', 'cars.id');
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
     * Show company
     *
     * @param int $id Id of company
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCompany(int $id)
    {
        return $this->find($id, [
            'id',
            'name',
            'address',
            'phone_number',
            'email',
            'status',
            'created_at',
            DB::raw("CASE WHEN status = " . Company::STATUS_USING
                . " THEN '" . trans('label.cars.status_using')
                . "' WHEN status = " . Company::STATUS_STOP
                . " THEN '" . trans('label.cars.status_stop')
                . "' END as status_name"),
        ]);
    }

    /**
     * Update company
     *
     * @param int $id Id of company
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCompany(int $id, array $data)
    {
        return $this->update($data, $id);
    }

    /**
     * Create company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCompany(array $data)
    {
        return $this->create($data);
    }
}
