<?php

namespace App\Helpers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Task
{   
    /**
     * 根据id写入用户名
     * 
     */
    public function showName($task)
    {
        $new = [];
        foreach ($task->parts as $p) {
            $user = User::find($p['id']);
            $add = Arr::add($p, 'name', face($user)->name);
            $new[] = $add;
        }
        return $new;
    }

    /**
     * 能更新信息
     * 
     */
    public function operate($task)
    {
        // 任务已完成或者废弃
        if($task->confirmed || $task->abandon) return false;
        if(!$this->in($task)) return false;
        if($this->finish($task)) return false;
        
        return true;
    }


    /**
     * 参与者
     * 
     */
    public function in($task)
    {
        foreach ($task->parts as $p) {
            if($p['id'] == Auth::id()) return $p;
        }
        return false;
    }

    /**
     * 自身工作完成
     * 
     */
    public function finish($task)
    {
        if(!$this->in($task)) abort('403');

        foreach ($task->log as $key) {
            if(isset($key['finish']) && $key['finish'] == true) return true;
        }
        
        return false;
    }
}
