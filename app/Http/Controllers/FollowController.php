<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __invoke (Request $request){
        $request->user()->follows()->toggle($request->only('author_id'));

        return back();
    }
}
