<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/2
 * Time: 18:08
 */

namespace app\common\model;
use think\Model;

class User extends Model
{
    // 登录验证
    public static function login_check($username,$password){
        // 验证username 和 password 是否为空
        if (empty($username) || empty($password)){
            return false;
        }
        $where['username'] = $username;
        $where['password'] = md5($password);
        $user = User::where($where)->find();
        if ($user){
            unset($user->password);
            session('user',$user);
            return true;
        }
        return false;
    }

    // 退出登录
    public static function logout(){
        // 清空session
        session('user',null);
        return true;
    }

    // 判断用户是否登录
    public static function isLogin(){
        if (session('user')){
            return true;
        }
        return false;
    }

    // 修改密码
    public static function modifiePassword($oldPassword, $newPassword){
        // 获取user对象
        $user = User::get(session('user')->id);
        if (md5($oldPassword) !== $user->password){
            // 原始密码不正确
            return false;
        }
        $user->password = md5($newPassword);
        $user->save();
        return true;

    }

}