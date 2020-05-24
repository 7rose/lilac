<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 用户列表
     *
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * 登录用户
     *
     */
    public function me()
    {
        $user = Auth::user();

        $position = '';
        if(count($user->roles)) {
            foreach ($user->roles as $role) {
                if($role->show) $position .= utf8_encode(show($role->info, 'name', show($role->info, 'full_name', ''))).' ';
            }
        }

        $vcard = 'BEGIN:VCARD
        VERSION:4.0
        N:'.utf8_encode(show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '')))).'
        ORG:'.utf8_encode('海上牧云').'
        TITLE:'.$position.'
        EMAIL:'.show($user->ids, 'email.addr', 'hi@mooibay.com').'
        TEL:'.show($user->ids, 'mobile.number', '').'
        REV:'.now().'
        END:VCARD';

        // if(count($user->roles)) {
        //     $vcard .= 'TITLE:';
        //     foreach ($user->roles as $role) {
        //         if($role->show) $vcard .= utf8_encode(show($role->info, 'name', show($role->info, 'full_name', '')));
        //     }
        // }

        // TITLE:Shrimp Man
        // EMAIL:forrestgump@example.com
        // TEL:'.show($user->ids, 'mobile.number', '').'
        // REV:20080424T195243Z
        // x-qq:21588891
        // END:VCARD';
        // $vcard .= 'END:VCARD';

        return view('user.user', compact('user','vcard'));
    }

    /**
     * 用户
     *
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.user', compact('user'));
    }


}
