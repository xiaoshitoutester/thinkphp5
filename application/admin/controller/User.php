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
        if (Request::instance()->isAjax() && input('type') == 'add'){
            $datas = input();
            // 实例对象
            $userModel = new UserModel();
            // 获取用户名和密码
            $userModel->username = $datas['username'];
            $userModel->password = md5($datas['password']);
            // 向user表中添加数据
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

    // 修改
    public function edit(){
        if (Request::instance()->isAjax() && input('type') == 'edit'){
            $datas = input();
            // 实例对象
            $userModel = UserModel::find($datas['id']);
            // // 想关联表：usermsg保存姓名,电话号码,地址
            $userModel->usermsg->name = $datas['name'];
            $userModel->usermsg->phone = $datas['phone'];
            $userModel->usermsg->address = $datas['address'];
            if ($userModel->usermsg->save()){
                $res['code'] = 200;
                $res['message'] = '修改成功';
                return $res;
            }
        }
        // 修改失败
        $res['code'] = 500;
        $res['message'] = '修改失败';
        return $res;
    }

    // 删除  关联删除
    public function delete(){
        if (Request::instance()->isAjax() && input('type') == 'delete'){
            $userModel = UserModel::get(input('id'));
            if (!empty($userModel)){
                // 删除user表的数据
                if ($userModel->delete()){
                    // 删除关联表usermsg表的数据
                    if ($userModel->usermsg->delete()){
                        $res['code'] = 200;
                        $res['message'] = '删除成功';
                        return json($res);
                    }
                }
            }
        }

        // 删除失败
        $res['code'] = 500;
        $res['message'] = '删除失败';
        return json($res);
    }

}