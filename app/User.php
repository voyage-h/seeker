<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //用户->问题
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //用户->答案
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //关注用户
    public function followed($id)
    {
        return $this->follows()->where('followerable_id',$id)->count();
    }
    //用户的粉丝
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','followerable_id','user_id')->where('followerable_type',self::class)->withTimestamps();
    }

    public function follow()
    {
        return $this->morphMany('App\Follower','followerable');
    }


    //用户关注的人
    public function follows()
    {
        return $this->belongsToMany(self::class,'followers','user_id','followerable_id')->where('followerable_type',self::class)->withTimestamps();
    }

    //用户的私信
    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }

}
