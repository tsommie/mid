<?php

namespace App\Repositories;


use NascentAfrica\EloquentRepository\BaseRepository;
use App\Client;
use App\Contracts\Repositories\ClientRepositoryInterface;

/**
 * Class ClientRepository.
 *
 * @package App\Repositories
 */
class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];
    
    /**
     * Specify Model class name
     *
     * @return string|\App\Client
     */
    public function model(): string
    {
        return Client::class;
    }
}
