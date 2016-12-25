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
}