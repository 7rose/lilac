<?php

namespace App\Http\Controllers;

use App\Expo;
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
    public function show($id)
    {
        $this->authorize('viewAll', Expo::class);

        $expo = Expo::findOrFail($id);
        return view('expo.show', compact('expo'));
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
            'price' => ['required', 'numeric', 'min:0', 'max:1000'],
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
        $expo = Expo::where('on', true)->first();

        return view('trailer', compact('expo'));

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
            Expo::where('end', '>', now())->update(['on' => false]);
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

}
