<?php

/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/1
 * Time: 17:01
 */
namespace app\admin\controller;
use think\Controller;
use app\common\model\User;

class Index extends Controller
{
    public function __construct()
    {
        // 调用父类
        parent::__construct();
        if (!User::isLogin()){
            $this->error('非法访问，请登录',url('Login/login'));
        }
    }


}