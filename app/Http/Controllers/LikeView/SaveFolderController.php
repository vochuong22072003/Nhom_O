<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use App\Models\SaveFolder;
use Illuminate\Http\Request;

class SaveFolderController extends Controller
{
    public function deteleFolder($folderId)
    {
        $folder = SaveFolder::find($folderId);
        if ($folder)
        {
            $folder->delete();
            return redirect()->back()->with('message', 'xóa thành công danh mục ');
            
        }
        else
        {
            return redirect()->back()->with('message', 'danh mục không tồn tại ');
        }
    }
}
