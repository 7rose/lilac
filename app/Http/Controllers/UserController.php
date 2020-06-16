<?php

namespace App\Http\Controllers;

use App\Helpers\Authorize;
use App\Org;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 用户列表
     *
     */
    public function index()
    {
        $this->authorize('viewAll', User::class);

        $users = $this->choose('staff');

        // return new UserCollection(User::paginate());

        return view('user.index', compact('users'));
    }

    /**
     * 客户
     *
     */
    public function customers()
    {
        // $this->authorize('viewAll', User::class);

        $users = $this->choose('customer');

        return view('user.others', compact('users'));
    }

    /**
     * 展商
     *
     */
    public function suppliers()
    {
        // $this->authorize('viewAll', User::class);

        $users = $this->choose('supplier');

        return view('user.others', compact('users'));
    }

    /**
     * 合作
     *
     */
    public function partners()
    {
        // $this->authorize('viewAll', User::class);

        $users = $this->choose('partner');

        return view('user.others', compact('users'));
    }

    /**
     * 分类
     *
     */
    private function choose($key)
    {
        $parts = Org::where('key',$key)->firstOrFail();

        $all= collect();

        foreach ($parts->descendants as $key) {
            $all = $all->merge($key->users);
        }

        $users = $all->unique('id');

        return $users;
    }

    /**
     * 登录用户
     *
     */
    public function me()
    {
        // $this->authorize('viewAll', User::class);
        $au = new Authorize;
        $user = Auth::user();

        if(!$au->need($user, 'staff')) return view('user.customer', compact('user'));

        return $this->show(0);
    }

    /**
     * 登录用户
     *
     */
    public function update($id)
    {
        $target = User::findOrFail($id);

        $this->authorize('update', $target);

        return redirect()->back();
    }

    /**
     * 锁定
     *
     */
    public function lock($id)
    {
        $target = User::findOrFail($id);

        $this->authorize('lockUser', $target);


        $target->update(['locked' => true]);
        return redirect()->back();
    }

    /**
     * 解锁
     *
     */
    public function unlock($id)
    {
        $target = User::findOrFail($id);

        $this->authorize('lockUser', $target);

        $target->update(['locked' => false]);
        return redirect()->back();
    }

    /**
     * set personal profiles public
     *
     */
    public function pub(Request $request)
    {
        Auth::user()->update(['info->public' => $request->pub == 'true' ? true : false]);
        return json_encode(['checked' => $request->pub]);
    }

    /**
     * 授权
     *
     */
    public function add($id)
    {
        //
    }

    /**
     * 取消授权
     *
     */
    public function remove($id)
    {
        //
    }

    /**
     * 用户
     *
     */
    public function show($id=0)
    {
        // $this->authorize('viewAll', User::class);

        if($id == 0) {
            $user = Auth::user();
        }else{
            // 授权
            $au = new Authorize;
            $user = Auth::user();

            if(!$au->need($user, 'staff')) abort('403');

            $user = User::findOrFail($id);
        }

        $vcard = '';

        // if($user->can('viewAll')) {
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
        // }



        return view('user.show', compact('user', 'vcard'));
    }

}
