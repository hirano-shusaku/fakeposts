<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakepost extends Model
{
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function postlikes_users()
    {
        return $this->belongsToMany(User::class, 'post_like', 'fakepost_id', 'user_id')->withTimestamps();
    }
}
