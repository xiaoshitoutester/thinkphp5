<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/25
 * Time: 8:47
 */

namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher as TeacherModel;

class Login extends Controller
{
    public function index(){
        try{
            // 显示登录表单
            return $this->fetch();
        }catch (\Exception $exception){
            return "系统错误".$exception->getMessage();
        }
    }

    // 处理登录请求
    public function login(){
        // 接收提交的数据
        $postData = Request::instance()->param();

        // 直接调用M层的登录方法来判断，直接登录
        if (TeacherModel::login($postData['username'],$postData['password'])){
            return $this->success('登录成功',url('Teacher/index'));
        }else{
            return $this->error('用户名或者密码错误',url('index'));
        }

    }

    // 注销功能
    public function logout(){
        if (TeacherModel::logout()){
            return $this->success('注销成功',url('index'));
        }else{
            return $this->error('注销失败');
        }
    }

}