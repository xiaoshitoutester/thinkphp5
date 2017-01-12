<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/12
 * Time: 10:41
 */

namespace app\admin\controller;
use app\common\model\User as UserModel;
use think\Request;

class User extends Index
{
    /*
     * 用户管理模块
     */
    // 用户首页
    public function index(){
        $userModels = UserModel::all();
        $this->assign('users',$userModels);
        return $this->fetch();
    }

    // 新增用户
    public function add(){
        if (Request::instance()->isAjax()){
            $datas = input();
            // 向user表中添加数据
            $userModel = new UserModel();
            $userModel->username = $datas['username'];
            $userModel->password = md5($datas['password']);
            if ($userModel->save()){
                // 想关联表：usermsg保存姓名和电话号码
                $data['name'] = $datas['name'];
                $data['phone'] = $datas['phone'];
                if ($userModel->usermsg()->save($data)){
                    // 两张表都添加成功
                    $res['code'] = 200;
                    $res['message'] = '新增成功';
                    return $res;
                }
            }
        }
        // 添加失败
        $res['code'] = 500;
        $res['message'] = '新增失败';
        return $res;
    }

}