<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'user_id','question_id','content'
    ];
    //回答->问题
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    //回答->用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //回答->点赞
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //答案---评论
    public function comments()
    {
        return $this->morphMany('App\Comment','commentable');
    }
}
