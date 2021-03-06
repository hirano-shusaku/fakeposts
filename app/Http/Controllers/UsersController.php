<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザの投稿一覧を作成日時の降順で取得
        $fakeposts = $user->fakeposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'fakeposts' => $fakeposts,
        ]);
    }
    
     public function edit($id)
    {
        // idの値でユーザーを検索してデータ取得
        $user = User::findOrFail($id);
        
        // ユーザー編集ビューでそれを表示
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'age' => 'required|max:255',
            'profile' => 'required|max:255',
        ]);
        // idの値でユーザーを検索して取得
        $user =  \App\User::findOrFail($id);
        // メッセージを更新
        $user->age = $request->age;
        $user->profile = $request->profile;
        $user->save();
        
        //ログイン後のトップページに戻る
        return redirect('/');
    }
    
    public function destroy($id)
    {
        // idの値でユーザーを検索してデータ取得
        $user = User::findOrFail($id);
        
        $user->delete();
        
        return redirect('/');
    }

    public function delete_confirm()
    {
        return view('users.delete_confirm');
    }
    
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
     public function likeings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿likes一覧を取得
        $likeings = $user->postlikes()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.postlikes', [
            'user' => $user,
            'fakeposts' => $likeings,
        ]);
    }
}
