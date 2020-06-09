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
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * user of a ticket
     *
     */
    public function expo()
    {
        return $this->belongsTo('App\Expo', 'expo_id');
    }

    /**
     * user of a ticket
     *
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }


}
