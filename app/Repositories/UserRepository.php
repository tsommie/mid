<?php

namespace App\Repositories;


use NascentAfrica\EloquentRepository\BaseRepository;
use App\User;
use App\Contracts\Repositories\UserRepositoryInterface;

/**
 * Class UserRepository.
 *
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];
    
    /**
     * Specify Model class name
     *
     * @return string|\App\User
     */
    public function model(): string
    {
        return User::class;
    }
}
