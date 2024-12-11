<?php
namespace App\Repositories;

use App\Repositories\Interfaces\PersonalAccessTokenRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\PersonalAccessToken;

/**
 * Class PersonalAccessTokenService
 * @package App\Services
 */
class PersonalAccessTokenRepository extends BaseRepository implements PersonalAccessTokenRepositoryInterface
{
    protected $model;
    public function __construct(PersonalAccessToken $model){
        $this->model=$model;
    }
}
