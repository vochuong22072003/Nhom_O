<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use App\Repositories\BaseRepository;

/**
 * Class CommentCatalogueService
 * @package App\Services
 */
class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    protected $model;
    public function __construct(Comment $model){
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
                    $query->where('content', 'LIKE', '%' . $condition['keyword'] . '%');
                       
                });
            }
            if (isset($condition['post_id'])) {
                $query->where('tb2.id', '=', $condition['post_id']);
            }
           
            if (isset($condition['customer_id'])) {
                $query->where('tb3.cus_id', '=', $condition['customer_id']);
            }
            return $query;
        });

        if(isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])){
            foreach($rawQuery['whereRaw'] as $key => $val){
                $query->whereRaw($val[0], $val[1]);
            }
        }

        if(isset($relations) && !empty($relations)) {
            foreach($relations as $relation) {
                $query->withCount($relation);
            }
        }
        if (isset($join) && is_array($join) && count($join)) {
            foreach ($join as $key => $val) {
                if (isset($val[4]) && $val[4] == 'left') {
                    $query->leftJoin($val[0], $val[1], $val[2], $val[3]);
                } else {
                    $query->join($val[0], $val[1], $val[2], $val[3]);
                }
            }
        }
        if(isset($extend['groupBy']) && !empty($extend['groupBy'])){
            $query->groupBy($extend['groupBy']);
        }
        if(isset($orderBy)&&!empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        // echo $query->toSql(); die();
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }    
}