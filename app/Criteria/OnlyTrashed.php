<?php

namespace App\Criteria;

use NascentAfrica\EloquentRepository\Contracts\CriteriaInterface;
use NascentAfrica\EloquentRepository\Contracts\RepositoryInterface;

/**
 * Class OnlyTrashed.
 *
 * @package App\Criteria
 * @author Anitche Chisom
 */
class OnlyTrashed implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->onlyTrashed();
    }
}
