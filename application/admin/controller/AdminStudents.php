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
        return dump(input());
        $id = input('id');
        if (AdminStudentsModel::deleteRow($id)){
            return $this->success('删除ID为：'.$id.'的记录', url('AdminStudents/index'));
        }
        return $this->error('删除失败', url('AdminStudents/index'));
    }


}