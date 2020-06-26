<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class discovery extends Model
{

    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    /*
     * 定义json列
     */
    protected $casts = [
        'author' => 'json',
        'eye_images' => 'json',
        'tags' => 'json',
    ];
}
