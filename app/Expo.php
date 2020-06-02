<?php

namespace App;

use Illuminate\Support\Arr;
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
     *  查询修改器
     *
     * @param  string  $value
     * @return string
     */
    public function getConfAttribute($value)
    {
        if(is_string($value)) {
            $value = json_decode($value, true);
        }elseif(is_array($value)) {
            // $array = $json;
        }else{
            return $value;
        };

        if(!Arr::has($value, 'manager') || !Arr::has($value, 'checker')) return $value;

        // $array = explode(',', $string);

        // $ok = $may = $error = [];

        // if(count($array)) {
        //     foreach ($array as $key) {
        //         $ex = User::where('ids->mobile->number', $key)->orWhere('info->nick', Str::lower($key))->first();

        //         if($ex) {
        //             $ok[] = $key;
        //         } else {
        //             if(intval($key) > 0) {
        //                 if(preg_match("/^1[3456789]\d{9}$/", $key)) {
        //                     $may[] = $key;
        //                 }else{
        //                     $error[] = $key;
        //                 }

        //             }else{
        //                 $error[] = $key;
        //             }
        //         }
        //     }
        // }


        // $value['nick'] = Str::title($value['nick']);

        // return $value;
    }


}
