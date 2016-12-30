<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/22
 * Time: 16:42
 */

namespace app\common\model;
use think\Model;

class Teacher extends Model
{
    static public function login($username,$password){
        // 验证用户名是否存在
        $verifyMsg = array('username'=>$username);
        $teacher = self::get($verifyMsg);
        // teacher 不为空
        if (!is_null($teacher)){
            // 验证密码是否正确
            if ($teacher->checkPassword($password)){
                // 设置Session
                session('teacherId',$teacher->getData('id'));
                return true;
            }
        }
        return false;
    }

    // 验证密码是否正确
    public function checkPassword($password){
        if ($this->getData('password') === $this::encryptPassword($password)){
            return true;
        }else{
            return false;
        }
    }

    // 进行sha1 md5加密
    static public function encryptPassword($password){
        return sha1(md5($password).'xiaoshitou');
    }

    // 进行 注销 删除session的 teacherId
    static public function logout(){
        session('teacherId',null);
        return true;
    }

    // 判断用户是否登录
    static  public function isLogin(){
        // 未登录 返回false
        if (is_null(session('teacherId'))){
            return false;
        }
        return true;
    }

    // 返回: 登录用户的姓名 name
    static public function loginUser(){
        $userId = session('teacherId');
        if (!is_null($userId)){
            $name = Teacher::get($userId)->getData('name');
            return $name;
        }else{
            return false;
        }
    }
}