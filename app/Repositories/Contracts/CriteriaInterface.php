<?php

namespace App\Repositories\Contracts;

use App\Repository\Contracts\RepositoryInterface;

interface CriteriaInterface
{

    /**
     * Apply criteria in query repository
     *
     * @param mixed               $model      Model
     * @param RepositoryInterface $repository RepositoryInterface
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
