<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];
    
    //问题->标签
    public function labels()
    {
        return $this->belongsToMany(Label::class)->withTimestamps();
    }
    
    //问题->用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //问题->答案
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    //问题->第一个答案
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
    //问题关注者
    public function follow()
    {
         return $this->morphMany('App\Follower','followerable');
    }

    //问题---评论
    public function comments()
    {
        return $this->morphMany('App\Comment','commentable');
    }
}
