<?php

namespace App\Repositories;

use App\Repositories\Interfaces\HomeRepositoryInterface;
use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParent;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildren;


/**
 * Class UserService
 * @package App\Services
 */
class HomeRepository extends BaseRepository implements HomeRepositoryInterface
{
    protected $postModel;
    protected $postCatalogueParent;
    protected $postCatalogueChildren;

    public function __construct(Post $postModel, PostCatalogueParent $postCatalogueParent, PostCatalogueChildren $postCatalogueChildren)
    {
        $this->postModel = $postModel;
        $this->postCatalogueParent = $postCatalogueParent;
        $this->postCatalogueChildren = $postCatalogueChildren;
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
        // Lấy bài viết từ danh mục cha
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

        // if ($parentCategory) {
        //     // Nếu danh mục cha tồn tại, lấy tất cả bài viết từ danh mục con
        //     return $parentCategory->post_catalogue_children->flatMap(function ($childCategory) {
        //         return $childCategory->posts;
        //     });
        // }

        // Lấy bài viết từ danh mục con nếu không có danh mục cha
        // $childCategory = $this->postCatalogueChildren->findById($id, ['*'], ['posts']);

        // if ($childCategory) {
        //     return $childCategory->posts;
        // }

        // Nếu không tìm thấy bài viết nào, trả về collection rỗng
        // return collect();
    }
    public function getCategoryInfo($id, $model)
    {
        // Kiểm tra trong cả hai bảng một lần
        $category = ($model == 'parent') ? $this->postCatalogueParent->findById($id) : $this->postCatalogueChildren->findById($id);
        // $category = $this->postCatalogueParent->findById($id) ?? 
        //             $this->postCatalogueChildren->findById($id);

        // Nếu tìm thấy danh mục, xác định loại và trả về tên tương ứng
        return ($model == 'parent') ? $category->post_catalogue_parent_name :  $category->post_catalogue_children_name;
        // return $category->post_catalogue_parent_name ?? 
        //        $category->post_catalogue_children_name;


        // Trả về null nếu không tìm thấy danh mục nào
        return null;
    }
}
