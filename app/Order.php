<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Free to fill
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Tickets
     *
     */
    public function ticket()
    {
        return $this->hasOne('App\Ticket', 'order_id');
    }

    /**
     * user
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'openid', 'ids->wechat->id');
    }
}

