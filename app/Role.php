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
        // 'conf' => 'json',
    ];

    /**
     * 角色用户
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'conf->roles[]->role_id');
    }

    // /**
    //  * 角色机构
    //  *
    //  */
    // public function org()
    // {
    //     return $this->hasOne('App\Org', 'conf->roles_id');
    // }
}
