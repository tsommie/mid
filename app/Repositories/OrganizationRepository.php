<?php

namespace App\Repositories;


use NascentAfrica\EloquentRepository\BaseRepository;
use App\Organization;
use App\Contracts\Repositories\OrganizationRepositoryInterface;

/**
 * Class OrganizationRepository.
 *
 * @package App\Repositories
 */
class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];
    
    /**
     * Specify Model class name
     *
     * @return string|\App\Organization
     */
    public function model(): string
    {
        return Organization::class;
    }
}
