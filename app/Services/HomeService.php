<?php

namespace App\Services;

use App\Services\Interfaces\HomeServiceInterface;
use App\Repositories\Interfaces\HomeRepositoryInterface as HomeRepository;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;



class HomeService implements HomeServiceInterface
{
    protected $homeRepository;
    protected $postRepository;

    public function __construct(HomeRepository $homeRepository, PostRepository  $postRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->postRepository =  $postRepository;
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
    public function getPostsBySearch($request) {
        $condition = [
            [
                'post_name','LIKE',$request
            ]
        ];
        $results = $this->postRepository->findByConditions($condition);
        return $results;
    }

}
