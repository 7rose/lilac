<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
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
        return $this->belongsTo('App\User', 'user_id');
    } 
}
