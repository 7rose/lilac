<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
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
        'parts' => 'json',
        'log' => 'json',
    ];

    /**
     * 角色用户
     *
     */
    public function users()
    {
        return $this->belongsToJson('App\User', 'parts[]->id');
    }

    /**
     * 角色用户
     *
     */
    public function creater()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
