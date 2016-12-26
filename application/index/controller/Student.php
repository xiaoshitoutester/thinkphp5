<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 17:41
 */

namespace app\index\controller;
use app\common\model\Student as StudentModel;

class Student extends Index
{
    public function Index(){
        // 获取所有的学生
        $students = StudentModel::paginate(5);
        $this->assign('students',$students);
        return $this->fetch();
    }
}