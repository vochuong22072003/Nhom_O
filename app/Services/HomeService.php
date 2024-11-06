<?php

namespace App\Services;

use App\Services\Interfaces\HomeServiceInterface;
use App\Repositories\Interfaces\HomeRepositoryInterface as HomeRepository;



class HomeService implements HomeServiceInterface
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function getLastestNew(int $limit = 4, array $relations = [], array $conditions = [], array $orderBy = ['created_at', 'desc'])
    {
        return $this->homeRepository->getLastestNew($limit, $relations, $conditions, $orderBy);
    }
    
    public function getActiveParentCategoriesWithChildren() {
        return $this->homeRepository->getActiveParentCategoriesWithChildren();
    }
    public function getPostsByCategory($id, $model) {
        return $this->homeRepository->getPostsByCategory($id, $model);
    }
    public function getCategoryInfo($id, $model) {
        return $this->homeRepository->getCategoryInfo($id, $model);
    }
    public function getPost($id) {
        return $this->homeRepository->getPost($id);
    }

}