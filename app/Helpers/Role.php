<?php

use App\Role;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


function self(User $user)
{
    return Auth::user()->id == $user->id;
}

function myId($id)
{
    return Auth::user()->id == $id;
}
