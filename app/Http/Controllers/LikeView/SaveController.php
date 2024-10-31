<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use App\Models\SaveFolder;
use Illuminate\Http\Request;
use App\Models\Save;

class SaveController extends Controller
{
    public function getSave(Request $request)
    {
        $request->validate([
            'save_folder_id' => 'required|exists:save:save_folders,folder_id',
            'post_id' => 'required|exists:posts,id',
            'cus_id' => 'required|exists:customer,cus_id',
        ]);
    // check saved
     $exstingSave = Save::where('save_folder_id',$request->input('save_folder_id'))
     ->where('post_id',$request->input('post_id'))
     ->where('cus_id',$request->input('cus_id'))
     ->first();
     // hiển thị thông báo đã lưu 
    if ($exstingSave) {
        return redirect()->back()->with('message', 'Bài viết đã được lưu vào thư mục này.');
    }
        Save::create([
            'save_folder_id' => $request->input('save_folder_id'),
            'post_id' => $request->input('post_id'),
            'cus_id' => $request->input('cus_id'),
        ]);
        return redirect()->back()->with('message', 'Lưu bài viết thành công!');
    }
    public function saveToNewFolder(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:20',
            'description' => 'nullable|string|max:200',
            'post_id'=> 'required|exists:posts,id',
            'cus_id' => 'required|exists:customers,cus_id',
        ]);
        $newFolder = SaveFolder::create([
         'folder_name' => $request->input('folder_name'),
         'description' =>$request->input('description'),
         'cus_id' => $request->input('cus_id'),
        ]);
        Save::create([
            'save_folder_id' => $newFolder->folder_id,
            'post_id' => $request->input('post_id'),
            'cus_id' => $request->input('cus_id'),
        ]);
        return redirect()->back()->with('message', 'Tạo thư mục mới và lưu bài viết thành công!');
    }
    public function deletePostFromFolder($folderId,$postId)
    {
        $save = Save::where('save_folder_id',$folderId)->where('post_id',$postId)->first();
        if($save)
        {
            $save->delete();
            return redirect()->back()->with('message', 'xóa thành công bài viết ');
            
        }
        else
        {
            return redirect()->back()->with('message', 'bài viết không tồn tại ');
        }
    }
}
