<?php
namespace App\Repositories;

use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface;
use App\Models\PostCatalogueParent;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class PostCatalogueParentRepository extends BaseRepository implements PostCatalogueParentRepositoryInterface
{
    protected $model;
    public function __construct(PostCatalogueParent $model){
        $this->model=$model;
    }
    public function pagination(
        array $column=['*'],
        array $condition=[],
        int $perpage=0, 
        array $extend=[],
        array $orderBy=[],
        array $join=[],
        array $relations=[],
        array $rawQuery = []
    ) {
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where(function ($query) use ($condition) {
                    $query->where('post_catalogue_parent_name', 'LIKE', '%' . $condition['keyword'] . '%')
                        ->orWhere('post_catalogue_parent_description', 'LIKE', '%' . $condition['keyword'] . '%');
                });
            }
        });
        if (isset($condition['publish'])) {
            $query->where('publish', '=', $condition['publish']);
        }
        if(isset($relations) && !empty($relations)) {
            foreach($relations as $relation) {
                $query->withCount($relation);
            }
        }
        if(isset($join)&&is_array($join)&&count($join)){
            foreach($join as $key =>$val){
                $query->join($val[0],$val[1],$val[2],$val[3]);
            }
        }
        if(isset($orderBy)&&!empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }    

}
