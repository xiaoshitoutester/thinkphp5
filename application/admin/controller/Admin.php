<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/2
 * Time: 18:00
 */

namespace app\admin\controller;
use app\common\model\User;

class Admin extends Index
{
    // 后台页面
    public function admin(){
        $user = User::get(1);
        session('user',$user);
        return $this->fetch();
    }

    // 修改密码页面
    public function changepwd(){
        return $this->fetch();
    }
}