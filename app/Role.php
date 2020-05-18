<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    /**
     * Parent
     *
     */
    public function parent()
    {
        return $this->belongsTo('App\Role', 'parent_id');
    }

    /**
     * Children
     *
     */
    public function children()
    {
        return $this->hasMany('App\Role', 'parent_id');
    }

    /**
     * Role users
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'auth->role_ids');
    }
}
