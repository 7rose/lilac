<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    
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
        'from' => 'json',
        'to' => 'json',
    ];

    /**
     * 接收者
     *
     */
    public function user_to()
    {
        return $this->belongsTo('App\User', 'to->id');
    }

    /**
     * 来源者
     *
     */
    public function user_from()
    {
        return $this->belongsTo('App\User', 'from->id');
    }
}
