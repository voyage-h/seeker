<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['type','notifiable_type','notifiable_id','data'];
     /**
     * 应该被转化为原生类型的属性
     *
     * @var array
     */
    protected $casts = [
        'data' => 'object',
    ];
}
