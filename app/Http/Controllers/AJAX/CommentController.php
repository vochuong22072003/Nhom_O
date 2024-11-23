<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommentRepositoryInterface as CommentRepository;
use App\Services\Interfaces\CommentServiceInterface as CommentService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReplyCommentRequest;

use Illuminate\Http\Request;


class CommentController extends Controller
{
    protected $commentRepository;
    protected $commentService;

    public function __construct(CommentRepository $commentRepository, CommentService $commentService){
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    public function createReply(ReplyCommentRequest $request){
        // dd($request);
        $comment = $this->commentService->createReplyComment($request);
        if($comment){
            // dd($comment);
            if($comment !== false){
                $comment_info = $this->commentRepository->findById($comment->id,['*'],['customers']);
                // dd($comment_info);
                $client_logged = Auth::id();
                $html = $this->renderHtml($comment_info, $client_logged);
                $response=[
                    'html'=>$html,
                    'comment_id'=>$comment->id,
                ];
                return response()->json($response);
            }
        }else{
            return response()->json([
                'message' => 'Comment không tồn tại!',
            ], 404);
        }
    }

    function renderHtml($comment_info, $client_logged) {
        $html = '';
        $html .= '<div class="comment-item-reply comment-item-reply-'.$comment_info->id.' row align-items-start mt-3">';
        $html .= '    <div class="col-auto">';
        $html .= '        <img src="' . asset("Backend/img/not-found.png") . '" alt="Avatar" class="comment-avatar">';
        $html .= '    </div>';
        $html .= '    <div class="col">';
        $html .= '        <div class="comment-content">';

        if ($client_logged == $comment_info->customer_id) {
        $html .= '            <div class="d-flex justify-content-between align-items-center">';
        $html .= '                <div class="comment-name">' . htmlspecialchars($comment_info->customers->cus_user) . '</div>';
        $html .= '                <div class="comment-options-n"><i class="fas fa-ellipsis-v"></i></div>';
        $html .= '                <div class="comment-actions-n d-none">';
        $html .= '                    <div class="action-item action-edit-n">Sửa</div>';
        $html .= '                    <div class="action-item action-delete-n">Xóa</div>';
        $html .= '                </div>';
        $html .= '            </div>';
        }else{
        $html .= '            <div class="comment-name">' . htmlspecialchars($comment_info->customers->cus_user) . '</div>';
        }

        $html .= '            <div class="comment-time">' . \Carbon\Carbon::parse($comment_info->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') . '</div>';
        $html .= '            <div class="comment-text">' . htmlspecialchars($comment_info->content) . '</div>';
        $html .= '        </div>';
        $html .= '        <div class="reply-comment-n reply-comment-n-' .$comment_info->id. '" ';
        $html .= '            data-commentId="' . $comment_info->id . '" ';
        $html .= '            data-postId="' . $comment_info->post_id . '" ';
        $html .= '            data-customerId="' . htmlspecialchars($client_logged) . '">';
        $html .= '            Trả lời';
        $html .= '        </div>';
        $html .= '        <div class="store-reply-n store-reply-n-'.$comment_info->id.'"></div>';
        $html .= '        <div class="reply-container-n"></div>';
        $html .= '    </div>';
        $html .= '</div>';
        return $html;
    }

    public function showReply(Request $request){
        $get=$request->input();
        // dd($get);

        $replyIds = json_decode($get['replyIds']);
        // dd($replyIds);

        foreach($replyIds as $replyId){
            $comments_info[] = $this->commentRepository->findById($replyId,['*'],['customers']);
        }
        // dd($comments_info);

        $client_logged = Auth::id();

        $html = '';  
        foreach ($comments_info as $comment_info) {
            $html .= $this->renderHtml($comment_info, $client_logged);
        }
        // dd($html);
        
        $response=[
            'html'=>$html
        ];
        return response()->json($response);
    }

    public function createReplyN(ReplyCommentRequest $request){
        // dd($payload);
        $comment = $this->commentService->createReplyComment($request);
        // dd($comment);
        if($comment){
            // dd($comment->id);
            $comment_info = $this->commentRepository->findById($comment->id,['*'],['customers']);
            // dd($comment_info);
            $client_logged = Auth::id();
            $html = $this->renderHtml($comment_info, $client_logged);
            $response=[
                'html'=>$html,
                'from_comment_id'=>$request['commentId'],
                'comment_id'=>$comment->id
            ];
            return response()->json($response);
        }else{
            return response()->json([
                'message' => 'Comment không tồn tại!',
            ], 404);
        }
    }

    public function update(ReplyCommentRequest $request){
        // dd($request);
        $comment = $this->commentService->updateComment($request);
        if($comment){
            // dd($comment);
            $response=[
                'content'=>$comment->content,
            ];
            return response()->json($response);
        }else{
            return response()->json([
                'message' => 'Comment không tồn tại!',
            ], 404);
        }
    }

    public function updateN(ReplyCommentRequest $request){
        // dd($request);
        $comment = $this->commentService->updateComment($request);
        if($comment){
            // dd($comment);
            $response=[
                'content'=>$comment->content,
            ];
            return response()->json($response);
        }else{
            return response()->json([
                'message' => 'Comment không tồn tại!',
            ], 404);
        }
    }

    public function delete(Request $request){
        // dd($request);
        $comment = $this->commentService->deleteComment($request);
        if($comment != false){
            // dd($comment);
            $response=[
                'message'=>'Xóa thành công',
            ];
            return response()->json($response);
        }else{
            return response()->json([
                'message' => 'Comment không tồn tại!',
            ], 404);
        }
    }

    public function deleteN(Request $request)
    {
        $comment = $this->commentService->deleteComment($request);
        // dd($comment);
        // Kiểm tra flag trả về từ deleteComment
        if($comment !== false){
            if ($comment['flag'] === true) {
                $deletedComments = $comment['deleted_comment_ids'];  
    
                $request['commentId'] = (array) $request['commentId'];  // Đảm bảo commentId là mảng
                $allDeletedComments = array_merge($deletedComments, $request['commentId']);
                
                $response = [
                    'message' => 'Xóa thành công',
                    'deleted_comments' => $allDeletedComments,
                ];
                return response()->json($response);
            } elseif ($comment['flag'] === 'single') {
                $response = [
                    'message' => 'Xóa thành công',
                    'deleted_comments' => $request['commentId'],
                ];
                return response()->json($response);
            }
        }
        else {
            // Nếu không tìm thấy comment hoặc xảy ra lỗi
            return response()->json([
                'message' => $comment['message'] ?? 'Có lỗi xảy ra!',
            ], 404);
        }
    }
}
