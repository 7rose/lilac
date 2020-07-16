<?php

namespace App\Http\Controllers;

use App\Helpers\Authorize;
use Illuminate\Http\Request;
use App\Exports\TicketExport;
use App\Exports\Ticket25Export;
use App\Exports\Ticket26Export;
use Illuminate\Support\Facades\Log;
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
    public function download($key) 
    {
        if(intval($key) == 25) {
            Log::alert(face(Auth::user())->name.'下载25日票号excel');
            return Excel::download(new Ticket25Export, 'tickets_25.xlsx');
        }
        if(intval($key) == 26) {
            Log::alert(face(Auth::user())->name.'下载26日票号excel');
            return Excel::download(new Ticket26Export, 'tickets_26.xlsx');
        }

        abort('403');
        
    }


}
