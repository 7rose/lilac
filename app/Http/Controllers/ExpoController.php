<?php

namespace App\Http\Controllers;

use App\Expo;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpoController extends Controller
{
    /**
     * 展会列表
     *
     */
    public function index()
    {
        $this->authorize('viewAll', Expo::class);

        $expos = Expo::latest()->paginate(15);
        return view('expo.index', compact('expos'));
    }

    /**
     * 展会
     *
     */
    public function notice()
    {
        return view('expo.notice');
    }

    /**
     * 展会
     *
     */
    public function show($id)
    {
        $this->authorize('viewAll', Expo::class);

        $expo = Expo::findOrFail($id);

        $e = App\Expo::find($id);

        $limit = intval(show($e->info,'limit'));
        $t = $e->tickets;
    
        $sale = $t->count();
    
        $come = $t->reject(function ($key) {
            return !$key->used;
        });
    
        $p1 = round($sale / $limit * 100, 2);
        $p2 = round($come->count() / $sale * 100, 2);
    
        $text = "售票/容量: {$sale}/{$limit} [{$p1}%]<br> 参展/售票: {$come->count()}/{$sale} [{$p2}%]";

        return view('expo.show', compact('expo', 'text'));
    }

    /**
     * 发布
     *
     */
    public function create()
    {
        $this->authorize('create', Expo::class);

        return view('expo.create');
    }

    /**
     * 发布保存
     *
     */
    public function store(Request $request)
    {
        $this->authorize('create', Expo::class);

        $request->validate([
            'title' => ['required','string', 'min:4', 'max:16'],
            'addr' => ['required', 'min:6', 'max:100'],
            'begin' => ['required', 'after:'.today()],
            'end' => ['required', 'after:'.$request->begin],
            'ready' => ['required', 'after:'.today()],
            'price' => ['required', 'numeric', 'min:0', 'max:1000'],
            'limit' => ['required', 'integer', 'min:100', 'max:100000'],
            'manager' => ['max:110'],
            'checker' => ['max:110'],
        ]);

        if(Expo::where('info->title', $request->title)->first()) return redirect()
                                                                            ->back()
                                                                            ->withInput()
                                                                            ->withErrors(['title' => ['标题重复']]);

        $mc = pick($request->manager);

        if(count($mc->error)) return redirect()->back()->withInput()->withErrors(['manager' => [implode(', ', $mc->error).' 无效']]);

        $cc = pick($request->checker);

        if(count($cc->error)) return redirect()->back()->withInput()->withErrors(['checker' => [implode(', ', $cc->error).' 无效']]);

        $new = [
            'info' => [
                'title' => $request->title,
                'addr' => $request->addr,
                'price' => $request->price,
                'limit' => $request->limit,
                'ready' => $request->ready,
            ],
            'conf' => [
                'manager' => $request->manager,
                'checker' => $request->checker,
            ],
            'begin' => $request->begin,
            'end' => $request->end,
            'on' => $request->has('on'),
            'created_by' => Auth::id(),
        ];

        if($request->has('on')) Expo::where('end', '>', now())->update(['on' => false]);

        $in = Expo::create($new);

        $msg = '操作已成功！<br>';
        if(count($mc->may)) $msg .= implode(', ', $mc->may);
        if(count($cc->may)) $msg .= ', '.implode(', ', $cc->may);
        if(count($cc->may) || count($mc->may)) $msg .= ' 还不是注册用户，但当其完成注册后会自动获取相应的权限。';

        $conf = [
            'msg' => $msg,
            'icon_color' => 'success',
            'btn_color' => 'success',
            'btn_text' => '查看',
            'btn_link' => 'expo/'.$in->id,
        ];

        return view('note', compact('conf'));
    }


    /**
     * 预告片
     *
     *
     */
    public function trailer()
    {
        $expos = Expo::where('on', true)->get();

        return view('trailer', compact('expos'));
        // return view('trailer');

    }


    /**
     * 上下线
     *
     */
    public function allow(Request $request, $id)
    {
        $this->authorize('create', Expo::class);

        $on_line = Expo::findOrFail($id);

        $on = false;

        if($request->on == 'true' || $request->on == true) {
            $on = true;
            // Expo::where('end', '>', now())->update(['on' => false]);
        }

        $on_line->update(['on' => $on]);

        return json_encode(['checked' => $on]);
    }

    /**
     * 登记入场顺序
     *
     */
    public function sort($id)
    {
        $expo = Expo::findOrFail($id);

        return view('expo.sort', compact('expo'));
    }

    /**
     * 登记入场顺序: 保存
     *
     */
    public function sortStore(Request $request, $id)
    {

        $add_array = explode('.', $request->mix);
        $edit_array = explode('=', $request->mix);

        if(count($add_array) == 2 && count($edit_array) != 2) {
            // 添加
            if(intval($add_array[1]) == 0) return redirect()->back()->withInput()->withErrors(['mix' => ['格式错误']]);

            $ticket = Ticket::where('id', $add_array[0])->where('expo_id', $id)->first();

            if(!$ticket) return redirect()->back()->withInput()->withErrors(['mix' => ['票号不存在,或者不属于本场展会']]);
            if(!empty($ticket->sorted)) return redirect()->back()->withInput()->withErrors(['mix' => ['此票已经成功设置次序, 修改请使用 "="']]);

            // $ticket->update([
            //     'sort' => intval($add_array[1]),
            // ]);
            $new_logs = $ticket->logs;
            $new_logs[] = ['time' => time(), 'do' => '登记入场次序'.$add_array[1], 'by' => Auth::id()];
            $ticket->sorted = intval($add_array[1]);
            $ticket->logs = $new_logs;
            $ticket->save();

            $conf = [
                'msg' => '已经成功设置次序!',
                'icon_color' => 'success',
                'btn_color' => 'success',
                'btn_text' => '继续设置',
                'btn_link' => 'expo/sort/'.$id,
            ];

            return view('note', compact('conf'));

        }elseif(count($add_array) != 2 && count($edit_array) == 2){
            // 添加
            if(intval($edit_array[1]) == 0) return redirect()->back()->withInput()->withErrors(['mix' => ['格式错误']]);

            $ticket = Ticket::where('id', $edit_array[0])->where('expo_id', $id)->first();
            if(!$ticket) return redirect()->back()->withInput()->withErrors(['mix' => ['票号不存在,或者不属于本场展会']]);
            // if(!empty($ticket->sort)) return redirect()->back()->withInput()->withErrors(['mix' => ['此票已经成功设置次序, 修改请使用 "="']]);

            $ticket->sorted = intval($edit_array[1]);
            $new_logs = $ticket->logs;
            $new_logs[] = ['time' => time(), 'do' => '设置入场次序'.$edit_array[1], 'by' => Auth::id()];
            $ticket->logs = $new_logs;
            $ticket->save();

            $conf = [
                'msg' => '已经成功设置次序!',
                'icon_color' => 'success',
                'btn_color' => 'success',
                'btn_text' => '继续设置',
                'btn_link' => 'expo/sort/'.$id,
            ];

            return view('note', compact('conf'));

        }else{
            return redirect()->back()->withInput()->withErrors(['mix' => ['格式错误']]);
        }


    }

}
