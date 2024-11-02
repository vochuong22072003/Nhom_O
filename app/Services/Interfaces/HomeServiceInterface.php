<?php 
namespace App\Services\Interfaces;

interface HomeServiceInterface
{
    public function getLastestNew(int $limit = 4);
    public function getActiveParentCategoriesWithChildren();
    public function getPostsByCategory($id, $model);
    public function getCategoryInfo($id, $model);
    public function getPost($id);
} 


?>