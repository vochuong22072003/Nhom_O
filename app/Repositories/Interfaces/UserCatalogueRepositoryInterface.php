<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface UserCatalogueRepositoryInterface
{
    public function all(array $relation = []);
    public function pagination(
        array $column=['*'],
        array $condition=[],
        int $perpage=0, 
        array $extend=[],
        array $orderBy=['id', 'DESC'],
        array $join=[],
        array $relations=[],
        array $rawQuery = []
    );
    public function create(array $payload =[]);
    public function findById(int $id, array $column=['*'], array $relation =[]);
    public function update(int $id=0, array $payload=[]);
    public function delete(int $id=0);
    public function forceDelete(int $id=0);
    public function updateByWhereIn(string $whereInField='', array $whereIn=[], array $payload=[]);
    public function deleteByWhereIn(string $whereInField = '', array $whereIn = []);

}
