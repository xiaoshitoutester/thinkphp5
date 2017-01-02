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

}