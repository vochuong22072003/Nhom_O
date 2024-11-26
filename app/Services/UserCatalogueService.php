<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Models\UserCataloguePermission;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userRepository;

    public function __construct(UserCatalogueRepository $userCatalogueRepository, UserRepository $userRepository){
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->userRepository=$userRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $perpage=$request->integer('perpage', 20);
        $condition['publish']=$request->input('publish');
        if ($condition['publish'] == '0') {
            $condition['publish'] = null;
        }
        $userCatalogues=$this->userCatalogueRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perpage, 
            ['path'=> 'user/catalogue/index'], 
            [],
            [], 
            ['users']
        );
        return $userCatalogues;
    }
    public function updateStatus($post=[]){
        DB::beginTransaction();
        try{
            $flag = $this->userCatalogueRepository->findById($post['modelId']);
            // dd($flag);
            if ($flag) {
                $payload[$post['field']]=(($post['value']==1)?2:1);
                $user=$this->userCatalogueRepository->update($post['modelId'], $payload);
                $condition = [
                    ['user_catalogue_id', '=', [$post['modelId']]]
                ];
                $post = $this->userRepository->updateByWhere($condition, $payload);
            }else{
                $post = false;
            }
            DB::commit();
            return $post;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();
            return false;
        }
    }
    private function paginateSelect(){
        return [
            'id','name','description','publish'
        ];
    }
    public function createUserCatalogue($request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            $userCatalogue=$this->userCatalogueRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
    public function updateUserCatalogue($id, $request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            $userCatalogue=$this->userCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }
    public function deleteUserCatalogue($id){
        DB::beginTransaction();
        try{
            $userCatalogue=$this->userCatalogueRepository->forceDelete($id);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }
    public function setPermission($request)
    {
        DB::beginTransaction();
        try {
            $existingPermissions = UserCataloguePermission::pluck('user_catalogue_id')->toArray();
            
            $permissions = $request->input('permission');
            $userCatalogueIds = array_keys($permissions);

            $missingIds = array_diff($existingPermissions, $userCatalogueIds);

            foreach ($missingIds as $missingId) {
                $userCatalogue = $this->userCatalogueRepository->findById($missingId);
                $userCatalogue->permissions()->detach();
            }

            foreach ($permissions as $key => $val) {
                $userCatalogue = $this->userCatalogueRepository->findById($key);
                $userCatalogue->permissions()->sync($val);
            }

            DB::commit();
            return true;
        } catch(\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($post=[]){
        //echo 123; die();
        DB::beginTransaction();
        try{
            // dd($post['id']);
            $flag = $this->userCatalogueRepository->checkAllIdsExist($post['id']);
            // dd($flag);
            if($flag){
                $payload[$post['field']]=$post['value'];
                
                //dd($payload);
                $userCatalogues=$this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
                //echo 1; die();
                $this->changeUserStatus($post,$post['value']);
                $post = true;
            }
            else{
                $post = false;
            }
            DB::commit();
            return $post;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
    private function changeUserStatus($post, $value){
       
        DB::beginTransaction();
        try{
            //dd($post);
            $array=[];
            if(isset($post['modelId'])){
                $array[]=$post['modelId'];
            }else{
                $array=$post['id'];
            }//push vào trong mảng để update theo kiểu by where in
            //dd($post);
            $payload[$post['field']]=$value;
            $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
            //echo 123; die();
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
}
