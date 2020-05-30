<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use NodeTrait;

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
        'info' => 'json',
        'conf' => 'json',
    ];

    /**
     * 机构用户
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'conf->roles[]->org_id');
    }

    // /**
    //  * 机构的角色根节点
    //  *
    //  */
    // public function role()
    // {
    //     return $this->belongsTo('App\Role', 'conf->roles_id');
    // }
}
