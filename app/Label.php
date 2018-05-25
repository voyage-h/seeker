<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['name'];
    //
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    //标签新增
    protected function upsert($labels)
    {
        $ids = [];
        foreach(explode(' ',$labels) as $label) {
            $ids[] = $this->firstOrCreate(['name'=>$label])->id;
        }
        return $ids;
    }

    //标签关注者
    public function follow()
    {
        return $this->morphMany('App\Follower','followerable');
    }
}
