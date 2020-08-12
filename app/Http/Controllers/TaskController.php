<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\Task as TaskRule;

class TaskController extends Controller
{
    /**
     * 列表
     * 
     */
    public function index()
    {
        $records = Task::orderBy('date', 'desc')
            ->latest()
            ->paginate(30);

        return view('task.index', \compact('records'));
    }

    /**
     * 新建
     * 
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * 任务分解
     * 
     */
    public function next(Request $request)
    {
        $request->validate([
            'title' => ['required','string', 'min:2', 'max:200'],
            'users' => ['required','string', 'min:2', 'max:200'],
            'date' => ['required', 'after:'.now()],
            'content' => ['string','max:200'],
        ]);

        $mc = pick($request->users);

        if(count($mc->error) || count($mc->may)) return redirect()->back()->withInput()->withErrors(['users' => [implode(', ', $mc->error).' 无效']]);
        
        Session::put('next', $request->all());

        return view('task.next', \compact('mc'));
    }


    /**
     * 初始化
     * 
     */
    public function store(Request $request)
    {
        $all = $request->all();
        $clean = Arr::except($all, ['_token']);

        if(!Session::has('next')) abort('403');

        $next = session('next');

        $parts = [];

        foreach ($clean as $key => $value) {
            $parts[] = ['id' => $key, 'task' => $value];
        }

        $new = [
            'title' => $next['title'],
            'date' => $next['date'],
            'title' => $next['title'],
            'content' => $next['content'],
            'created_by' => Auth::id(),
            'log' => [['time' => time(), 'id' => Auth::id(), 'do' => '任务设置']],
            'parts' => $parts,
        ];
        
        
        $re = Task::create($new);
        
        $conf = [
            'btn_link' => 'task/show/'.$re->id,
            'btn_color' => 'success',
            'btn_text' => '查看',
        ];
        
        if(Session::has('next')) Session::forget('next');

        return view('note', \compact('conf'));
    }

    /**
     * 列表
     * 
     */
    public function show($id)
    {
        $record = Task::findOrFail($id);
        return view('task.show', \compact('record'));
    }

    /**
     * 日志
     * 
     */
    public function confirmed($id)
    {
        $ex = Task::findOrFail($id);

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
        $ex = Task::findOrFail($id);

        if($ex->confirmed || $ex->abandon) abort('403');

        $ex->update(['abandon' => true]);

        return redirect()->back();
    }

    /**
     * 日志更新
     * 
     */
    public function update(Request $request)
    {
        // print_r($request->all());
        $ex = Task::findOrFail($request->id);

        if($ex->confirmed || $ex->abandon) abort('403');

        $rule = new TaskRule;

        if(!$rule->operate($ex)) abort('403');

        $new_log = $ex->log;

        $new_log[] = [
            'id' => Auth::id(),
            'time' => time(),
            'do' => $request->title,
            'type' => 'update',
        ];

        $ex->update(['log' => $new_log]);

        return redirect()->back();
    }

    /**
     * 完成工作
     * 
     */
    public function finish($id)
    {
        $ex = Task::findOrFail($id);

        if($ex->confirmed || $ex->abandon) abort('403');

        $rule = new TaskRule;

        if(!$rule->operate($ex)) abort('403');

        $new_log = $ex->log;

        $new_log[] = [
            'id' => Auth::id(),
            'time' => time(),
            'do' => '工作完成!',
            'type' => 'finish',
            'finish' => true,
        ];

        $ex->update(['log' => $new_log]);

        return redirect()->back();
    }

}
