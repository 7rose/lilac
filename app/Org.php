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
     * Orgs of a user [json relations]
     *
     */
    public function users()
    {
        return $this->hasManyJson('App\User', 'conf->roles[]->org');
    }
}
