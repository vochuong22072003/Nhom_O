<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use App\Models\SaveFolder;
use App\Models\Save;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use DB;
class SaveFolderController extends Controller
{
    public function getSave(Request $request)
    {

        $request->validate([
            'save_folder_id' => 'nullable|exists:save_folders,folder_id',
            'post_id' => 'required|exists:posts,id',
            'save_folder_name' => 'required|string|max:255'
        ]);


        // check customer
        $cus_id = auth()->id();

        if (!$cus_id) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện thao tác này.'], 403);
        }

        $folderName = $request->input('save_folder_name');
        $folder = SaveFolder::firstOrCreate(
            [
                'folder_name' => $folderName,
                'cus_owned' => $cus_id,
            ]
        );

        // }
        $exstingSave = Save::where('save_folder_id', $request->input('save_folder_id'))
            ->where('post_id', $request->input('post_id'))
            ->where('cus_id', $cus_id)
            ->first();
        // hiển thị thông báo đã lưu 
        if ($exstingSave) {
            return response()->json(['error' => 'Bài viết đã được lưu vào thư mục này.']);
        }

        Save::create([
            'save_folder_id' => $folder->folder_id,
            'post_id' => $request->input('post_id'),
            'cus_id' => $cus_id,
        ]);


        return response()->json(['success' => 'Lưu bài viết thành công!']);
    }
    public function savePostToFolder(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'save_folder_id' => 'required|exists:save_folders,folder_id',
        ]);
        $userId = auth(guard: 'customers')->id();
        $postId = $request->input('post_id');
        $SavefolderId = $request->input('save_folder_id');

        $save = Save::withTrashed()->where([
            'post_id' => $postId,
            'save_folder_id' => $SavefolderId,
            'cus_id' => $userId,
        ]);

        $M = $save->first();
        if ($M == null) {
            Save::create([
                'post_id' => $postId,
                'save_folder_id' => $SavefolderId,
                'cus_id' => $userId,
            ]);
            return response()->json(['message' => 'Bài viết đã được lưu vào thư mục ']);
        }
        if (optional($M)->deleted_at == null) {
            $save->delete();
            return response()->json(['message' => 'Bài viết đã được xóa khỏi thư mục ']);
        } else {
            $save->first()->restore();
            return response()->json(['message' => 'Bài viết đã được lưu vào thư mục ']);
        }
    }
    public function deteleFolder($folderId)
    {
        try {
            DB::transaction(function () use ($folderId) {
                DB::table('saves')->where('save_folder_id', $folderId)->delete();
                DB::table('save_folders')->where('folder_id', $folderId)->delete();
            });
            return redirect()->back()->with('success', 'thư mục và bài viết đã được xóa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'có lỗi xảy ra khi xóa thư mục');
        }
    }
    public function detelePostFromFolder($folderId, $postId)
    {
        try {
            DB::table('saves')
                ->where('save_folder_id', $folderId)
                ->where('post_id', $postId)
                ->delete();

            return redirect()->back()->with('success', 'Bài viết đã được xóa khỏi thư mục.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa bài viết khỏi thư mục.');
        }
    }
}
