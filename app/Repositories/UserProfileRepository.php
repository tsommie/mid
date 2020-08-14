<?php

namespace App\Repositories;


use NascentAfrica\EloquentRepository\BaseRepository;
use App\UserProfile;
use App\Contracts\Repositories\UserProfileRepositoryInterface;

/**
 * Class UserProfileRepository.
 *
 * @package App\Repositories
 */
class UserProfileRepository extends BaseRepository implements UserProfileRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];
    
    /**
     * Specify Model class name
     *
     * @return string|\App\UserProfile
     */
    public function model(): string
    {
        return UserProfile::class;
    }
}
