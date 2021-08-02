<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakepostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $fakeposts = $user->feed_fakeposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'fakeposts' => $fakeposts,
            ];
        }
        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->fakeposts()->create([
            'content' => $request->content,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $fakepost = \App\Fakepost::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $fakepost->user_id) {
            $fakepost->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function edit($id)
    {
        // idの値で投稿を検索して取得
        $fakepost = \App\Fakepost::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、
        if (\Auth::id() === $fakepost->user_id) {
            
           return view('fakeposts.edit', [
            'fakepost' => $fakepost,
        ]);
        }

    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        // idの値でメッセージを検索して取得
        $fakepost =  \App\Fakepost::findOrFail($id);
        // メッセージを更新
        $fakepost->content = $request->content;
        $fakepost->save();
        
        //ログイン後のトップページに戻る
        return redirect('/');
        
       
    }
}
