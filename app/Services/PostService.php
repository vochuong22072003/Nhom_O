<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/**
 * Class UserService
 * @package App\Services
 */
class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['post_catalogue_parent_id'] = $request->input('post_catalogue_parent_id');
        if ($condition['post_catalogue_parent_id'] == '0') {
            $condition['post_catalogue_parent_id'] = null;
        }
        $condition['post_catalogue_children_id'] = $request->input('post_catalogue_children_id');
        if ($condition['post_catalogue_children_id'] == '0') {
            $condition['post_catalogue_children_id'] = null;
        }
        $perpage = $request->integer('perpage', 20);
        $posts = $this->postRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path' => 'post/index'],
            ['posts.id', 'DESC'],
            [
                ['post_catalogue_parent as tb2', 'tb2.id', '=', 'posts.post_catalogue_parent_id', 'left'],
                ['post_catalogue_children as tb3', 'tb3.id', '=', 'posts.post_catalogue_children_id', 'left']
            ],
    
        );
        return $posts;
    }
    public function createPost($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['user_id'] = Auth::guard('web')->id();
            // dd($payload);
            $post = $this->postRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
    public function updatePost($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $post = $this->postRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage(); //die();
            return false;
        }
    }
    public function deletePost($id)
    {
        DB::beginTransaction();
        try {
            $post = $this->postRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
    public function deleteAll($post = [])
    {
        DB::beginTransaction();
        try {
            $posts = $this->postRepository->deleteByWhereIn('id', $post['id']);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage(); //die();
            return false;
        }
    }
    public function updateStatus($post=[]){
        DB::beginTransaction();
        try{
            $payload[$post['field']]=(($post['value']==1)?2:1);
            $post=$this->postRepository->update($post['modelId'], $payload);
            // $condition = [
            //     ['id', '=', [$post['modelId']]]
            // ];
            // $this->postRepository->updateByWhere($condition, $payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();
            return false;
        }
    }

    private function paginateSelect()
    {
        return [
            'posts.id',
            'posts.post_name',
            'posts.post_excerpt',
            'posts.post_content',
            'posts.image',
            'posts.user_id',
            'tb2.post_catalogue_parent_name',
            'tb3.post_catalogue_children_name',
            'posts.publish'
        ];
    }
    private function payload()
    {
        return [
            'image',
            'post_catalogue_parent_id',
            'post_catalogue_children_id',
            'post_name',
            'post_content',
            'post_excerpt',
        ];
    }
}
