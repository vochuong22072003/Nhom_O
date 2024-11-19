<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Models\Base;
use illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        int $perpage = 0,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = []
    ) {
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%' . $condition['keyword'] . '%');
            }
        });
        if (isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])) {
            foreach ($rawQuery['whereRaw'] as $key => $val) {
                $query->whereRaw($val[0], $val[1]);
            }
        }
        if (isset($relations) && !empty($relations)) {
            foreach ($relations as $relation) {
                $query->withCount($relation);
            }
        }
        if (isset($join) && is_array($join) && count($join)) {
            foreach ($join as $key => $val) {
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }
        if (isset($extend['groupBy']) && !empty($extend['groupBy'])) {
            $query->groupBy($extend['groupBy']);
        }
        if (isset($orderBy) && !empty($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }
    public function findById(int $id, array $column = ['*'], array $relation = [])
    {
        return $this->model->select($column)->with($relation)->findOrFail($id);
    }
    public function findWhereIn(string $column = '', array $ids = [])
    {
        return $this->model->whereIn($column, $ids)->get();
    }
    public function findByCondition(array $condition = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->first();
    }
    public function findByConditions(array $condition = [])
    {
        $query = $this->model->newQuery();

        foreach ($condition as $key => $val) {
            // Nếu điều kiện là LIKE, tự động thêm `%` nếu chưa có
            if (strtoupper($val[1]) === 'LIKE') {
                $val[2] = '%' . $val[2] . '%';
            }

            $query->where($val[0], $val[1], $val[2]);
        }

        return $query->get();
    }

    // public function findByCondition(array $condition = [], array $relations = [])
    // {
    //     $query = $this->model->newQuery();

    //     // Thêm điều kiện cho mối quan hệ
    //     foreach ($relations as $relation => $closure) {
    //         $query->whereHas($relation, $closure);
    //     }

    //     // Thêm điều kiện tìm kiếm
    //     foreach ($condition as $val) {
    //         $query->where($val[0], $val[1], $val[2]);
    //     }

    //     return $query->first();
    // }

    public function findByConditionsWithRelation(array $condition = [], array $relation = [], array $orderBy = ['id', 'desc'])
    {
        $query = $this->model->newQuery();

        foreach ($condition as $val) {
            $query->where($val[0], $val[1], $val[2]);
        }

        foreach ($relation as $rel => $closure) {
            if (is_callable($closure)) {
                $query->with([$rel => $closure]);
            } else {
                $query->with($rel);
            }
        }

        $query->orderBy($orderBy[0], $orderBy[1]);

        return $query->get();
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    public function updateByWhere(array $condition = [], array $payload = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            if (is_array($val[2])) {
                $query->whereIn($val[0], $val[2]);
            } else {
                $query->where($val[0], $val[1], $val[2]);
            }
        }
        return $query->update($payload);
    }
    public function delete(int $id = 0)
    {
        return $this->findById($id)->delete();
    }
    public function forceDelete(int $id = 0)
    {
        return $this->findById($id)->forceDelete();
    }
    public function deleteByWhereIn(string $whereInField = '', array $whereIn = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->forceDelete();
    }

    public function createPivot($model, array $payload = [], string $relation = '')
    {
        return $model->{$relation}()->attach($model->id, $payload);
    }
}
