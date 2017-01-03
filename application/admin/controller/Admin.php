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
        return $this->fetch();
    }

    // 修改密码页面
    public function changepwd(){
        return $this->fetch();
    }

    // 保存新密码
    public function SaveChangepwd(){
        $data = input();
        // 判断原始密码 新密码 确认密码是否为空
        if (empty($data['oldPassword']) || empty($data['newPassword'][0]) || empty($data['newPassword'][1])){
            return $this->error('原密码或新密码或确认密码为空，请重新输入',url('Admin/changepwd'));
        }
        // 判断新密码和确认密码是否相同
        if ($data['newPassword'][0] !== $data['newPassword'][1]){
            return $this->error('新密码和确认密码不一致，请重新输入', url('Admin/changepwd'));
        }
        // 修改密码
        if (!User::modifiePassword($data['oldPassword'], $data['newPassword'][0])){
            return $this->error(('原始密码不正确，请重新输入'), url('Admin/changepwd'));
        }
        return $this->success('修改密码成功', url('Admin/admin'));
    }
}