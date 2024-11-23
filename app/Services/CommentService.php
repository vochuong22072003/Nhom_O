<?php

namespace App\Services;

use App\Services\Interfaces\CommentServiceInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface as CommentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/**
 * Class UserService
 * @package App\Services
 */
class CommentService implements CommentServiceInterface
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['post_id'] = $request->input('post_id');
        if ($condition['post_id'] == '0') {
            $condition['post_id'] = null;
        }
        $condition['customer_id'] = $request->input('customer_id');
        if ($condition['customer_id'] == '0') {
            $condition['customer_id'] = null;
        }
        $perpage = $request->integer('perpage', 20);
        $posts = $this->commentRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path' => 'post/index'],
            ['comments.id', 'DESC'],
            [
                ['posts as tb2', 'tb2.id', '=', 'comments.post_id', 'left'],
                ['customers as tb3', 'tb3.cus_id', '=', 'comments.customer_id', 'left']
            ],
    
        );
        return $posts;
    }
    public function createComment($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['customer_id'] = Auth::id();
            // dd($payload);
            $post = $this->commentRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die();
            return false;
        }
    }
    public function createReplyComment($request)
    {
        DB::beginTransaction();
        try {
            $payload=[
                'parent_id' => $request['commentId'],
                'customer_id' => $request['customerId'],
                'post_id' => $request['postId'],
                'content' => $request['content'],
            ];
            // dd($payload);
            $post = $this->commentRepository->findById($request['commentId']);
            if($post){
                $post = $this->commentRepository->create($payload);
            }else{
                $post = false;
            }
            DB::commit();
            return $post;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            // die();
            return false;
        }
    }
    public function updateComment($request)
    {
        DB::beginTransaction();
        try {
            $payload=[
                'content' => $request['content'],
            ];
            // dd($payload);
            $post = $this->commentRepository->update($request['commentId'], $payload);
            $post = $this->commentRepository->findById($request['commentId'],['*'],['customers']);
            DB::commit();
            return $post;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            // die();
            return false;
        }
    }
    public function deleteComment($request){
        DB::beginTransaction();
        try {
            $post = $this->commentRepository->findById($request['commentId']);
        
            if ($post) {
                $countCommentReplyIds = $this->countCommentReply($request['commentId']);
                
                if (!empty($countCommentReplyIds)) {
                    // Xóa các reply comments
                    foreach ($countCommentReplyIds as $countCommentReplyId) {
                        $this->commentRepository->delete($countCommentReplyId);
                    }
                    // Xóa comment chính
                    $this->commentRepository->delete($request['commentId']);
                    $post = [
                        'flag' => true,
                        'deleted_comment_ids' => $countCommentReplyIds,
                    ];
                } else {
                    // Chỉ xóa comment chính nếu không có reply
                    $this->commentRepository->delete($request['commentId']);
                    $post = [
                        'flag' => 'single',  // Chỉ có một comment bị xóa
                        'deleted_comment_ids' => [$request['commentId']],
                    ];
                }
            } else {
                // Nếu không tìm thấy comment
                $post = [
                    'flag' => false,
                    'message' => 'Comment không tồn tại!',
                ];
            }
            DB::commit();
            return $post;
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            // die();
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

    public function countCommentReply($commentId, $isRoot = true)
    {
        // Lấy tất cả các id reply của comment hiện tại
        $commentReplyIds = DB::table('comments')->where('parent_id', $commentId)->orderBy('id', 'desc')->pluck('id')->toArray();
        
        // Nếu là lớp cha ngoài cùng (isRoot = true), không thêm commentId vào mảng
        if ($isRoot) {
            $allIds = [];
        } else {
            $allIds = [$commentId];
        }
    
        // Duyệt qua các commentReplyId để lấy thêm các phần tử con (nếu có)
        foreach ($commentReplyIds as $commentReplyId) {
            // Gọi đệ quy để lấy các reply của commentReplyId (cấp con của cấp con), không phải cha ngoài cùng
            $allIds = array_merge($allIds, $this->countCommentReply($commentReplyId, false));
        }
    
        // Trả về mảng đã sắp xếp theo thứ tự cha -> con
        return $allIds;
    }
    
    // Đếm số lượng phần tử trong mảng con hiện tại
    function countNestedArray($array) {
        $result = [];
    
        foreach ($array as $subArray) {
            if (is_array($subArray)) {
                $result[] = count($subArray);
                $result = array_merge($result, $this->countNestedArray($subArray));
            }
        }
    
        return $result;
    }
    
    // Tạo ra danh sách mảng id reply con đổ balde
    function collectNestedIds(array $array): array {
        $ids = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $ids = array_merge($ids, $this->collectNestedIds($item));
            } else {
                $ids[] = $item;
            }
        }
        return $ids;
    }
    

    private function paginateSelect()
    {
        return [
            'comments.id',
            'comments.content',
            'comments.publish',
            'tb2.name',
            'tb3.cus_user',
        ];
    }
    private function payload()
    {
        return [
            'content',
            'post_id',
        ];
    }
}
