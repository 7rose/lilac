<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    /**
     * Free to fill
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 定义josn列
     *
     */
    protected $casts = [
        'content' => 'json',
    ];

    /**
     * 创建人
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * 赞
     *
     */
    public function stars()
    {
        return $this->hasMany('App\Star', 'video_id');
    }

    /**
     * 评论
     *
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'video_id');
    }

    /**
     * 范围
     *
     */
    public function scopeShow($query)
    {
        return $query->where('show', true);
    }
}
