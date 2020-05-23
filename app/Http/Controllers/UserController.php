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
        return view('user.me', compact('user'));
    }

    /**
     * 用户
     *
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.me', compact('user'));
    }


}
