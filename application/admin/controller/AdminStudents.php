<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/4
 * Time: 21:14
 */

namespace app\admin\controller;
use app\common\model\AdminStudents as AdminStudentsModel;
use think\Request;

class AdminStudents extends Index
{
    // index页面
    public function index(){
        $adminStudents = AdminStudentsModel::getAllData();
        $this->assign('adminStudents', $adminStudents);
        return $this->fetch();
    }

    // 处理删除记录
    public function delete(){
        // 批量删除
        if (empty(input('id'))){
            if (!empty($checkArr = input()['check'])){
                // 全部删除 接收的是数组
                foreach ($checkArr as $val){
                    AdminStudentsModel::deleteRow($val);
                }
                return $this->success('全部删除成功',url('AdminStudents/index'));
            }else{
                // 当id 和 check数组都为空
                return $this->error('没有选择需要删除的记录', url('AdminStudents/index'));
            }
        }

        // 单个删除
        $id = input('id');
        if (AdminStudentsModel::deleteRow($id)){
            return $this->success('删除ID为：'.$id.'的记录', url('AdminStudents/index'));
        }
        return $this->error('删除失败', url('AdminStudents/index'));
    }

    // 新增页面
    public function add(){
        return $this->fetch();
    }

    // 保存新增和修改数据
    public function save(){
        $data = input();
        // 获取adminstudent对象
        if ($data['type'] == 'add'){
            // 新增
            $adminStudent = new AdminStudentsModel();
        }elseif ($data['type'] == 'edit'){
            // 修改
            $editId = $data['id'];
            $adminStudent = AdminStudentsModel::get($editId);
        }

        // 赋值
        $adminStudent->name = $data['name'];
        $adminStudent->sex = $data['sex'];
        $adminStudent->age = $data['age'];
        $adminStudent->phone = $data['phone'];
        //保存到数据库
        if (AdminStudentsModel::saveData($adminStudent)){
            $res['status'] = 200;
            $res['message'] = '保存成功';
        }else{
            $res['status'] = 500;
            $res['message'] = '保存失败';
        }
        return json($res);
    }

    // 测试方法
    public function test(){
        return $this->fetch();
    }


}