<?php

namespace App\Http\Controllers;

use App\User;
use App\Finance;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    /**
     * 财务登记 
     * 
     */
    public function create()
    {
        return view('finance.create');
    }

    /**
     * 保存 
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'for' => ['required','string', 'min:2', 'max:200'],
            'date' => ['required', 'before_or_equal:'.now()],
            'fee' => ['required', 'numeric', 'min:0.01', 'max:1000000'],
        ]);
        
        $all_types = ['out', 'trans', 'in'];

        if(!in_array($request->type, $all_types)) return redirect()
                                                    ->back()
                                                    ->withInput()
                                                    ->withErrors(['type' => ['必须选择业务类型!']]);

        if($request->type == 'trans') {

            $ex = User::where('ids->mobile->number', $request->from)
                        ->orWhere('info->nick', $request->from)
                        ->first();

            if(!$ex) return redirect()
                                ->back()
                                ->withInput()
                                ->withErrors(['from' => ['内部划转时没有匹配到员工!']]);
        }

        $new = [
            'for' => $request->for,
            'fee' => $request->fee,
            'date' => $request->date,
            'type' => $request->type,
            'invoice' => $request->has('invoice'),
            'contract' => $request->has('contract'),
        ];

        switch ($request->type) {
            case 'out':
                $new = Arr::add($new, 'from', ['id'=>Auth::id()]);
                $new = Arr::add($new, 'to', ['val' => $request->to]);
                break;

            case 'trans':
                $new = Arr::add($new, 'to', ['id'=>Auth::id()]);
                $new = Arr::add($new, 'from', ['id' => $ex->id]);
                break;

            case 'in':
                $new = Arr::add($new, 'to', ['id'=>Auth::id()]);
                $new = Arr::add($new, 'from', ['val' => $request->from]);
                break;
            
            default:
                # code...
                break;
        }

        Finance::create($new);

        $conf = [
            'btn_link' => 'finance/create',
            'btn_color' => 'success',
            'btn_text' => '继续',
        ];

        return view('note', \compact('conf'));

    }

    /**
     * 日志
     * 
     */
    public function log()
    {
        $records = Finance::orderBy('date', 'desc')
            ->latest()
            ->paginate(20);

        return view('finance.log', \compact('records'));
    }

    /**
     * 财务登记 
     * 
     */
    public function dash()
    {
        $all = Finance::all()->count();
        $abandon = Finance::where('abandon', true)->count();
        $out = Finance::where('abandon', false)->where('type', 'out')->sum('fee');
        $in = Finance::where('abandon', false)->where('type', 'in')->sum('fee');

        // day
        $all_day = Finance::whereDate('date', today())->count();
        $abandon_day = Finance::whereDate('date', today())->where('abandon', true)->count();
        $out_day = Finance::where('abandon', false)->whereDate('date', today())->where('type', 'out')->sum('fee');
        $in_day = Finance::where('abandon', false)->whereDate('date', today())->where('type', 'in')->sum('fee');

        // month
        $all_month = Finance::whereMonth('date', now()->month)->count();
        $abandon_month = Finance::whereMonth('date', now()->month)->where('abandon', true)->count();
        $out_month = Finance::where('abandon', false)->whereMonth('date', now()->month)->where('type', 'out')->sum('fee');
        $in_month = Finance::where('abandon', false)->whereMonth('date', now()->month)->where('type', 'in')->sum('fee');

        // year
        $all_year = Finance::whereYear('date', now()->year)->count();
        $abandon_year = Finance::whereYear('date', now()->year)->where('abandon', true)->count();
        $out_year = Finance::where('abandon', false)->whereYear('date', now()->year)->where('type', 'out')->sum('fee');
        $in_year = Finance::where('abandon', false)->whereYear('date', now()->year)->where('type', 'in')->sum('fee');
        


        $dash = [
            'all' => $all,
            'abandon' => $abandon,
            'out' => $out,
            'in' => $in,

            'all_day' => $all_day,
            'abandon_day' => $abandon_day,
            'out_day' => $out_day,
            'in_day' => $in_day,

            'all_month' => $all_month,
            'abandon_month' => $abandon_month,
            'out_month' => $out_month,
            'in_month' => $in_month,

            'all_year' => $all_year,
            'abandon_year' => $abandon_year,
            'out_year' => $out_year,
            'in_year' => $in_year,
        ];

        return view('finance.dash', \compact('dash'));

    }

    /**
     * 日志
     * 
     */
    public function confirmed($id)
    {
        $ex = Finance::findOrFail($id);

        if($ex->confirmed || $ex->abandon) abort('403');

        $ex->update(['confirmed' => true]);

        return redirect()->back();
    }

    /**
     * 日志
     * 
     */
    public function abandon($id)
    {
        $ex = Finance::findOrFail($id);

        if($ex->confirmed || $ex->abandon) abort('403');

        $ex->update(['abandon' => true]);

        return redirect()->back();
    }

    /**
     * 日志
     * 
     */
    public function finaces()
    {
        return redirect('/finance/log');
    }
}
