<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    protected $userService;

    public function __construct(){
    
    }

    public function changeStatus(Request $request){
        $post=$request->input();
        // dd($post);
        $serviceInterfaceNamespace='\App\Services\\'.ucfirst($post['model']).'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance=app($serviceInterfaceNamespace);
        }
        $flag=$serviceInstance->updateStatus($post);
        if($flag !== false){
            return response()->json(['flag'=>$flag]);
        }else{
            return response()->json([
                'message' => 'Dữ liệu không tồn tại!',
            ], 404);
        }
    }
    public function changeStatusAll(Request $request){
        $post=$request->input();
        $serviceInterfaceNamespace='\App\Services\\'.ucfirst($post['model']).'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance=app($serviceInterfaceNamespace);
        }
        $flag=$serviceInstance->updateStatusAll($post);
        if($flag !== false){
            return response()->json(['flag'=>$flag]);
        }else{
            return response()->json([
                'message' => 'Dữ liệu không tồn tại!',
            ], 404);
        }
    }

}
