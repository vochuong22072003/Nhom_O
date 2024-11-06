<?php 
namespace App\Services\Interfaces;

interface HomeServiceInterface
{
    public function getLastestNew(int $limit = 4, array $relations = [], array $conditions = [], array $orderBy = ['created_at', 'desc']);
    public function getActiveParentCategoriesWithChildren();
    public function getPostsByCategory($id, $model);
    public function getCategoryInfo($id, $model);
    public function getPost($id);
} 


?>