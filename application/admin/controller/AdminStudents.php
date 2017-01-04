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
    public function index(){
        $adminStudents = AdminStudentsModel::getAllData();
        $this->assign('adminStudents', $adminStudents);
        return $this->fetch();
    }

}