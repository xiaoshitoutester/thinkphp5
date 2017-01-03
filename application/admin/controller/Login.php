<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/2
 * Time: 15:14
 */

namespace app\admin\controller;
use app\common\model\User;
use think\Controller;

/*
 * user表
 * username,password
 * 密码采用md5加密
 */
class Login extends Controller
{
    // 登录页面
    public function login(){
        return $this->fetch();
    }

    // 处理登录请求
    public function doLogin(){
        $data = input();

        // 验证码 验证
        if (!captcha_check($data['code'])){
            return $this->error('验证码不正确',url('Login/login'));
        }
        // 验证 用户名和密码是否正确
        if (!User::login_check($data['username'], $data['password'])){
            return $this->error('用户名或密码错误',url('Login/login'));
        }
        return $this->success('登录成功',url('Admin/admin'));
    }

    // 注销
    public function logout(){
        if (User::logout()){
            return $this->success('注销成功',url('Login/login'));
        }
    }

}