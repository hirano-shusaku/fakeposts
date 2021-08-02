<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'profile', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function fakeposts()
    {
        return $this->hasMany(Fakepost::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function postlikes()
    {
        return $this->belongsToMany(Fakepost::class, 'post_like', 'user_id', 'fakepost_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_fakeposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Fakepost::whereIn('user_id', $userIds);
    }
    
    public function like($fakepostId)
    {
        // すでにその投稿をlikeしているかの確認
        $exist = $this->is_likeing($fakepostId);
       
        if ($exist) {
            // すでにlikeしていれば何もしない
            return false;
        } else {
            // 未likeであればpostlikesする
            $this->postlikes()->attach($fakepostId);
            return true;
        }
    }
    
    public function unlike($fakepostId)
    {
        
        $exist = $this->is_likeing($fakepostId);
       
        if ($exist) {
            
             $this->postlikes()->detach($fakepostId);
            return true;
        } else {
            
            return false;
        }
    }
    
     public function is_likeing($fakepostId)
    {
        
        return $this->postlikes()->where('fakepost_id', $fakepostId)->exists();
    }


    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['fakeposts', 'followings', 'followers','postlikes']);
    }
}
