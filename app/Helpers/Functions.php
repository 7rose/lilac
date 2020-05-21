<?php

use Illuminate\Support\Arr;

function show_json($json, $key_chain, $bakcup=false)
{
    $array = json_decode($json,true);
    return Arr::has($array, $key_chain) ? Arr::get($array, $key_chain) : $bakcup;
}
