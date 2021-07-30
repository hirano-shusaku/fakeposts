<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store($fakepost)
    {
        // 認証済みユーザ（閲覧者）が、 fakepostをフォローする
        \Auth::user()->like($fakepost);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($fakepost)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
        \Auth::user()->unlike($fakepost);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
