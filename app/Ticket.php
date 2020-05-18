<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * Free to fill
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * user of a ticket
     *
     */
    public function user()
    {
        return $this->hasOne('App\User', 'user_id');
    }
}
