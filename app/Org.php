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

    // /**
    //  * Parent
    //  *
    //  */
    // public function parent()
    // {
    //     return $this->belongsTo('App\Org', 'parent_id');
    // }

    // /**
    //  * Children
    //  *
    //  */
    // public function children()
    // {
    //     return $this->hasMany('App\Org', 'parent_id');
    // }

    /**
     * Orgs of a user [json relations]
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'auth->org_ids');
    }
}
