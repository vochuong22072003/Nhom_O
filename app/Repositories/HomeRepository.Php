<?php

namespace App\Repositories;

use App\Repositories\Interfaces\HomeRepositoryInterface;
use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParent;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildren;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;



/**
 * Class UserService
 * @package App\Services
 */
class HomeRepository extends BaseRepository implements HomeRepositoryInterface
{
    protected $postModel;
    protected $postCatalogueParent;
    protected $postCatalogueChildren;
    protected $postRepository;

    public function __construct(Post $postModel, PostCatalogueParent $postCatalogueParent, PostCatalogueChildren $postCatalogueChildren, PostRepository $postRepository)
    {
        $this->postModel = $postModel;
        $this->postCatalogueParent = $postCatalogueParent;
        $this->postCatalogueChildren = $postCatalogueChildren;
        $this->postRepository = $postRepository;
    }
    public function getLastestNew(int $limit = 4, array $relations = [])
    {
        return $this->postModel->with(array_merge($relations, ['userInfo']))
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
    public function getActiveParentCategoriesWithChildren()
    {
        $condition = [
            ['publish', '=', 2]
        ];

        $relation = [
            'post_catalogue_children' => function ($query) {
                $query->where('publish', 2);
            }
        ];

        $orderBy = ['id', 'asc'];

        return $this->postCatalogueParent->findByConditionsWithRelation($condition, $relation, $orderBy);
    }

    public function getPostsByCategory($id,$model)
    {
        $modelService = 'postCatalogue'.ucfirst($model);
        $condition = [
            ['id', '=', $id]
        ];
        $relation = [
            'posts' => function ($query) {
                $query->where('publish', 2);
            }
        ];
        $posts = $this->$modelService->findByConditionsWithRelation($condition, $relation);
        // dd($posts);
        return $posts;
    }
    public function getCategoryInfo($id, $model)
    {
        // Kiểm tra trong cả hai bảng một lần
        $category = ($model == 'parent') ? $this->postCatalogueParent->findById($id) : $this->postCatalogueChildren->findById($id);

        // Nếu tìm thấy danh mục, xác định loại và trả về tên tương ứng
        return ($model == 'parent') ? $category->post_catalogue_parent_name :  $category->post_catalogue_children_name;
        // Trả về null nếu không tìm thấy danh mục nào
        return null;
    }
    public function getPost($id) {
        $relation = [
            'postCatalogueParent','postCatalogueParent' 
        ];
        $getPost = $this->postRepository->findById($id,['*'],$relation);
        // dd($getPost);
        return $getPost;
    }
}
