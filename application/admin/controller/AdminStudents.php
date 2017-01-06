<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/4
 * Time: 21:14
 */

namespace app\admin\controller;
use app\common\model\AdminStudents as AdminStudentsModel;

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


}