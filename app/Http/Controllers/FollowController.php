<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __invoke (Request $request){
        $request->user()->follows()->syncWithoutDetaching($request->only('user_id'));
    }
}
