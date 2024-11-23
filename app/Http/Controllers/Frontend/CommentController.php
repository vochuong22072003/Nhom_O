<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CommentRepositoryInterface as CommentRepository;
use App\Services\Interfaces\CommentServiceInterface as CommentService;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $commentService;

    public function __construct(CommentRepository $commentRepository, CommentService $commentService){
        $this->commentRepository=$commentRepository;
        $this->commentService = $commentService;
    }
    public function create(CommentRequest $request){
        $post_id = $request->input('post_id');
        $post_id = $this->encryptId($post_id);
        if ($this->commentService->createComment($request)) {
            return redirect()->route('client.detail', ['id' => $post_id])->with('success', 'Thêm mới bình luận thành công');
        }
        return redirect()->route('client.detail', ['id' => $post_id])->with('error', 'Thêm mới bình luận thất bại. Hãy thử lại');
    }

}
