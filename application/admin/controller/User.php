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
        $users = User::read();
//        return dump($users);
        $this->assign('users',$users);
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

    // 读取用户信息
    protected static function read(){
        $users = UserModel::where([])->select();
        $datas = array();
        foreach ($users as $user){
            $userModel = UserModel::get($user['id'],'usermsg');
            if (!empty($userModel)){
                $tmp = array();
                // 给tmp数组赋值
                $tmp['id'] = $userModel->id;
                $tmp['username'] = $userModel->username;
                $tmp['name'] = $userModel->usermsg->name;
                $tmp['address'] = $userModel->usermsg->address;
                $tmp['phone'] = $userModel->usermsg->phone;
                // 将需要展示的数据存入到datas数组中
                array_push($datas,$tmp);
            }
        }
        return $datas;
    }

}