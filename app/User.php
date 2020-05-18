<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    /**
     * Free to fill
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Parent
     *
     */
    public function parent()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Children
     *
     */
    public function children()
    {
        return $this->hasMany('App\User', 'created_by');
    }

    /**
     * Tickets
     *
     */
    public function tickets()
    {
        return $this->belongsTo('App\Ticket', 'user_id');
    }

    /**
     * For JOSN relations
     *
     */
    protected $casts = [
        'auth' => 'json',
    ];

    /**
     * Orgs of a user
     *
     */
    public function orgs()
    {
        return $this->belongsToJson('App\Org', 'auth->org_ids');
    }

    /**
     * Roles of a user
     *
     */
    public function roles()
    {
        return $this->belongsToJson('App\Role', 'auth->role_ids');
    }
}
