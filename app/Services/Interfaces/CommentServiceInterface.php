<?php

namespace App\Services\Interfaces;

/**
 * Interface CommentServiceInterface
 * @package App\Services\Interfaces
 */
interface CommentServiceInterface
{
    public function paginate($request);
    public function createComment($request);
}
