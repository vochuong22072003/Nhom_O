<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueParentServiceInterface;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\PostCatalogueParentPermission;

/**
 * Class UserServices
 * @package App\Services
 */
class PostCatalogueParentService implements PostCatalogueParentServiceInterface
{
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueParentRepository $postCatalogueParentRepository){
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $perpage=$request->integer('perpage', 20);
        $condition['publish']=$request->input('publish');
        if ($condition['publish'] == '0') {
            $condition['publish'] = null;
        }
        $postCatalogueParents=$this->postCatalogueParentRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perpage, 
            ['path'=> 'post/catalogue/parent/index'],   
            [],
            [], 
            []
        );
        return $postCatalogueParents;
    }
    public function updateStatus($post=[]){
        DB::beginTransaction();
        try{
            $payload[$post['field']]=(($post['value']==1)?2:1);
            $user=$this->postCatalogueParentRepository->update($post['modelId'], $payload);
            $condition = [
                ['id', '=', [$post['modelId']]]
            ];
            $this->postCatalogueParentRepository->updateByWhere($condition, $payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();
            return false;
        }
    }
    private function paginateSelect(){
        return [
            'id','post_catalogue_parent_name','post_catalogue_parent_description','publish'
        ];
    }
    public function createPostCatalogueParent($request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            // dd($payload);
            $postCatalogueParent=$this->postCatalogueParentRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }
    public function updatePostCatalogueParent($id, $request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            $postCatalogueParent=$this->postCatalogueParentRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }
    public function deletePostCatalogueParent($id){
        DB::beginTransaction();
        try{
            $postCatalogueParent=$this->postCatalogueParentRepository->forceDelete($id);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }
}
