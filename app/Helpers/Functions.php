<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;


/**
 * 显示 json
 *
 * @param $json
 * @param $key_chain 'key.sub'
 * @param $bakcup 'null'
 *
 * @return mix
 */
function show($json, $key_chain, $bakcup=false)
{
    if(is_string($json)) {
        $array = json_decode($json,true);
    }elseif(is_array($json)) {
        $array = $json;
    }else{
        return $bakcup;
    };

    return Arr::has($array, $key_chain) && Arr::get($array, $key_chain) ? Arr::get($array, $key_chain) : $bakcup;
}

/**
 * 人员选择器
 *
 * @param $string 'mobile, nickname'
 *
 * @return array
 */
function pick($string)
{
    if(empty($string)) return (object) collect(['ok' => [], 'may' => [], 'error' => []])->all();

    $array = explode(',', $string);

    $ok = $may = $error = [];

    if(count($array)) {
        foreach ($array as $key) {
            $ex = App\User::where('ids->mobile->number', $key)->orWhere('info->nick', Str::lower($key))->first();

            if($ex) {
                $ok = Arr::add($ok, $key, $ex);
            } else {
                if(intval($key) > 0) {
                    if(preg_match("/^1[3456789]\d{9}$/", $key)) {
                        $may[] = $key;
                    }else{
                        $error[] = $key;
                    }

                }else{
                    $error[] = $key;
                }
            }
        }
    }

    return (object) collect(['ok' => $ok, 'may' => $may, 'error' => $error])->all();
}

/**
 * 人员显示头像
 *
 * @param App/User $user
 *
 * @return $array;
 */
function face($user)
{
    $avatar = show($user->ids, 'wechat.avatar');
    $avatar_text = Str::substr(show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname'))), 0,1);
    $name = show($user->info, 'public') ? show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname'))) :  show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname')));
    $mobile = show($user->info, 'public') ? show($user->ids, 'mobile.number'): false;

    return (object) collect(['avatar' => $avatar, 'avatar_text' => $avatar_text, 'name' => $name, 'mobile' => $mobile, ])->all();
}

/**
 * 按时间排序
 *
 * @param $user
 *
 * @return $array;
 */
function timeline($array)
{
    $sorted = array_values(Arr::sort($array, function ($value) {
        return $value['time'];
    }));

    return $sorted;
}

/**
 * 次数
 *
 * @param $user
 *
 * @return $array;
 */
function times($logs_array, $key, $all=2)
{
    if(count($logs_array)) {
        foreach ($logs_array as $log) {
            if(Arr::has($log, $key) && Arr::get($log, $key) == '赠送') $all --;
        }
    }

    return $all > 0 ? $all : false;
}

