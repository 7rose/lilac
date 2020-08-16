<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function token($id)
    {   
        $user = User::findOrFail($id);
        // $user = App\User::find(2);
        // $user = App\User::find(1);
        // $user = App\User::find(8);
        // Auth::login($user);
        print_r($user->info);

        $t = $user->createToken('goodluck')->plainTextToken;

        // Auth::guard('sanctum')->user()
        echo '<br>'.$t;
    }
}
