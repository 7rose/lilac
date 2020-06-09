<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expo extends Model
{
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
     * 票
     *
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket', 'expo_id');
    }
}
