<?php

namespace App\Helpers;

class Role
{
    /**
     * 高于
     *
     */
    function higher($user, $target)
    {
        $roles = $user->orgs;

        $arr = [];

        foreach ($roles as $key) {
            $arr[] = $key->ancestors()->pluck('id','key');
        }

        // descendants()->pluck('id');
        print_r($arr);

    }

    /**
     * 系统
     *
     */
    public function root($user)
    {
        //
    }

    /**
     * 管理者
     *
     */
    public function admin($user)
    {
        //
    }

    /**
     * 管理员
     *
     */
    public function assistant($user)
    {
        //
    }



    /**
     * 相同机构
     *
     */
    public function same_org($user, $target)
    {
        //
    }


    /**
     * 员工
     *
     */
    public function staff($user)
    {
        //
    }

    /**
     * 客户
     *
     */
    public function customer($user)
    {
        //
    }

    /**
     * 供应商
     *
     */
    public function supplier($user)
    {
        //
    }

    /**
     * 无组织者
     *
     */
    public function unorganized($user)
    {
        //
    }


}
