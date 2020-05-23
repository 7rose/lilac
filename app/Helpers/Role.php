<?php

use App\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


function need($key)
{
    $role_keys = Auth::user()->roles()->plunk('key');

    $keys = Arr::flatten($role_keys);
    $all_roles = Role::all();

}
