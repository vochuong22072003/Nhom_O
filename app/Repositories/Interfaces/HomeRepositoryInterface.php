<?php
namespace App\Repositories\Interfaces;

interface HomeRepositoryInterface {
    public function getLastestNew(int $limit = 4, array $relations = []);
    public function getActiveParentCategoriesWithChildren();
    public function getPostsByCategory($id, $model);
    public function getCategoryInfo($id, $model);
    public function getPost($id);
}




?>