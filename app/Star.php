<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
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
    public function video()
    {
        return $this->belongsTo('App\Video', 'video_id');
    }
}
