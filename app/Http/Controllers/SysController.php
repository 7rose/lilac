<?php

namespace App\Http\Controllers;

use App\Helpers\Authorize;
use Illuminate\Http\Request;
use App\Exports\TicketExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SysController extends Controller
{

    /**
     * 通知
     *
     */
    public function apps()
    {
        $au = new Authorize;
        $user = Auth::user();

        if(!$au->need($user, 'staff')) abort('403');

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

    /**
     * report
     *
     */
    public function report()
    {
        $au = new Authorize;
        if(!Auth::check() || !$au->need(Auth::user(), 'board')) abort('403');
        return view('report');
    }

    /**
     * 下载excel
     *
     */
    public function download() 
    {
        return Excel::download(new TicketExport, 'tickets.xlsx');
    }


}
