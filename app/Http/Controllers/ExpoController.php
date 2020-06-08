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
        $expos = Expo::latest()->paginate(15);
        return view('expo.index', compact('expos'));
    }

    /**
     * 展会
     *
     */
    public function show($id)
    {
        $expo = Expo::findOrFail($id);
        return view('expo.show', compact('expo'));
    }



    /**
     * 发布
     *
     */
    public function create()
    {
        return view('expo.create');
    }

    /**
     * 发布保存
     *
     */
    public function store(Request $request)
    {
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
                'open' => $request->has('open'),
            ],
            'begin' => $request->begin,
            'end' => $request->end,
            'created_by' => Auth::id(),
        ];

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
        $on_line = Expo::findOrFail($id);

        $on = false;

        if($request->open == 'true' || $request->open == true) {
            $on = true;
            Expo::where('end', '>', now())->update(['on' => false]);
        }

        $on_line->update(['on' => $on]);

        return json_encode(['checked' => $on]);
    }


    /**
     * 下单
     *
     */
    public function order($id)
    {
        //
        // $result = $app->order->unify([
        //     'body' => '腾讯充值中心-QQ会员充值',
        //     'out_trade_no' => '20150806125346',
        //     'total_fee' => 88,
        //     'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
        //     'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        //     'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
        //     'openid' => 'oUpF8uMuAJO_M2pxb1Q9zNjWeS6o',
        // ]);
    }

}
