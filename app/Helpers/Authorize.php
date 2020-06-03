<?php

namespace App\Helpers;

use App\Org;
use App\Role;
use Exception;

class Authorize
{
    /**
     * 角色1 > 角色2
     *
     * @param $model kalnoy/nestedset
     * @param $with 是否包含自身
     *
     * @return $array
     */
    public function win($user, $target_user)
    {
        $pair = $this->check($user);
        $pair_tagrget = $this->check($target_user);

        if(!$pair) return false;
        if($pair && !$pair_tagrget) return true;

        if($this->fit($user, 'sys', 'admin') && !$this->fit($target_user, 'sys', 'admin')) return true;

        foreach ($pair_tagrget as $t) {
            if(isset($t['role']) || !is_null($t['role'])){
                if(!$this->fit($user, $t['org']->key, $t['role']->key, false)) return false;
            }
        }

        return true;
    }


    /**
     * 组织:角色
     *
     * @param $model kalnoy/nestedset
     * @param $with 是否包含自身
     *
     * @return $array
     */
    public function fit($user, $org_key, $role_key, $with=true)
    {
        if($this->admin($user)) return true;

        $org = Org::where('key', $org_key)->firstOrFail();
        $role = Role::where('key', $role_key)->withDepth()->firstOrFail();

        $pair = $this->check($user);
        if(!$pair) return false;

        foreach ($pair as $p) {
            if(isset($p['role']) || !is_null($p['role'])){
                if($p['org']->id == $org->id) {
                    $role_arr = $this->upIds($role,$with);
                    if(in_array($p['role']->id, $role_arr)) return true;
                }else{
                    $org_arr = $this->upIds($org,$with);
                    if(in_array($p['org']->id, $org_arr) && $p['role']->depth <= $role->depth) return true;
                }
            }
        }

        return false;
    }

    /**
     * 指定人
     *
     * @param $mobile
     *
     * @return boolean
     */
    public function fix($user, $mobile)
    {
        if($this->admin($user)) return true;

        return show($user->info, 'mobile.number') == $mobile;
    }

    /**
     * 获取id数组: 上级
     *
     * @param $model kalnoy/nestedset
     * @param $with 是否包含自身
     *
     * @return $array
     */
    public function upIds($model, $with=true)
    {
        $array = $model->ancestors()->pluck('id')->toArray();
        if($with) $array[] = $model->getKey();
        return $array;
    }

    /**
     * 获取id数组: 下级
     *
     * @param $model kalnoy/nestedset
     * @param $with 是否包含自身
     *
     * @return $array
     */
    public function lowIds($model, $with=true)
    {
        $array = $model->descendants()->pluck('id')->toArray();
        if($with) $array[] = $model->getKey();
        return $array;
    }

    /**
     * 参数检查: conf
     *
     * @param $user = App\User
     *
     * @return $array or $boolean
     */
    private function check($user)
    {
        if(!isset($user->conf['roles'])) return false;

        $pair = $user->conf['roles'];
        return is_array($pair) && count($pair) ? $pair : false;
    }

    /**
     * 需要属于特定机构
     *
     * @param $user
     * @param $key staff | supplier | customer | partner
     *
     * @return boolean
     */
    public function need($user, $key)
    {
        if($this->admin($user)) return true;

        $pair = $this->check($user);
        if(!$pair) return false;

        $staff = Org::where('key',$key)->first();
        if(!$staff) throw new Exception("标签尚未设置: ".$key);
        $low = $this->lowIds($staff);

        foreach ($pair as $p) {
            if (in_array($p['org']->id, $low)) return true;
        }
        return false;
    }

    /**
     * 无组织者
     *
     * @param $user
     *
     * @return boolean
     */
    public function freeman($user)
    {
        if(!isset($user->conf['roles'])) return true;

        $pair = $user->conf['roles'];
        return !$pair || !count($pair);
    }

    /**
     * 自己
     *
     * @param $user
     * @param $target_user
     *
     * @return boolean
     */
    public function me($user, $target_user)
    {
        return $user->id === $target_user->id;
    }

    /**
     * 自己的id
     *
     * @param $user
     * @param $id
     *
     * @return boolean
     */
    public function my($user, $id)
    {
        return $user->id === $id;
    }

    /**
     * 管理员!!
     *
     * @param $user
     * @param $id
     *
     * @return boolean
     */
    function admin($user)
    {
        $pair = $this->check($user);
        if(!$pair) return false;

        $admin_org = Org::where('key', 'sys')->first();
        if(!$admin_org) return false;

        foreach($pair as $p) {
            if($p['org_id'] == $admin_org->id) return true;
        }
        return false;
    }
}
