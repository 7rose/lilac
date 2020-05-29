<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use NodeTrait;

    /**
     * 定义josn列
     *
     */
    protected $casts = [
        'info' => 'json',
    ];

    /**
     * Role users
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'conf->roles[]->role');
    }
}
