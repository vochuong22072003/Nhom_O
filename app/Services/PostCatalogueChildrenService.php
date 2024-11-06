<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueChildrenServiceInterface;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\PostCatalogueChildrenPermission;

/**
 * Class UserServices
 * @package App\Services
 */
class PostCatalogueChildrenService implements PostCatalogueChildrenServiceInterface
{
    protected $postCatalogueChildrenRepository;

    public function __construct(PostCatalogueChildrenRepository $postCatalogueChildrenRepository)
    {
        $this->postCatalogueChildrenRepository = $postCatalogueChildrenRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perpage = $request->integer('perpage', 20);
        $condition['publish'] = $request->input('publish');
        if ($condition['publish'] == '0') {
            $condition['publish'] = null;
        }
        $postCatalogueChildrens = $this->postCatalogueChildrenRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path' => 'post/catalogue/children/index'],
            [],
            [],
            ['posts']
        );
        return $postCatalogueChildrens;
    }
    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $user = $this->postCatalogueChildrenRepository->update($post['modelId'], $payload);
            $condition = [
                ['id', '=', [$post['modelId']]]
            ];
            $this->postCatalogueChildrenRepository->updateByWhere($condition, $payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            return false;
        }
    }
    private function paginateSelect()
    {
        return [
            'id',
            'post_catalogue_parent_id',
            'post_catalogue_children_name',
            'post_catalogue_children_description',
            'publish'
        ];
    }
    public function createPostCatalogueChildren($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            // dd($payload);
            $postCatalogueChildren = $this->postCatalogueChildrenRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
    public function updatePostCatalogueChildren($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $postCatalogueChildren = $this->postCatalogueChildrenRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
    public function deletePostCatalogueChildren($id)
    {
        DB::beginTransaction();
        try {
            $postCatalogueChildren = $this->postCatalogueChildrenRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
}
