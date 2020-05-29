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
    public function index(User $user)
    {
        $this->authorize('viewUsers', $user);

        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * 登录用户
     *
     */
    public function me()
    {
        return $this->show(0);
    }

    /**
     * 锁定
     *
     */
    public function lock($id, User $user)
    {
        $this->authorize('lockUsers', $user);

        $target = User::findOrFail($id)->update(['locked' => true]);
        return redirect()->back();
    }

    /**
     * 解锁
     *
     */
    public function unlock($id, User $user)
    {
        $this->authorize('lockUsers', $user);

        $target = User::findOrFail($id)->update(['locked' => false]);
        return redirect()->back();
    }

    /**
     * 用户
     *
     */
    public function show($id=0, User $user)
    {
        $this->authorize('viewUsers', $user);

        if($id == 0) {
            $user = Auth::user();
        }else{
            $user = User::findOrFail($id);
        }

        $vcard = '';

        if(Auth::user()->id == $user->id || show($user->info, 'public')) {
            $position = [];
            $roles_array = $user->conf['roles'];

            if(is_array($roles_array) && count($roles_array)) {
                foreach ($roles_array as $role) {
                    if($role['org']->show) $position[] = utf8_encode($role['role']->info['name']);
                }
            }

            $position = count($position) ? implode('.', $position) : '';

            $vcard = 'BEGIN:VCARD
            VERSION:4.0
            N:'.utf8_encode(show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '')))).'
            ORG:'.utf8_encode('海上牧云').'
            TITLE:'.$position.'
            EMAIL:'.show($user->ids, 'email.addr', 'hi@mooibay.com').'
            TEL:'.show($user->ids, 'mobile.number', '').'
            REV:'.now().'
            END:VCARD';
        }


        return view('user.user', compact('user', 'vcard'));
    }

}
