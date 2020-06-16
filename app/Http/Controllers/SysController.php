<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SysController extends Controller
{

    /**
     * 通知
     *
     */
    public function apps()
    {
        return view('apps');
    }

    /**
     * 通知
     *
     */
    public function note()
    {
        return view('note');
    }

    /**
     * 消息
     *
     */
    public function msg()
    {
        $conf = [
            'icon' => 'envelope-o',
            'msg' => '暂时还没有通知',
        ];

        return view('note', compact('conf'));
    }

    /**
     * 通知
     *
     */
    public function contact()
    {
        return view('contact');
    }

}
