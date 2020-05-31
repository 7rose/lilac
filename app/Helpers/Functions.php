<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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


